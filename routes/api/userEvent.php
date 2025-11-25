<?php

use App\Http\Controllers\Api\V1\UserEvent\UserEventController;
use Illuminate\Support\Facades\Route;


    // Obtener todos los eventos de un usuario
    Route::get('user/{userUuid}/events', [UserEventController::class, 'getUserEvents'])->middleware('auth:sanctum');
    
    // Obtener eventos con filtros
    Route::get('user/{userUuid}/events/filtered', [UserEventController::class, 'getUserEventsFiltered'])->middleware('auth:sanctum');

    // Obtener solo los eventos (respuesta simplificada)
    Route::get('user/{userUuid}/events/simple', [UserEventController::class, 'getUserEventsSimple'])->middleware('auth:sanctum');
