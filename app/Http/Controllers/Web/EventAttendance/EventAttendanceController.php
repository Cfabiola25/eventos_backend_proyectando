<?php

namespace App\Http\Controllers\Web\EventAttendance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // esto se agrego
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\EventAttendance;
use App\Models\User;
use App\Models\Event;
use App\Models\RegistrationEvent;
use App\Models\Registration;
use Carbon\Carbon;
use Exception;

//Asistencia al evento 
class EventAttendanceController extends Controller
{
     /**
     * Mostrar lista de eventos con estadísticas
     */
    public function index()
    {
        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();
        $inactiveEvents = Event::where('is_active', false)->count();

        $eventsWithAttendance = Event::where('is_active', true)
            ->has('registrationEvents')
            ->count();

        $events = Event::with(['modality', 'registrationEvents'])
            ->where('is_active', true)
            ->withCount('registrationEvents')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('eventAttendance.index', compact(
            'totalEvents',
            'activeEvents',
            'inactiveEvents',
            'eventsWithAttendance',
            'events'
        ));
    }

    /**
     * Buscar eventos con AJAX  ojo se cambio aqui 
     */
    public function searchEvents(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);

        $events = Event::with(['modality', 'registrationEvents'])
            ->where('is_active', true)
            ->withCount('registrationEvents')
            ->when($search, function($query) use ($search) {
                 $searchLower = strtolower($search);
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$searchLower}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchLower}%"]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $page);

        $html = view('eventAttendance.components.table', compact('events'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'stats' => [
                'total' => $events->total(),
                'current_page' => $events->currentPage(),
                'last_page' => $events->lastPage()
            ]
        ]);
    }

    /**
     * Mostrar usuarios registrados a un evento específico
     */
    public function showEventAttendances($eventUuid)
    {

        $event = Event::with(['modality'])->where('uuid', $eventUuid)->where('is_active', true)->firstOrFail();
        
        $totalAttendances = RegistrationEvent::where('event_id', $event->id)->count();
        $confirmedAttendances = EventAttendance::where('event_id', $event->id)->count();
        $checkedInAttendances = EventAttendance::where('event_id', $event->id)
            ->whereNotNull('checked_in_at')
            ->count();
        $checkedOutAttendances = EventAttendance::where('event_id', $event->id)
            ->whereNotNull('checked_out_at')
            ->count();

        $activeAttendances = EventAttendance::where('event_id', $event->id)
            ->where('status', true) // Cambiado a boolean true
            ->count();

        $attendances = RegistrationEvent::with([
                'registration.user', 
                'registration.user.modality', 
                'registration.user.gender', 
                'registration.user.documentType',
                'attendance'
            ])
            ->where('event_id', $event->id)
            // Solo registros con status true en event_attendances
            /* ->whereHas('attendance', function($query) {
               $query->where('status', true); 
             }) */
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $users = $attendances->pluck('registration.user')->unique('id')->values();
    
            // Ocultar las relaciones
            /*   $users->each(function($user) {
                $user->makeHidden(['modality', 'gender', 'document_type']);
            });
             */
            /* return $users; */

        return view('eventAttendance.attendances', compact(
            'event',
            'totalAttendances',
            'confirmedAttendances',
            'checkedInAttendances',
            'checkedOutAttendances',
            'activeAttendances',
            'attendances'
        ));
    }

    /**
     * Buscar registros de un evento con AJAX
     */
    public function searchEventAttendances(Request $request, $eventUuid)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);

        $event = Event::where('uuid', $eventUuid)
            ->where('is_active', true)
            ->firstOrFail();

        $attendances = RegistrationEvent::with([
                'registration.user', 
                'registration.user.modality', 
                'registration.user.gender', 
                'registration.user.documentType',
                'attendance'
            ])
            ->where('event_id', $event->id)
            ->when($search, function($query) use ($search) {
                $query->whereHas('registration.user', function($userQuery) use ($search) {
                    $userQuery->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('document_number', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'page', $page);

        $html = view('eventAttendance.components.attendance-table', compact('attendances', 'event'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'stats' => [
                'total' => $attendances->total(),
                'current_page' => $attendances->currentPage(),
                'last_page' => $attendances->lastPage()
            ]
        ]);
    }

    /**
     * Confirmar asistencia de usuario
     */
     public function confirmAttendance(Request $request, $registrationEventUuid)
    {
        try {
            $registrationEvent = RegistrationEvent::where('uuid', $registrationEventUuid)->firstOrFail();

            // Verificar si el evento está activo
            $event = Event::where('id', $registrationEvent->event_id)
                ->where('is_active', true)
                ->first();
                
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede confirmar asistencia en un evento inactivo'
                ], 422);
            }
            
            // Verificar si ya existe una asistencia confirmada
            $existingAttendance = EventAttendance::where([
                'registration_event_id' => $registrationEvent->id,
                'event_id' => $registrationEvent->event_id,
                'user_id' => $registrationEvent->registration->user_id
            ])->first();

            if ($existingAttendance) {
                return response()->json([
                    'success' => false,
                    'message' => 'La asistencia ya ha sido confirmada anteriormente'
                ], 422);
            }

            // Crear nueva asistencia
            $attendance = EventAttendance::create([
                'uuid' => Str::uuid(),
                'registration_event_id' => $registrationEvent->id,
                'event_id' => $registrationEvent->event_id,
                'user_id' => $registrationEvent->registration->user_id,
                'status' => true, // Usar boolean true para confirmado
                'checked_in_at' => now(),
                'access_token' => Str::random(20)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Asistencia confirmada correctamente',
                'data' => $attendance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al confirmar la asistencia: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Obtener detalles del evento para modal
     */
    public function getEventDetails($eventUuid)
    {
        try {
            $event = Event::with([
                'modality', 
                'categories', 
                'tags', 
                'programs',
                'speakers',
                'schedules.locations'
            ])->where('uuid', $eventUuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'event' => $event
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener detalles del evento'
            ], 500);
        }
    }
}

