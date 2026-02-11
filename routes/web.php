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

// Siswa Controllers
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\LaporanController as SiswaLaporanController;

/*
| HALAMAN UTAMA
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
            return redirect()->route('guru.laporan.index');
        case 'siswa':
            return redirect()->route('siswa.dashboard');
        default:
            return redirect()->route('login');
    }
});

/*
| AUTH
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

/*
| ADMIN ROUTES
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
        Route::resource('kelas', KelasController::class);
        Route::resource('riwayatlaporan', RiwayatLaporanController::class);
    });

/*
| TEKNISI ROUTES
*/
Route::middleware(['auth', 'role:teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {

        Route::get('/dashboard', [HomeController::class, 'teknisiDashboard'])->name('dashboard');

        Route::resource('laporan', AdminLaporanController::class)
            ->only(['index', 'edit', 'update']);
    });

/*
| GURU ROUTES
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::resource('laporan', AdminLaporanController::class)
            ->only(['index', 'create', 'store']);
    });

/*
| SISWA ROUTES
*/
Route::prefix('siswa')
    ->middleware(['auth', 'role:siswa'])
    ->name('siswa.')
    ->group(function () {

        // Dashboard siswa
        Route::get('/', [SiswaDashboardController::class, 'index'])->name('dashboard');

        // Laporan siswa
        Route::prefix('laporan')->name('laporan.')->group(function () {

            Route::get('/', [SiswaLaporanController::class, 'index'])->name('index');
            Route::get('/create', [SiswaLaporanController::class, 'create'])->name('create');
            Route::post('/', [SiswaLaporanController::class, 'store'])->name('store');

        });
    });

/*
| ROUTE UMUM (SEMUA ROLE LOGIN)
*/
Route::middleware('auth')->group(function () {

    Route::get('/riwayatlaporan', [RiwayatLaporanController::class, 'index'])
        ->name('riwayatlaporan.index');

});
