<?php

use App\Http\Controllers\KasirController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
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
    Route::patch('/menu/{menu}/update-stok', [MenuController::class, 'updateStok'])->name('menu.updateStok');
    

// Edit Website / Settings 
    Route::get('/admin/settings', [AdminController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'update'])->name('admin.settings.update');

 // --- KASIR ---
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir', [KasirController::class, 'store'])->name('kasir.store');
    Route::get('/kasir/laporan', [KasirController::class, 'laporan'])->name('kasir.laporan');
    Route::patch('/kasir/menu/{menu}/sold-out', [KasirController::class, 'toggleSoldOut'])->name('kasir.soldout');
});