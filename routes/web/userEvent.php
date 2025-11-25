<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserEvent\UserEventController;

// Rutas para la gestión de eventos de usuarios

Route::middleware(['auth'])->group(function () {
    Route::get('/user-event-management', [UserEventController::class, 'index'])->name('user-event-management.index');
    Route::post('/user-event-management/search-users', [UserEventController::class, 'searchUsers'])->name('user-event-management.search-users');
    Route::get('/user-event-management/user/{userId}/events', [UserEventController::class, 'getUserEvents'])->name('user-event-management.user-events');
    Route::get('/user-event-management/user/{userId}/available-events', [UserEventController::class, 'getAvailableEvents'])->name('user-event-management.available-events');
    Route::post('/user-event-management/register-event', [UserEventController::class, 'registerToEvent'])->name('user-event-management.register-event');
    Route::delete('/user-event-management/remove-event/{registrationEventId}', [UserEventController::class, 'removeFromEvent'])->name('user-event-management.remove-event');
    Route::get('/user-event-management/user/{userId}/search-available-events', [UserEventController::class, 'searchAvailableEvents'])->name('user-event-management.search-available-events');
});