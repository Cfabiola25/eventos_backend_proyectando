<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Schedules\ScheduleController;

Route::middleware(['auth'])->group(function () {

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/search', [ScheduleController::class, 'search'])->name('schedules.search');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{uuid}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{uuid}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{uuid}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
});