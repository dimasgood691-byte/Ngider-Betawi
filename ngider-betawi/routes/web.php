<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalWisataController as AdminJadwalWisataController;
use App\Http\Controllers\Admin\KontenController as AdminKontenController;
use App\Http\Controllers\Admin\PaketWisataController as AdminPaketWisataController;
use App\Http\Controllers\Admin\PemesananController as AdminPemesananController;
use App\Http\Controllers\Admin\PosKegiatanController as AdminPosKegiatanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Alur Pemesanan & Tracking Booking
Route::get('/booking/track', [PemesananController::class, 'track'])->name('booking.track');
Route::get('/booking/success/{kode_booking}', [PemesananController::class, 'success'])->name('booking.success');
Route::get('/booking/{paket_id?}', [PemesananController::class, 'create'])->name('booking.create');
Route::post('/booking', [PemesananController::class, 'store'])->name('booking.store');

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

        // 1. Manajemen Pemesanan
        Route::get('/pemesanan', [AdminPemesananController::class, 'index'])->name('pemesanans.index');
        Route::get('/pemesanan/{id}', [AdminPemesananController::class, 'show'])->name('pemesanans.show');
        Route::post('/pemesanan/{id}/verify', [AdminPemesananController::class, 'verifyPayment'])->name('pemesanans.verify');
        Route::delete('/pemesanan/{id}', [AdminPemesananController::class, 'destroy'])->name('pemesanans.destroy');
        Route::get('/pemesanan/{id}/print', [AdminPemesananController::class, 'printTicket'])->name('pemesanans.print');

        // 2. Manajemen Paket Wisata
        Route::resource('/paket-wisata', AdminPaketWisataController::class)
            ->names('pakets')
            ->parameters(['paket-wisata' => 'id']);

        // 3. Manajemen Pos Kegiatan
        Route::resource('/pos-kegiatan', AdminPosKegiatanController::class)
            ->names('pos')
            ->parameters(['pos-kegiatan' => 'id']);

        // 4. Manajemen Jadwal & Kuota Wisata
        Route::resource('/jadwal-wisata', AdminJadwalWisataController::class)
            ->names('jadwals')
            ->parameters(['jadwal-wisata' => 'id']);

        // 5. Manajemen Konten (Funfact, Galeri, Testimoni)
        Route::get('/konten', [AdminKontenController::class, 'index'])->name('konten.index');
        Route::post('/konten/funfact', [AdminKontenController::class, 'storeFunfact'])->name('konten.funfact.store');
        Route::delete('/konten/funfact/{id}', [AdminKontenController::class, 'destroyFunfact'])->name('konten.funfact.destroy');
        Route::post('/konten/galeri', [AdminKontenController::class, 'storeGaleri'])->name('konten.galeri.store');
        Route::delete('/konten/galeri/{id}', [AdminKontenController::class, 'destroyGaleri'])->name('konten.galeri.destroy');
        Route::post('/konten/testimoni', [AdminKontenController::class, 'storeTestimoni'])->name('konten.testimoni.store');
        Route::delete('/konten/testimoni/{id}', [AdminKontenController::class, 'destroyTestimoni'])->name('konten.testimoni.destroy');
    });
});
