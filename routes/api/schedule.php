<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('schedules', [App\Http\Controllers\Api\V1\Schedule\ScheduleController::class, 'index']);
 