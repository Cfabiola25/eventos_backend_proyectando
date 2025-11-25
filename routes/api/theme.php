<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/themes', [App\Http\Controllers\Api\V1\Theme\ThemeController::class, 'index']);