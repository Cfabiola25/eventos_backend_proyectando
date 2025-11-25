<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('profile/{uuid}', [\App\Http\Controllers\Api\V1\Profile\ProfileController::class, 'show'])->middleware('auth:sanctum');
Route::put('profile/{uuid}', [\App\Http\Controllers\Api\V1\Profile\ProfileController::class, 'update'])->middleware('auth:sanctum');