<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PemesananController as AdminPemesananController; // 1. Import Controller Admin Pemesanan

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Alur Pemesanan & Tracking Booking
Route::get('/booking/{paket_id?}', [PemesananController::class, 'create'])->name('booking.create');
Route::post('/booking', [PemesananController::class, 'store'])->name('booking.store');
Route::get('/booking/track', [PemesananController::class, 'track'])->name('booking.track');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // --- Guest Only (Belum Login) ---
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    });

    // --- Protected Admin Area (Wajib Login & Role Admin) ---
    Route::middleware(['auth', 'is_admin'])->group(function () {

        // Auth Action
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard Utama
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // 2. Tambahkan Route Pemesanan Admin di sini
        Route::get('/pemesanan', [AdminPemesananController::class, 'index'])->name('pemesanans.index');
    });
});
