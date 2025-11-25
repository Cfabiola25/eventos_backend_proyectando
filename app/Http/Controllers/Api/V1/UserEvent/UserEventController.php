<?php

namespace App\Http\Controllers\Api\V1\UserEvent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;

class UserEventController extends Controller
{
    /**
     * Obtener todos los eventos a los que se registró un usuario
     * 
     * @param Request $request
     * @param string $userUuid
     * @return JsonResponse
     */
    public function getUserEvents(Request $request, string $userUuid)
    {
        try {
            // Buscar el usuario por UUID
            $user = User::where('uuid', $userUuid)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado',
                    'data' => null
                ], 404);
            }

            // Obtener las inscripciones del usuario con sus eventos
            $registrations = Registration::with([
                'subscriptionPlan.modality',
                'events.event' => function($query) {
                    $query->with([
                        'modality',
                        'categories',
                        'tags',
                        'speakers',
                        'locations',
                        'schedules'
                    ]);
                },
                'cityTours.cityTour'
            ])
            ->where('user_id', $user->id)
            ->get();

            // Estructurar la respuesta
            $response = [
                'user' => [
                    'uuid' => $user->uuid,
                    'full_name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'user_type' => $user->userType->type ?? null,
                ],
                'registrations' => $registrations->map(function($registration) {
                    return [
                        'registration_uuid' => $registration->uuid,
                        'subscription_plan' => [
                            'name' => $registration->subscriptionPlan->name,
                            'modality' => $registration->subscriptionPlan->modality->name,
                        ],
                        'registered_at' => $registration->registered_at,
                        'events' => $registration->events->map(function($regEvent) {
                            $event = $regEvent->event;
                            return [
                                'event_uuid' => $event->uuid,
                                'title' => $event->title,
                                'description' => $event->description,
                                'image' => $event->image,
                                'modality' => $event->modality->name,
                                'max_capacity' => $event->max_capacity,
                                'virtual_link' => $event->virtual_link,
                                'color' => $event->color,
                                'is_active' => $event->is_active,
                                'categories' => $event->categories->map(function($category) {
                                    return [
                                        'name' => $category->name,
                                        'description' => $category->description,
                                    ];
                                }),
                                'tags' => $event->tags->map(function($tag) {
                                    return [
                                        'name' => $tag->name,
                                        'color' => $tag->color,
                                    ];
                                }),
                                'speakers' => $event->speakers->map(function($speaker) {
                                    return [
                                        'name' => $speaker->name,
                                        'profession' => $speaker->profession,
                                        'photo' => $speaker->photo,
                                    ];
                                }),
                                'locations' => $event->locations->map(function($location) {
                                    return [
                                        'name' => $location->name,
                                        'address' => $location->address,
                                        'room' => $location->room,
                                    ];
                                }),
                                'schedules' => $event->schedules->map(function($schedule) {
                                    return [
                                        'start_date' => $schedule->start_date,
                                        'end_date' => $schedule->end_date,
                                        'start_time' => $schedule->start_time,
                                        'end_time' => $schedule->end_time,
                                    ];
                                }),
                                'registration_details' => [
                                    'quantity' => $regEvent->quantity,
                                    'notes' => $regEvent->notes,
                                ]
                            ];
                        }),
                        'city_tours' => $registration->cityTours->map(function($cityTourReg) {
                            $cityTour = $cityTourReg->cityTour;
                            return [
                                'city_tour_uuid' => $cityTour->uuid,
                                'name' => $cityTour->name,
                                'description' => $cityTour->description,
                                'tour_date' => $cityTour->tour_date,
                                'tour_time' => $cityTour->tour_time,
                                'max_capacity' => $cityTour->max_capacity,
                                'registration_details' => [
                                    'quantity' => $cityTourReg->quantity,
                                    'status' => $cityTourReg->status,
                                ]
                            ];
                        })
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'message' => 'Eventos del usuario obtenidos exitosamente',
                'data' => $response
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los eventos del usuario: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

}
