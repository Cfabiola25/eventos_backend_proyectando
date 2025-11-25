<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserType\UserTypeController;

Route::middleware('auth')->group(function () {
    Route::get('usertypes', [UserTypeController::class, 'index'])->name('usertypes.index');
    Route::post('usertypes', [UserTypeController::class, 'store'])->name('usertypes.store');
    Route::get('usertypes/{uuid}/edit', [UserTypeController::class, 'edit'])->name('usertypes.edit');
    Route::put('usertypes/{uuid}', [UserTypeController::class, 'update'])->name('usertypes.update');
    Route::delete('usertypes/{uuid}', [UserTypeController::class, 'destroy'])->name('usertypes.destroy');
    Route::patch('usertypes/{uuid}/toggle-status', [UserTypeController::class, 'toggleStatus'])->name('usertypes.toggle-status');
});