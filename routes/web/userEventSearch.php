<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserEventSearch\UserEventSearchController;

Route::middleware(['auth'])->prefix('user-search-events')->name('user-search-events.')->group(function () {
    Route::get('/', [UserEventSearchController::class, 'index'])->name('index');
    Route::post('/search', [UserEventSearchController::class, 'search'])->name('search');
    Route::get('/user/{uuid}/detail', [UserEventSearchController::class, 'getUserDetail'])->name('user.detail');
    Route::post('/user/{uuid}/assign-event', [UserEventSearchController::class, 'assignEvent'])->name('event.assign');
    Route::post('/user/{uuid}/remove-event', [UserEventSearchController::class, 'removeEvent'])->name('event.remove');
});

