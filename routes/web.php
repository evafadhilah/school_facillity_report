<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatLaporanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home.public');

/*
|--------------------------------------------------------------------------
| AUTH (CUSTOM LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [HomeController::class, 'adminDashboard'])
            ->name('dashboard');

        Route::resource('kategori', KategoriController::class);
        Route::resource('laporan', LaporanController::class);
        Route::resource('fasilitas', FasilitasController::class);
        Route::resource('riwayatlaporan', RiwayatLaporanController::class);
    });

/*
|--------------------------------------------------------------------------
| TEKNISI ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {
        Route::get('/dashboard', [HomeController::class, 'teknisiDashboard'])
            ->name('dashboard');

        Route::resource('laporan', LaporanController::class)
            ->only(['edit', 'update']);
    });

/*
|--------------------------------------------------------------------------
| GURU ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::resource('laporan', LaporanController::class)
            ->only(['create', 'store']);
    });

/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::resource('laporan', LaporanController::class)
            ->only(['create', 'store']);
    });

/*
|--------------------------------------------------------------------------
| ROUTE UMUM (SEMUA ROLE LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/riwayatlaporan', [RiwayatLaporanController::class, 'index'])
        ->name('riwayatlaporan.index');
});
