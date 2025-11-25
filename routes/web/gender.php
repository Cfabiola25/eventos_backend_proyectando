<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Gender\GenderController;

Route::middleware('auth')->group(function () {
    Route::get('/genders', [GenderController::class, 'index'])->name('genders.index');
    Route::get('/genders/search', [GenderController::class, 'search'])->name('genders.search');
    Route::post('/genders', [GenderController::class, 'store'])->name('genders.store');
    Route::get('/genders/{uuid}/edit', [GenderController::class, 'edit'])->name('genders.edit');
    Route::put('/genders/{uuid}', [GenderController::class, 'update'])->name('genders.update');
    Route::delete('/genders/{uuid}', [GenderController::class, 'destroy'])->name('genders.destroy');
});