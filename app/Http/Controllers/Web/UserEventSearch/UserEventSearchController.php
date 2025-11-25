<?php

namespace App\Http\Controllers\Web\UserEventSearch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserEventSearchController extends Controller
{
    public function index()
    {
        return view('userEventSeach.index');
    }

    public function search(Request $request)
    {
        try {
            $request->validate([
                'search_term' => 'required|string|min:3'
            ]);

            $searchTerm = $request->search_term;

            $users = User::with(['registrations.subscriptionPlan', 'registrations.events'])
                ->where(function($query) use ($searchTerm) {
                    $query->where('first_name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('document_number', 'LIKE', "%{$searchTerm}%")
                        ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$searchTerm}%");
                })
                ->where('status', true)
                ->orderBy('first_name')
                ->get();

            return response()->json([
                'success' => true,
                'users' => $users,
                'html' => view('userEventSeach.components.search-results', compact('users'))->render()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en búsqueda de usuarios: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda: ' . $e->getMessage(),
                'html' => '<div class="text-center py-8 text-red-500">Error al realizar la búsqueda</div>'
            ], 500);
        }
    }

    public function getUserDetail($uuid)
    {
        try {
            $user = User::with([
                'registrations.subscriptionPlan',
                'registrations.events' => function($query) {
                    $query->with(['schedules', 'locations', 'speakers']);
                },
                'gender',
                'documentType',
                'userType'
            ])->where('uuid', $uuid)->firstOrFail();

            $availableEvents = Event::with(['schedules', 'locations', 'speakers'])
                ->where('is_active', true)
                ->orderBy('title')
                ->get();

            return response()->json([
                'success' => true,
                'user' => $user,
                'availableEvents' => $availableEvents,
                'html' => view('userEventSeach.components.user-detail-modal', compact('user', 'availableEvents'))->render()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al obtener detalle de usuario: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar detalles: ' . $e->getMessage()
            ], 500);
        }
    }

    public function assignEvent(Request $request, $userUuid)
    {
        try {
            $request->validate([
                'event_id' => 'required|exists:events,id',
                'registration_id' => 'required|exists:registrations,id'
            ]);

            $user = User::where('uuid', $userUuid)->firstOrFail();
            $registration = Registration::where('id', $request->registration_id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            // Verificar si ya está registrado en el evento
            $existingRegistration = DB::table('registration_event')
                ->where('registration_id', $registration->id)
                ->where('event_id', $request->event_id)
                ->first();

            if ($existingRegistration) {
                return response()->json([
                    'success' => false,
                    'message' => 'El usuario ya está registrado en este evento'
                ], 422);
            }

            // Asignar evento
            DB::table('registration_event')->insert([
                'uuid' => \Illuminate\Support\Str::uuid(),
                'registration_id' => $registration->id,
                'event_id' => $request->event_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Recargar datos actualizados
            $user->load(['registrations.events']);

            return response()->json([
                'success' => true,
                'message' => 'Evento asignado correctamente',
                'html' => view('userEventSeach.components.user-events-list', compact('user'))->render()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al asignar evento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al asignar el evento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeEvent(Request $request, $userUuid)
    {
        try {
            $request->validate([
                'registration_event_id' => 'required|exists:registration_event,id'
            ]);

            $user = User::where('uuid', $userUuid)->firstOrFail();

            DB::table('registration_event')
                ->where('id', $request->registration_event_id)
                ->delete();

            // Recargar datos actualizados
            $user->load(['registrations.events']);

            return response()->json([
                'success' => true,
                'message' => 'Evento removido correctamente',
                'html' => view('userEventSeach.components.user-events-list', compact('user'))->render()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al remover evento: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al remover el evento: ' . $e->getMessage()
            ], 500);
        }
    }
}
