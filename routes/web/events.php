<?php

// routes/web.php
use App\Http\Controllers\Web\Event\EventController;

Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{uuid}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{uuid}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{uuid}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::post('/events/{uuid}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggle-status');
    Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
    
    // Agregar esta ruta para el show (modal de detalles)
    Route::get('/events/{uuid}', [EventController::class, 'show'])->name('events.show');
});