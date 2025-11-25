<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('agenda', [\App\Http\Controllers\Api\V1\Agenda\AgendaController::class, 'index']);