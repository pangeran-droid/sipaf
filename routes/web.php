<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\JurusanManagementController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AiAsistenController;

// ==========================================
// 1. ROUTE PUBLIK (FRONTEND)
// ==========================================
Route::get('/', [PublicController::class, 'beranda'])->name('home');
Route::get('/buat-pengaduan', [PublicController::class, 'createPengaduan'])->name('pengaduan.create');
Route::post('/buat-pengaduan', [PublicController::class, 'storePengaduan'])->name('pengaduan.store');
Route::get('/antrian-pengaduan', [PublicController::class, 'antrian'])->name('pengaduan.antrian');
Route::get('/tentang-sistem', [PublicController::class, 'tentang'])->name('tentang');

// ==========================================
// 2. ROUTE AREA ADMIN (PROTECTED)
// ==========================================
Route::middleware(['auth', 'role:super_admin,admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengaduan Management
    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('/pengaduan/{id}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');

    // Laporan Pengaduan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Ai Asisten
    Route::get('/ai-asisten', [AiAsistenController::class, 'index'])->name('ai-asisten.index');
    Route::post('/ai-asisten/tanya', [AiAsistenController::class, 'tanya'])->name('ai-asisten.tanya');

    // Khusus Super Admin (Manajemen Admin & Jurusan)
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('manajemen-admin', AdminManagementController::class)->parameters(['manajemen-admin' => 'id']);
        Route::resource('jurusan', JurusanManagementController::class)->parameters(['jurusan' => 'id']);
    });
});

// ==========================================
// 3. ROUTE AUTHENTICATION (Breeze / Default)
// ==========================================
require __DIR__.'/auth.php';
