<?php

use App\Http\Controllers\Api\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

// Rutas básicas para Categories web
Route::get('/categories', [CategoryController::class, 'index']);