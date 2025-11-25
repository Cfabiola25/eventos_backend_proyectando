<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\EventAttendance\EventAttendanceController;

// Rutas para Event Attendance web (asistencia eventos) con prefijo consistente
Route::middleware(['auth'])->group(function () {
    // Gestión de eventos y asistencias
    Route::get('/event-attendances', [EventAttendanceController::class, 'index'])->name('event-attendances.index');
    Route::post('/event-attendances/search-events', [EventAttendanceController::class, 'searchEvents'])->name('event-attendances.search-events');
    Route::get('/event-attendances/{eventUuid}/attendances', [EventAttendanceController::class, 'showEventAttendances'])->name('event-attendances.show-attendances');
    Route::post('/event-attendances/{eventUuid}/search-attendances', [EventAttendanceController::class, 'searchEventAttendances'])->name('event-attendances.search-attendances');
    Route::post('/event-attendances/{attendanceUuid}/confirm-attendance', [EventAttendanceController::class, 'confirmAttendance'])->name('event-attendances.confirm-attendance');
    Route::get('/event-attendances/{eventUuid}/details', [EventAttendanceController::class, 'getEventDetails'])->name('event-attendances.event-details');
});