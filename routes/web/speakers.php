<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Speakers\SpeakerController;

/*
|--------------------------------------------------------------------------
| Speaker Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('speakers')->name('speakers.')->group(function () {
    // LISTA DE PONENTES
    Route::get('/', [SpeakerController::class, 'index'])->name('index');
    
    // BÚSQUEDA AJAX
    Route::get('/search', [SpeakerController::class, 'search'])->name('search');
    
    // CREAR PONENTE
    Route::get('/create', [SpeakerController::class, 'create'])->name('create');
    Route::post('/', [SpeakerController::class, 'store'])->name('store');
    
    // VER DETALLES (FALTABA)
    Route::get('/{id}', [SpeakerController::class, 'show'])->name('show');
    
    // EDITAR PONENTE
    Route::get('/{id}/edit', [SpeakerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SpeakerController::class, 'update'])->name('update');
    
    // ELIMINAR PONENTE
    Route::delete('/{id}', [SpeakerController::class, 'destroy'])->name('destroy');
    
    // CAMBIAR ESTADO
    Route::post('/{id}/toggle-status', [SpeakerController::class, 'toggleStatus'])->name('toggleStatus');
    
    // ELIMINAR FOTO (NUEVA)
    Route::delete('/{id}/photo', [SpeakerController::class, 'deletePhoto'])->name('deletePhoto');
    
    // RESTAURAR PONENTE ELIMINADO (FALTABA)
    Route::post('/{id}/restore', [SpeakerController::class, 'restore'])->name('restore');
});