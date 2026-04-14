<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController as AdminLaporanController;
use App\Http\Controllers\RiwayatLaporanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// Siswa Controllers
use App\Http\Controllers\Siswa\LaporanController as SiswaLaporanController;

// Teknisi Controllers
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\LaporanController as TeknisiLaporanController;

// Guru Controllers
use App\Http\Controllers\Guru\LaporanController as GuruLaporanController;

// Halaman utama
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    switch (auth()->user()->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'teknisi':
            return redirect()->route('teknisi.dashboard');
        case 'guru':
            return redirect()->route('guru.laporan.index');
        case 'siswa':
            return redirect()->route('siswa.laporan.index');
        default:
            return redirect()->route('login');
    }
});

// AUTH - middleware guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
});

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategori', KategoriController::class)->except(['show']);
        Route::resource('lokasi', LokasiController::class);
        Route::resource('laporan', AdminLaporanController::class);
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('riwayatlaporan', RiwayatLaporanController::class);
    });

// Teknisi routes
Route::middleware(['auth', 'role:teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {
        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])->name('dashboard');
        Route::resource('laporan', TeknisiLaporanController::class)->only(['index', 'edit', 'update']);
        Route::get('/riwayat-laporan', [TeknisiLaporanController::class, 'riwayat'])->name('laporan.riwayat');
        Route::get('/laporan/{id}/show', [TeknisiLaporanController::class, 'show'])->name('laporan.show');
        Route::get('/riwayat-laporan/{id}/show', [TeknisiLaporanController::class, 'show'])->name('laporan.riwayat.show');
    });

// Guru routes
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::resource('laporan', GuruLaporanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'show']);
      });

// Siswa routes
Route::prefix('siswa')
    ->middleware(['auth', 'role:siswa'])
    ->name('siswa.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('siswa.laporan.index');
        })->name('dashboard');

        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [SiswaLaporanController::class, 'index'])->name('index');
            Route::get('/create', [SiswaLaporanController::class, 'create'])->name('create');
            Route::post('/', [SiswaLaporanController::class, 'store'])->name('store');
            Route::get('/riwayat', [SiswaLaporanController::class, 'riwayat'])->name('riwayat');
            Route::get('/{id}/edit', [SiswaLaporanController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SiswaLaporanController::class, 'update'])->name('update');
            Route::get('/{id}', [SiswaLaporanController::class, 'show'])->name('show');
            Route::delete('/{id}', [SiswaLaporanController::class, 'destroy'])->name('destroy');
        });
    });

// Route umum semua role login
Route::middleware('auth')->group(function () {
    Route::get('/riwayatlaporan', [RiwayatLaporanController::class, 'index'])->name('riwayatlaporan.index');
});
