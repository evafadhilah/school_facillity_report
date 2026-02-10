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

// Siswa Controllers
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\LaporanController as SiswaLaporanController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
| Jika belum login → login
| Jika sudah login → redirect sesuai role
*/
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
            return redirect()->route('guru.laporan.create');
        case 'siswa':
            return redirect()->route('siswa.dashboard'); // diarahkan ke dashboard siswa
        default:
            return redirect()->route('login');
    }
});

/*
|--------------------------------------------------------------------------
| AUTH (CUSTOM LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');

        Route::resource('kategori', KategoriController::class);
        Route::resource('lokasi', LokasiController::class);
        Route::resource('laporan', AdminLaporanController::class);
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
        Route::get('/dashboard', [HomeController::class, 'teknisiDashboard'])->name('dashboard');

        Route::resource('laporan', AdminLaporanController::class)
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
        Route::resource('laporan', AdminLaporanController::class)
            ->only(['create', 'store']);
    });

/*
|--------------------------------------------------------------------------
| SISWA ROUTES (Dashboard + Laporan)
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {

    // Dashboard siswa
    Route::get('/', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');

    // Laporan siswa
    Route::prefix('laporan')->group(function () {
        Route::get('/', [SiswaLaporanController::class, 'index'])->name('siswa.laporan.index');
        Route::get('/create', [SiswaLaporanController::class, 'create'])->name('siswa.laporan.create');
        Route::post('/', [SiswaLaporanController::class, 'store'])->name('siswa.laporan.store');
    });

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
