<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register']);

Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login'])->middleware('throttle:4,1');

Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LogoutController::class, 'logout'])->middleware('auth:sanctum');