<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Theme\ThemeController;

// Rutas para Temas web
Route::get('themes', [ThemeController::class, 'index'])->name('theme.index')->middleware('auth');
Route::post('themes', [ThemeController::class, 'store'])->name('theme.store')->middleware('auth');
Route::get('themes/{uuid}/edit', [ThemeController::class, 'edit'])->name('theme.edit')->middleware('auth');
Route::put('themes/{uuid}', [ThemeController::class, 'update'])->name('theme.update')->middleware('auth');
Route::delete('themes/{uuid}', [ThemeController::class, 'destroy'])->name('theme.destroy')->middleware('auth');