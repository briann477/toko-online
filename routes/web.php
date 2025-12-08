<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

// Halaman awal → daftar produk
Route::redirect('/', '/products');

// ========== Auth ==========
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== Publik ==========
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// ========== Dashboard (harus login) ==========
Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ========== Admin Only (harus login + admin) ==========
Route::middleware(['auth', 'admin'])->group(function () {
  Route::resource('products', ProductController::class)->except(['index', 'show']);
});
