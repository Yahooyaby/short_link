<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/store',[UrlController::class,'store'])->name('url.store');

Route::get('/dashboard',[UrlController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/redirect_counter/{code}',[UrlController::class,'redirect_counter'])->name('url.redirect_counter');

Route::delete('/dashboard/{url}', [UrlController::class, 'destroy'])->name('url.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
