<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('file', [\App\Http\Controllers\FileController::class, 'getFile'])->name('file');

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/web/events.php';
require __DIR__.'/web/gender.php';
require __DIR__.'/web/agenda.php';
require __DIR__.'/web/tag.php';
require __DIR__.'/web/location.php';
require __DIR__.'/web/usertype.php';
require __DIR__.'/web/documenttype.php';
require __DIR__.'/auth.php';
require __DIR__.'/web/user.php';
require __DIR__.'/web/speakers.php';
require __DIR__.'/web/theme.php';
require __DIR__.'/web/eventAttendance.php';
require __DIR__.'/web/schedule.php';
require __DIR__.'/web/category.php';
require __DIR__.'/web/userEventSearch.php';
require __DIR__.'/web/modality.php';
require __DIR__.'/web/program.php';
require __DIR__.'/web/userEvent.php';
require __DIR__.'/web/qr.php';
