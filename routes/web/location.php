<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Locations\LocationController;

/*
|--------------------------------------------------------------------------
| Location Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('locations')->name('locations.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/search', [LocationController::class, 'search'])->name('search');
    Route::get('/create', [LocationController::class, 'create'])->name('create');
    Route::post('/', [LocationController::class, 'store'])->name('store');
    Route::get('/{uuid}/edit', [LocationController::class, 'edit'])->name('edit');
    Route::put('/{uuid}', [LocationController::class, 'update'])->name('update');
    Route::delete('/{uuid}', [LocationController::class, 'destroy'])->name('destroy');
    Route::post('/{uuid}/toggle-status', [LocationController::class, 'toggleStatus'])->name('toggleStatus');
});