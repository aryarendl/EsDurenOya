<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login owner
Route::get('/login', [HomeController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [HomeController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout')->middleware('auth');

// CRUD menu (hanya owner)
Route::middleware('auth')->group(function () {
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
});