<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('academic-program', [\App\Http\Controllers\Api\V1\Program\ProgramController::class, 'index']);