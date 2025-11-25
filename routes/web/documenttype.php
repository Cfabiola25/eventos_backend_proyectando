<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DocumentType\DocumentTypeController;

Route::middleware('auth')->group(function () {
    Route::get('documenttypes', [DocumentTypeController::class, 'index'])->name('documenttypes.index');
    Route::post('documenttypes', [DocumentTypeController::class, 'store'])->name('documenttypes.store');
    Route::get('documenttypes/{uuid}/edit', [DocumentTypeController::class, 'edit'])->name('documenttypes.edit');
    Route::put('documenttypes/{uuid}', [DocumentTypeController::class, 'update'])->name('documenttypes.update');
    Route::delete('documenttypes/{uuid}', [DocumentTypeController::class, 'destroy'])->name('documenttypes.destroy');
    Route::patch('documenttypes/{uuid}/toggle-status', [DocumentTypeController::class, 'toggleStatus'])->name('documenttypes.toggle-status');
});