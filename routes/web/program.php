<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Program\ProgramController;

Route::middleware(['auth'])->group(function () {
    // Rutas para Programas
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/programs/search', [ProgramController::class, 'search'])->name('programs.search');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/programs/{uuid}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::put('/programs/{uuid}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{uuid}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::post('/programs/{uuid}/toggle-status', [ProgramController::class, 'toggleStatus'])->name('programs.toggle-status');
});