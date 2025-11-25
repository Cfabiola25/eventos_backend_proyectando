<?php

use App\Http\Controllers\Api\V1\Modality\ModalityController;
use Illuminate\Support\Facades\Route;

// Ruta para obtener todas las modalidades
Route::get('/modalities', [ModalityController::class, 'index']);