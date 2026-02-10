<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hanya laporan milik siswa yang login
        $total = Laporan::where('user_id', Auth::id())->count();
        $pending = Laporan::where('user_id', Auth::id())->where('status', 'pending')->count();
        $selesai = Laporan::where('user_id', Auth::id())->where('status', 'selesai')->count();

        return view('siswa.dashboard', compact('total', 'pending', 'selesai'));
    }
}
