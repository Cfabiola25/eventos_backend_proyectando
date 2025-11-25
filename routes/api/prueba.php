<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('pruebas', [\App\Http\Controllers\Api\V1\Pruebas\PruebasController::class, 'index']);