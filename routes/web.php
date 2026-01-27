<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatLaporanController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HALAMAN PUBLIK
Route::get('/', function () {
    return view('home');
});

// AUTH
Auth::routes();

// ROUTE SETELAH LOGIN
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Riwayat Laporan (semua role login bisa akses)
    Route::post('/riwayat', [RiwayatLaporanController::class, 'store'])
        ->name('riwayat.store');

    Route::delete('/riwayat/{riwayat}', [RiwayatLaporanController::class, 'destroy'])
        ->name('riwayat.destroy');
});

// MASTER DATA KHUSUS ROLE
// Admin hanya bisa akses kategori & laporan
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('laporan', LaporanController::class);
});

// Guru hanya bisa lihat laporan
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['index', 'show']);
});

// Siswa hanya bisa buat laporan baru
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['create', 'store']);
});

// Teknisi hanya bisa update status laporan
Route::middleware(['auth', 'role:teknisi'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['edit', 'update']);
});
