<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UseController;

/*
|--------------------------------------------------------------------------
| User Routes web
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UseController::class, 'index'])->name('index');
    Route::get('/search', [UseController::class, 'search'])->name('search');
    Route::get('/create', [UseController::class, 'create'])->name('create');
    Route::post('/', [UseController::class, 'store'])->name('store');
    Route::get('/{uuid}/edit', [UseController::class, 'edit'])->name('edit');
    Route::put('/{uuid}', [UseController::class, 'update'])->name('update');
    Route::delete('/{uuid}', [UseController::class, 'destroy'])->name('destroy');
    Route::post('/{uuid}/toggle-status', [UseController::class, 'toggleStatus'])->name('toggleStatus');
    // CAMBIO: Actualizar la ruta para aceptar datos POST
    Route::post('/{uuid}/toggle-diploma', [UseController::class, 'toggleDiploma'])->name('toggleDiploma');
    Route::post('/{uuid}/toggle-diploma-admin', [UseController::class, 'toggleDiplomaAdmin'])->name('toggleDiplomaAdmin'); // Sin restricciones para admin
    Route::put('/{uuid}/password', [UseController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/{uuid}/toggle-boolean', [UseController::class, 'toggleBoolean'])->name('toggleBoolean');
    Route::post('/mass-diploma-action', [UseController::class, 'massDiplomaAction'])->name('massDiplomaAction');
});