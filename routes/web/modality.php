<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Modality\ModalityController;

Route::middleware(['auth'])->group(function () {
    // Rutas para Modalidades
    Route::get('/modalities', [ModalityController::class, 'index'])->name('modalities.index');
    Route::get('/modalities/search', [ModalityController::class, 'search'])->name('modalities.search');
    Route::post('/modalities', [ModalityController::class, 'store'])->name('modalities.store');
    Route::get('/modalities/{id}/edit', [ModalityController::class, 'edit'])->name('modalities.edit');
    Route::put('/modalities/{id}', [ModalityController::class, 'update'])->name('modalities.update');
    Route::delete('/modalities/{id}', [ModalityController::class, 'destroy'])->name('modalities.destroy');
    Route::post('/modalities/{id}/toggle-status', [ModalityController::class, 'toggleStatus'])->name('modalities.toggle-status');
});