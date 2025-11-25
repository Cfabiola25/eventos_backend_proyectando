<?php

use App\Http\Controllers\Api\V1\EventReview\EventReviewController;
use Illuminate\Support\Facades\Route;

// Guardar una nueva reseña
Route::post('event-reviews/', [EventReviewController::class, 'store'])->middleware('auth:sanctum');

// Obtener reseñas de un usuario específico
Route::get('event-reviews/user/{userId}', [EventReviewController::class, 'getUserReviews'])->middleware('auth:sanctum');

// Obtener reseñas de un evento específico (solo reseñas no anónimas)
Route::get('event-reviews/event/{eventId}', [EventReviewController::class, 'getEventReviews']);
