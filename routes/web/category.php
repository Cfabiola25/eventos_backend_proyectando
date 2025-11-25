<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Category\CategoryController;

Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{uuid}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{uuid}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{uuid}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});