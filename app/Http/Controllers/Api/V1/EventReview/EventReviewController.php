<?php

namespace App\Http\Controllers\Api\V1\EventReview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\EventReview;
use App\Models\Event;
use App\Models\EventAttendance;

class EventReviewController extends Controller
{
    /**
     * Guardar una nueva reseña de evento
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'event_attendance_id' => 'nullable|exists:event_attendances,id',
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'is_anonymous' => 'boolean',
            'is_positive' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Verificar si el usuario ya hizo una reseña para este evento
            $existingReview = EventReview::where('user_id', $request->user_id)
                ->where('event_id', $request->event_id)
                ->first();

            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ya has realizado una reseña para este evento'
                ], 422);
            }

            // Verificar que el evento existe
            $event = Event::find($request->event_id);
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'El evento no existe'
                ], 404);
            }

            // Verificar que el event_attendance_id pertenece al usuario y evento (si se proporciona)
            if ($request->has('event_attendance_id') && $request->event_attendance_id) {
                $attendance = EventAttendance::where('id', $request->event_attendance_id)
                    ->where('user_id', $request->user_id)
                    ->where('event_id', $request->event_id)
                    ->first();

                if (!$attendance) {
                    return response()->json([
                        'success' => false,
                        'message' => 'La asistencia proporcionada no corresponde al usuario y evento'
                    ], 422);
                }
            }

            // Calcular automáticamente is_positive basado en el rating si no se proporciona
            $isPositive = $request->is_positive;
            if (is_null($isPositive) && !is_null($request->rating)) {
                $isPositive = $request->rating >= 3; // 3+ estrellas = positiva
            }

            // Crear la reseña
            $eventReview = EventReview::create([
                'user_id' => $request->user_id,
                'event_id' => $request->event_id,
                'event_attendance_id' => $request->event_attendance_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_anonymous' => $request->is_anonymous ?? false,
                'is_positive' => $isPositive,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reseña guardada exitosamente',
                'data' => [
                    'id' => $eventReview->id,
                    'uuid' => $eventReview->uuid,
                    'rating' => $eventReview->rating,
                    'comment' => $eventReview->comment,
                    'is_anonymous' => $eventReview->is_anonymous,
                    'is_positive' => $eventReview->is_positive,
                    'created_at' => $eventReview->created_at
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la reseña: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener las reseñas de un usuario específico
     */
    public function getUserReviews($userId)
    {
        try {
            $reviews = EventReview::with(['event:id,title', 'eventAttendance:id,access_token'])
                ->where('user_id', $userId)
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'uuid' => $review->uuid,
                        'event_title' => $review->event->title,
                        'rating' => $review->rating,
                        'comment' => $review->comment,
                        'is_anonymous' => $review->is_anonymous,
                        'is_positive' => $review->is_positive,
                        'created_at' => $review->created_at->format('Y-m-d H:i:s')
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las reseñas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener las reseñas de un evento específico
     */
    public function getEventReviews($eventId)
    {
        try {
            $reviews = EventReview::with(['user:id,first_name,last_name,email'])
                ->where('event_id', $eventId)
                ->where('is_anonymous', false) // Solo reseñas no anónimas
                ->whereNull('deleted_at')
                ->get()
                ->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'uuid' => $review->uuid,
                        'user_name' => $review->user->first_name . ' ' . $review->user->last_name,
                        'rating' => $review->rating,
                        'comment' => $review->comment,
                        'is_positive' => $review->is_positive,
                        'created_at' => $review->created_at->format('Y-m-d H:i:s')
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $reviews
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las reseñas del evento: ' . $e->getMessage()
            ], 500);
        }
    }
}
