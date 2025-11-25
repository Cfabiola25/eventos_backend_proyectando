<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Agenda\AgendaController;


// Rutas para Agenda web
Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index')->middleware('auth');
Route::get('agenda/{uuid}/edit', [AgendaController::class, 'edit'])->name('agenda.edit')->middleware('auth');
Route::put('agenda/{uuid}', [AgendaController::class, 'update'])->name('agenda.update')->middleware('auth');
Route::delete('agenda/{uuid}', [AgendaController::class, 'destroy'])->name('agenda.destroy')->middleware('auth');