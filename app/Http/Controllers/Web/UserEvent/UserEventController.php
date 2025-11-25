<?php

namespace App\Http\Controllers\Web\UserEvent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use App\Models\RegistrationEvent;
use App\Models\EventAttendance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserEventController extends Controller
{
    /**
     * Mostrar la vista principal de búsqueda y gestión
     */
    public function index()
    {
        return view('userEvent.index');
    }

    /**
     * Buscar usuarios por nombre, email o documento
     */
    public function searchUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::with(['modality', 'registrations.subscriptionPlan'])
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('document_number', 'LIKE', "%{$search}%");
            })
            ->where('status', true)
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'uuid' => $user->uuid,
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'document_number' => $user->document_number,
                    'modality_id' => $user->modality_id,
                    'modality_name' => $user->modality->name ?? 'No asignada',
                    'has_registration' => $user->registrations->isNotEmpty()
                ];
            });

        return response()->json($users);
    }

    /**
     * Obtener eventos registrados por un usuario
     */
    public function getUserEvents($userId)
    {
        $user = User::with(['modality'])->findOrFail($userId);

        $registeredEvents = RegistrationEvent::with(['event.modality', 'event.schedules', 'event.locations'])
            ->whereHas('registration', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get()
            ->map(function ($registrationEvent) {
                $event = $registrationEvent->event;

                // Calcular capacidad actual basada en registros
                $currentRegistrations = RegistrationEvent::where('event_id', $event->id)->count();
                $availableCapacity = $event->max_capacity - $currentRegistrations;

                return [
                    'id' => $registrationEvent->id,
                    'event_id' => $event->id,
                    'title' => $event->title,
                    'modality' => $event->modality->name,
                    'max_capacity' => $event->max_capacity,
                    'current_registrations' => $currentRegistrations,
                    'available_capacity' => $availableCapacity,
                    'schedules' => $event->schedules->map(function ($schedule) {
                         return [
                            'date' => $schedule->start_date->format('d/m/Y'),
                            // ✅ CORRECCIÓN: Verificar y formatear correctamente las horas
                            'time' => $this->formatScheduleTime($schedule),
                            'start_datetime' => $schedule->start_date->format('Y-m-d') . ' ' . $schedule->start_time,
                            'end_datetime' => $schedule->end_date->format('Y-m-d') . ' ' . $schedule->end_time
                        ];
                    }),
                    'locations' => $event->locations->pluck('name')->implode(', ')
                ];
            });

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'modality_id' => $user->modality_id,
                'modality_name' => $user->modality->name ?? 'No asignada'
            ],
            'registered_events' => $registeredEvents
        ]);
    }

    /**
     * Obtener eventos disponibles para un usuario según su modalidad
     */
    public function getAvailableEvents($userId)
    {
        $user = User::findOrFail($userId);

        $availableEvents = Event::with(['modality', 'schedules', 'locations'])
            ->where('modality_id', $user->modality_id)
            ->where('is_active', true)
            ->whereDoesntHave('registrationEvents.registration', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get()
            ->map(function ($event) use ($userId) {
                // Calcular capacidad actual basada en registros
                $currentRegistrations = RegistrationEvent::where('event_id', $event->id)->count();
                $availableCapacity = $event->max_capacity - $currentRegistrations;

                // ← CAMBIO 2: Llamar a la validación de conflictos de horario
                $hasScheduleConflict = $this->checkScheduleConflict($userId, $event->id);

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'modality' => $event->modality->name,
                    'max_capacity' => $event->max_capacity,
                    'current_registrations' => $currentRegistrations,
                    'available_capacity' => $availableCapacity,
                    'schedules' => $event->schedules->map(function ($schedule) {
                        // ← CAMBIO 3: Agregar campos datetime para facilitar comparaciones
                         return [
                            'date' => $schedule->start_date->format('d/m/Y'),
                            // ✅ CORRECCIÓN: Verificar y formatear correctamente las horas
                            'time' => $this->formatScheduleTime($schedule),
                            'start_datetime' => $schedule->start_date->format('Y-m-d') . ' ' . $schedule->start_time,
                            'end_datetime' => $schedule->end_date->format('Y-m-d') . ' ' . $schedule->end_time
                        ];
                    }),
                    'locations' => $event->locations->pluck('name')->implode(', '),
                    'has_capacity' => $availableCapacity > 0,
                    // ← CORRECCIÓN 3: Agregar schedule_conflicts que falta
                    'has_schedule_conflict' => !empty($hasScheduleConflict),
                    'schedule_conflicts' => $hasScheduleConflict ?: [], // ← ESTE FALTABA
                    'capacity_status' => $availableCapacity > 5 ? 'high' : ($availableCapacity > 0 ? 'low' : 'none')
                ];
            });

        return response()->json($availableEvents);
    }

    /**
     * Registrar usuario en un evento
     */
    public function registerToEvent(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id'
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($request->user_id);
            $event = Event::findOrFail($request->event_id);

            // Verificar modalidad
            if ($event->modality_id !== $user->modality_id) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'El evento no corresponde a la modalidad del usuario'
                ], 422);
            }

            // 🔄 DECREMENTO ATÓMICO con verificación
            $affectedRows = Event::where('id', $event->id)
                ->where('max_capacity', '>', 0) // Solo si hay capacidad
                ->decrement('max_capacity');

            // Si no se afectaron filas, no hay capacidad
            if ($affectedRows === 0) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'No hay capacidad disponible en este evento'
                ], 422);
            }

            // Recargar el evento para obtener la nueva capacidad
            $event->refresh();

            // Resto de validaciones...
            $hasScheduleConflict = $this->checkScheduleConflict($user->id, $event->id);
            if ($hasScheduleConflict) {
                // 🔄 Revertir el decremento si hay conflicto
                $event->increment('max_capacity');
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario ya tiene un evento registrado en este mismo horario',
                    'conflicting_events' => $hasScheduleConflict
                ], 422);
            }

            $registration = Registration::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'uuid' => \Illuminate\Support\Str::uuid(),
                    'subscription_plan_id' => 1,
                    'registered_at' => now()
                ]
            );

            $existingRegistration = RegistrationEvent::where('registration_id', $registration->id)
                ->where('event_id', $event->id)
                ->first();

            if ($existingRegistration) {
                // 🔄 Revertir el decremento si ya está registrado
                $event->increment('max_capacity');
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario ya está registrado en este evento'
                ], 422);
            }

            $registrationEvent = RegistrationEvent::create([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'registration_id' => $registration->id,
                'event_id' => $event->id
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente en el evento',
                'data' => $registrationEvent,
                'remaining_capacity' => $event->max_capacity
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar usuario en el evento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar registro de evento
     */
    public function removeFromEvent($registrationEventId)
    {
        try {
            DB::beginTransaction();

            $registrationEvent = RegistrationEvent::with(['event', 'registration'])->findOrFail($registrationEventId);
            $event = $registrationEvent->event;
            $userId = $registrationEvent->registration->user_id;

            // Eliminar registro de asistencia si existe
            EventAttendance::where('user_id', $userId)
                ->where('event_id', $event->id)
                ->where('registration_event_id', $registrationEventId)
                ->delete();

            // Eliminar el registro del evento
            $registrationEvent->delete();

            // OPCIÓN: Si quieres incrementar max_capacity al eliminar
            $nuevosCupos = $event->max_capacity + 1;
            $event->update(['max_capacity' => $nuevosCupos]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registro eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar registro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar eventos disponibles con filtros
     */
    public function searchAvailableEvents(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $search = $request->input('search', '');

        $availableEvents = Event::with(['modality', 'schedules', 'locations'])
            ->where('modality_id', $user->modality_id)
            ->where('is_active', true)
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->orWhereHas('categories', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('tags', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                }
            })
            ->whereDoesntHave('registrationEvents.registration', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get()
            ->map(function ($event) use ($userId) {
                // Calcular capacidad actual basada en registros
                $currentRegistrations = RegistrationEvent::where('event_id', $event->id)->count();
                $availableCapacity = $event->max_capacity - $currentRegistrations;

                // ← CAMBIO 9: Aplicar validación de horarios también en búsqueda
                $hasScheduleConflict = $this->checkScheduleConflict($userId, $event->id);

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'modality' => $event->modality->name,
                    'max_capacity' => $event->max_capacity,
                    'current_registrations' => $currentRegistrations,
                    'available_capacity' => $availableCapacity,
                    'schedules' => $event->schedules->map(function ($schedule) {
                          return [
                            'date' => $schedule->start_date->format('d/m/Y'),
                            // ✅ CORRECCIÓN: Verificar y formatear correctamente las horas
                            'time' => $this->formatScheduleTime($schedule),
                            'start_datetime' => $schedule->start_date->format('Y-m-d') . ' ' . $schedule->start_time,
                            'end_datetime' => $schedule->end_date->format('Y-m-d') . ' ' . $schedule->end_time
                        ];
                    }),
                    'locations' => $event->locations->pluck('name')->implode(', '),
                    'has_capacity' => $availableCapacity > 0,
                    'has_schedule_conflict' => !empty($hasScheduleConflict),
                    'schedule_conflicts' => $hasScheduleConflict ?: [],
                    'capacity_status' => $availableCapacity > 5 ? 'high' : ($availableCapacity > 0 ? 'low' : 'none')
                ];
            });

        return response()->json($availableEvents);
    }

    // ============================================================
    // ← NUEVO MÉTODO PARA FORMATEAR HORAS CORRECTAMENTE
    // ============================================================

    /**
     * Formatear el tiempo del schedule de manera segura
     */
    private function formatScheduleTime($schedule)
    {
        try {
            $startTime = $this->extractTime($schedule->start_time);
            $endTime = $this->extractTime($schedule->end_time);
            
            return $startTime . ' - ' . $endTime;
        } catch (\Exception $e) {
            return 'Horario no disponible';
        }
    }

    /**
     * Extraer y formatear tiempo de manera segura
     */
    private function extractTime($timeValue)
    {
        if (empty($timeValue)) {
            return '00:00';
        }

        // Si es un string, intentar extraer la hora
        if (is_string($timeValue)) {
            // Si contiene espacios, podría ser un datetime completo
            if (strpos($timeValue, ' ') !== false) {
                $datetime = \Carbon\Carbon::parse($timeValue);
                return $datetime->format('H:i');
            }
            
            // Si ya es solo hora, formatear
            $time = \Carbon\Carbon::createFromFormat('H:i:s', $timeValue);
            return $time->format('H:i');
        }

        // Si es un objeto DateTime
        if ($timeValue instanceof \DateTime) {
            return $timeValue->format('H:i');
        }

        return '00:00';
    }

    // ============================================================
    // ← MÉTODOS PARA CONTROL DE HORARIOS
    // ============================================================

    /**
     * Verificar conflictos de horarios entre eventos (VERSIÓN SIMPLIFICADA)
     */
    private function checkScheduleConflict($userId, $newEventId)
    {
        // Obtener el nuevo evento con sus horarios
        $newEvent = Event::with('schedules')->findOrFail($newEventId);
        
        if ($newEvent->schedules->isEmpty()) {
            return false; // Evento sin horarios definidos, no hay conflicto
        }

        // Obtener eventos ya registrados por el usuario con sus horarios
        $userRegisteredEvents = RegistrationEvent::with(['event.schedules'])
            ->whereHas('registration', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get()
            ->pluck('event')
            ->filter(); // Remover elementos null

        $conflictingEvents = [];

        foreach ($newEvent->schedules as $newSchedule) {
            // ✅ SOLUCIÓN DEFINITIVA: Usar Carbon directamente desde los objetos
            try {
                $newStart = Carbon::parse($newSchedule->start_date->format('Y-m-d') . ' ' . $this->formatTime($newSchedule->start_time));
                $newEnd = Carbon::parse($newSchedule->end_date->format('Y-m-d') . ' ' . $this->formatTime($newSchedule->end_time));
            } catch (\Exception $e) {
                // Si hay error, continuar con el siguiente schedule
                continue;
            }

            foreach ($userRegisteredEvents as $registeredEvent) {
                if (!$registeredEvent || $registeredEvent->schedules->isEmpty()) continue;

                foreach ($registeredEvent->schedules as $existingSchedule) {
                    try {
                        $existingStart = Carbon::parse($existingSchedule->start_date->format('Y-m-d') . ' ' . $this->formatTime($existingSchedule->start_time));
                        $existingEnd = Carbon::parse($existingSchedule->end_date->format('Y-m-d') . ' ' . $this->formatTime($existingSchedule->end_time));
                    } catch (\Exception $e) {
                        // Si hay error, continuar con el siguiente schedule
                        continue;
                    }

                    // Usar función especializada para detectar solapamiento
                    if ($this->schedulesOverlap($newStart, $newEnd, $existingStart, $existingEnd)) {
                        $conflictingEvents[] = [
                            'event_id' => $registeredEvent->id,
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
        // Si el tiempo ya es un string, devolverlo tal cual
        if (is_string($time)) {
            return $time;
        }
        
        // Si es un objeto DateTime, formatearlo
        if ($time instanceof \DateTime) {
            return $time->format('H:i:s');
        }
        
        // Valor por defecto
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