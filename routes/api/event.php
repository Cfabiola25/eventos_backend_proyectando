<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('events/{uuid}', [\App\Http\Controllers\Api\V1\Event\EventController::class, 'index']);

Route::get('calendar/events', [\App\Http\Controllers\Api\V1\Event\EventCalendarController::class, 'index']);

Route::post('registerEvent', [\App\Http\Controllers\Api\V1\Event\EventController::class, 'store']);