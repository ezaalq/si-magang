<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\AbsensiController;
use App\Http\Controllers\Mahasiswa\TugasController;
use App\Http\Controllers\Mahasiswa\LaporanAkhirController;
use App\Http\Controllers\Mahasiswa\SertifikatController;
use App\Http\Controllers\Mahasiswa\ProfileController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Routes (Auth)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    // All mahasiswa routes

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Absensi
        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('/', [AbsensiController::class, 'index'])->name('index');
            Route::get('/create', [AbsensiController::class, 'create'])->name('create');
            Route::post('/', [AbsensiController::class, 'store'])->name('store');
        });

        // Tugas Kegiatan Harian
        Route::prefix('tugas')->name('tugas.')->group(function () {
            Route::get('/', [TugasController::class, 'index'])->name('index');
            Route::get('/{id}', [TugasController::class, 'show'])->name('show');
            Route::post('/{id}/upload', [TugasController::class, 'upload'])->name('upload');
        });

        // Laporan Akhir
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanAkhirController::class, 'index'])->name('index');
            Route::get('/create', [LaporanAkhirController::class, 'create'])->name('create');
            Route::post('/', [LaporanAkhirController::class, 'store'])->name('store');
        });

        // Sertifikat
        Route::prefix('sertifikat')->name('sertifikat.')->group(function () {
            Route::get('/', [SertifikatController::class, 'index'])->name('index');
            Route::get('/{id}/download', [SertifikatController::class, 'download'])->name('download');
        });

        // Profile
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/update', [ProfileController::class, 'update'])->name('update');
            Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
            Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
            });
        });
    // });
});
