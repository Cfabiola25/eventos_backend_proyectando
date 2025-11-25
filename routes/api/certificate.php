<?php

use App\Http\Controllers\Api\V1\Certificate\CertificateDownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/certificates/download/{uuid}', [CertificateDownloadController::class, 'download'])->middleware('auth:sanctum');
Route::get('/user/{uuid}/download-status', [CertificateDownloadController::class, 'getDownloadStatus'])->middleware('auth:sanctum');