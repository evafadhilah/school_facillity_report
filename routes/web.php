<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatLaporanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController; // <-- penting

// HALAMAN PUBLIK
Route::get('/', function () {
    return view('home');
})->name('home.public');

// AUTH ROUTES
Auth::routes();

// LOGOUT (global, POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ROUTE SETELAH LOGIN
Route::middleware('auth')->group(function () {

    // Semua role bisa akses riwayat laporan
    Route::get('/riwayatlaporan', [RiwayatLaporanController::class, 'index'])
        ->name('riwayatlaporan.index');

    // Dashboard role-based
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teknisi':
                return redirect()->route('teknisi.dashboard');
            case 'siswa':
            case 'guru':
                return redirect()->route('laporan.create');
            default:
                abort(403, 'Role tidak dikenali');
        }
    })->name('dashboard');
});

// =======================
// ADMIN ROUTES
// =======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::resource('laporan', LaporanController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('riwayatlaporan', RiwayatLaporanController::class);
});

// =======================
// TEKNISI ROUTES
// =======================
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'teknisiDashboard'])->name('dashboard');
    Route::resource('laporan', LaporanController::class)->only(['edit', 'update']);
});

// =======================
// GURU ROUTES
// =======================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['create', 'store']);
});

// =======================
// SISWA ROUTES
// =======================
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::resource('laporan', LaporanController::class)->only(['create', 'store']);
});
