<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Qr\QrController;

Route::get('qr/{uuid}', [QrController::class, 'index'])->name('qr.index')->middleware('auth');
