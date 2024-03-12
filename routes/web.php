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
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('urls.index');
    });
    Route::post('/urls/store',[UrlController::class,'store'])->name('urls.store');
    Route::get('/urls',[UrlController::class,'index'])->name('urls.index');
    Route::get('/redirect_counter/{code}',[UrlController::class,'redirect_counter'])->name('urls.redirect_counter');
    Route::delete('/urls/{url}', [UrlController::class, 'destroy'])->name('urls.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
