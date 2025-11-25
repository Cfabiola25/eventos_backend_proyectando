<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Tag\TagController;

Route::middleware('auth')->group(function () {
    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('tags/search', [TagController::class, 'search'])->name('tags.search');
    Route::post('tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('tags/{uuid}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('tags/{uuid}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('tags/{uuid}', [TagController::class, 'destroy'])->name('tags.destroy');
});