<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Resources\Api\Event\IndexEventResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationConfirmation;
use App\Models\Event;
use App\Models\Registration;
use App\Models\RegistrationEvent;
use App\Models\User;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(string $uuid)
    {
        $event = Event::with(['speakers', 'locations', 'modality', 'categories', 'schedules', 'themes', 'tags'])->where('uuid', $uuid)->first();

        return response()->json([
            'success' => true,
            'event' => new IndexEventResource($event),
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar la request
            $validator = Validator::make($request->all(), [
                'user_uuid' => 'required|exists:users,uuid',
                'events' => 'required|array|min:1',
                'events.*.uuid' => 'required|exists:events,uuid',
                'events.*.userUuid' => 'required|exists:users,uuid'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Datos de entrada inválidos',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('uuid', $request->user_uuid)->first();
            $eventsData = $request->events;

            // Buscar o crear registro principal
            $registration = Registration::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'subscription_plan_id' => 1
                ],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'registered_at' => now()
                ]
            );

            $registeredEvents = [];
            $alreadyRegistered = [];
            $noCapacity = [];
            $scheduleConflicts = [];

            foreach ($eventsData as $eventData) {
                $event = Event::where('uuid', $eventData['uuid'])->first();

                if (!$event) {
                    continue;
                }

                // 1. Verificar si ya está registrado
                $existingRegistration = RegistrationEvent::where([
                    'registration_id' => $registration->id,
                    'event_id' => $event->id
                ])->first();

                if ($existingRegistration) {
                    $alreadyRegistered[] = [
                        'event_uuid' => $event->uuid,
                        'event_title' => $event->title,
                        'message' => 'Ya estás registrado en este evento'
                    ];
                    continue;
                }

                // 2. Verificar capacidad del evento
                if ($event->max_capacity !== null) {
                    if ($event->max_capacity <= 0) {
                        $noCapacity[] = [
                            'event_uuid' => $event->uuid,
                            'event_title' => $event->title,
                            'max_capacity' => $event->max_capacity,
                            'message' => 'No hay cupos disponibles para este evento: ' . $event->title
                        ];
                        continue;
                    }
                }

                // 3. Validar conflictos de horario
                $hasScheduleConflict = $this->checkScheduleConflict($user->id, $event->id);
                if ($hasScheduleConflict) {
                    $scheduleConflicts[] = [
                        'event_uuid' => $event->uuid,
                        'event_title' => $event->title,
                        'message' => 'El evento ' . $event->title . ' tiene conflictos de horario con otros eventos en los que estás registrado.',
                        'conflicting_events' => $hasScheduleConflict
                    ];
                    continue;
                }

                // 4. Crear el registro del evento
                $registrationEvent = RegistrationEvent::create([
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'registration_id' => $registration->id,
                    'event_id' => $event->id
                ]);

                // 5. Decrementar capacidad (SOLO si pasó todas las validaciones)
                if ($event->max_capacity !== null) {
                    $event->decrement('max_capacity');
                    $event->refresh();
                }

                $registeredEvents[] = [
                    'event_uuid' => $event->uuid,
                    'event_title' => $event->title,
                    'registration_uuid' => $registrationEvent->uuid,
                    'registered_at' => $registrationEvent->created_at->toISOString(),
                    'max_capacity' => $event->max_capacity,
                    'current_capacity' => RegistrationEvent::where('event_id', $event->id)->count(),
                    'available_capacity' => $event->max_capacity ? $event->max_capacity - RegistrationEvent::where('event_id', $event->id)->count() : null,
                    'message' => 'Registro exitoso'
                ];
            }

            // 👇 ENVÍO DE CORREO ELECTRÓNICO
            if (count($registeredEvents) > 0) {
                $emailData = [
                    'user' => [
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'email' => $user->email,
                    ],
                    'registered_events' => $registeredEvents,
                    'registration_date' => now()->format('d/m/Y H:i:s'),
                    'registration_uuid' => $registration->uuid,
                    'total_events' => count($registeredEvents),
                ];

                Mail::to($user->email)->send(new EventRegistrationConfirmation($emailData));
            }

            DB::commit();

            // Construir respuesta
            $response = [
                'success' => true,
                'message' => 'Proceso de registro completado',
                'data' => [
                    'user' => [
                        'uuid' => $user->uuid,
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'email' => $user->email
                    ],
                    'registered_events' => $registeredEvents,
                    'already_registered' => $alreadyRegistered,
                    'no_capacity' => $noCapacity,
                    'schedule_conflicts' => $scheduleConflicts,
                    'summary' => [
                        'total_requested' => count($eventsData),
                        'successfully_registered' => count($registeredEvents),
                        'already_registered' => count($alreadyRegistered),
                        'no_capacity' => count($noCapacity),
                        'schedule_conflicts' => count($scheduleConflicts)
                    ]
                ]
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al registrar los eventos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ============================================================
    // MÉTODOS DE CONSULTA
    // ============================================================

    /**
     * Verificar registro y capacidad de un evento específico
     */
    public function checkEventRegistration($userUuid, $eventUuid)
    {
        try {
            $user = User::where('uuid', $userUuid)->first();
            $event = Event::where('uuid', $eventUuid)->first();

            if (!$user || !$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario o evento no encontrado'
                ], 404);
            }

            // Verificar si ya está registrado
            $isRegistered = RegistrationEvent::whereHas('registration', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('event_id', $event->id)->exists();

            // Verificar capacidad
            $currentRegistrations = RegistrationEvent::where('event_id', $event->id)->count();
            $hasCapacity = $event->max_capacity === null || $currentRegistrations < $event->max_capacity;
            $availableSpots = $event->max_capacity ? $event->max_capacity - $currentRegistrations : null;

            // Verificar conflictos de horario
            $hasScheduleConflict = $this->checkScheduleConflict($user->id, $event->id);

            return response()->json([
                'success' => true,
                'data' => [
                    'is_registered' => $isRegistered,
                    'has_capacity' => $hasCapacity,
                    'has_schedule_conflict' => !empty($hasScheduleConflict),
                    'schedule_conflicts' => $hasScheduleConflict ?: [],
                    'available_spots' => $availableSpots,
                    'max_capacity' => $event->max_capacity,
                    'current_registrations' => $currentRegistrations,
                    'event' => [
                        'uuid' => $event->uuid,
                        'title' => $event->title
                    ]
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar registro',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener todos los eventos registrados por un usuario
     */
    public function getUserEventRegistrations($userUuid)
    {
        try {
            $user = User::where('uuid', $userUuid)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            $registrations = RegistrationEvent::with(['event.speakers', 'event.categories', 'event.schedules', 'event.locations'])
                ->whereHas('registration', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get()
                ->map(function ($registrationEvent) {
                    $event = $registrationEvent->event;
                    $currentRegistrations = RegistrationEvent::where('event_id', $event->id)->count();

                    return [
                        'event_uuid' => $event->uuid,
                        'event_title' => $event->title,
                        'event_description' => $event->description,
                        'event_image' => $event->image,
                        'event_modality' => $event->modality->name ?? 'No especificado',
                        'registered_at' => $registrationEvent->created_at->toISOString(),
                        'registration_uuid' => $registrationEvent->uuid,
                        'capacity_info' => [
                            'max_capacity' => $event->max_capacity,
                            'current_registrations' => $currentRegistrations,
                            'available_spots' => $event->max_capacity ? $event->max_capacity - $currentRegistrations : null
                        ],
                        'schedules' => $event->schedules->map(function ($schedule) {
                            return [
                                'start_date' => $schedule->start_date,
                                'end_date' => $schedule->end_date,
                                'start_time' => $schedule->start_time,
                                'end_time' => $schedule->end_time
                            ];
                        }),
                        'locations' => $event->locations->map(function ($location) {
                            return [
                                'name' => $location->name,
                                'address' => $location->address,
                                'room' => $location->room
                            ];
                        })
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'uuid' => $user->uuid,
                        'name' => $user->first_name . ' ' . $user->last_name
                    ],
                    'total_registrations' => $registrations->count(),
                    'registrations' => $registrations
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener registros',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // ============================================================
    // MÉTODOS DE VALIDACIÓN DE HORARIOS
    // ============================================================

    /**
     * Verificar conflictos de horario para múltiples eventos
     */
    public function checkScheduleConflicts(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_uuid' => 'required|exists:users,uuid',
                'event_uuids' => 'required|array|min:1',
                'event_uuids.*' => 'required|exists:events,uuid'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Datos de entrada inválidos',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = User::where('uuid', $request->user_uuid)->first();
            $conflicts = [];

            foreach ($request->event_uuids as $eventUuid) {
                $event = Event::where('uuid', $eventUuid)->first();

                if ($event) {
                    $hasConflict = $this->checkScheduleConflict($user->id, $event->id);

                    if (!empty($hasConflict)) {
                        $conflicts[] = [
                            'event_uuid' => $event->uuid,
                            'event_title' => $event->title,
                            'conflicts' => $hasConflict
                        ];
                    }
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'uuid' => $user->uuid,
                        'name' => $user->first_name . ' ' . $user->last_name
                    ],
                    'total_events_checked' => count($request->event_uuids),
                    'events_with_conflicts' => count($conflicts),
                    'conflicts' => $conflicts
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar conflictos de horario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verificar conflictos de horarios entre eventos (Método privado)
     */
    private function checkScheduleConflict($userId, $newEventId)
    {
        $newEvent = Event::with('schedules')->findOrFail($newEventId);

        if ($newEvent->schedules->isEmpty()) {
            return false;
        }

        $userRegisteredEvents = RegistrationEvent::with(['event.schedules'])
            ->whereHas('registration', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get()
            ->pluck('event')
            ->filter();

        $conflictingEvents = [];

        foreach ($newEvent->schedules as $newSchedule) {
            try {
                $newStart = Carbon::parse($newSchedule->start_date->format('Y-m-d') . ' ' . $this->formatTime($newSchedule->start_time));
                $newEnd = Carbon::parse($newSchedule->end_date->format('Y-m-d') . ' ' . $this->formatTime($newSchedule->end_time));
            } catch (\Exception $e) {
                continue;
            }

            foreach ($userRegisteredEvents as $registeredEvent) {
                if (!$registeredEvent || $registeredEvent->schedules->isEmpty()) continue;

                foreach ($registeredEvent->schedules as $existingSchedule) {
                    try {
                        $existingStart = Carbon::parse($existingSchedule->start_date->format('Y-m-d') . ' ' . $this->formatTime($existingSchedule->start_time));
                        $existingEnd = Carbon::parse($existingSchedule->end_date->format('Y-m-d') . ' ' . $this->formatTime($existingSchedule->end_time));
                    } catch (\Exception $e) {
                        continue;
                    }

                    if ($this->schedulesOverlap($newStart, $newEnd, $existingStart, $existingEnd)) {
                        $conflictingEvents[] = [
                            'event_uuid' => $registeredEvent->uuid,
                            'event_title' => $registeredEvent->title,
                            'conflicting_schedule' => [
                                'date' => $existingSchedule->start_date->format('d/m/Y'),
                                'time' => $existingSchedule->start_time . ' - ' . $existingSchedule->end_time
                            ],
                            'new_event_schedule' => [
                                'date' => $newSchedule->start_date->format('d/m/Y'),
                                'time' => $newSchedule->start_time . ' - ' . $newSchedule->end_time
                            ]
                        ];
                    }
                }
            }
        }

        return !empty($conflictingEvents) ? $conflictingEvents : false;
    }

    /**
     * Formatear tiempo para asegurar compatibilidad
     */
    private function formatTime($time)
    {
        if (is_string($time)) {
            return $time;
        }

        if ($time instanceof \DateTime) {
            return $time->format('H:i:s');
        }

        return '00:00:00';
    }

    /**
     * Verificar si dos horarios se solapan
     */
    private function schedulesOverlap($start1, $end1, $start2, $end2)
    {
        return $start1->lt($end2) && $end1->gt($start2);
    }
}
