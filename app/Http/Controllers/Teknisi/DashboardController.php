<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth; // ← ini yang kurang


class DashboardController extends Controller
{
     public function index()
    {
        $user = Auth::user();

        $totalAssigned = Laporan::where('teknisi_id', $user->id)->count();
        $totalBaru     = Laporan::where('teknisi_id', $user->id)->where('status', 'ditugaskan')->count();
        $totalDiproses = Laporan::where('teknisi_id', $user->id)->where('status', 'diproses')->count();
        $totalSelesai  = Laporan::where('teknisi_id', $user->id)->where('status', 'selesai')->count();

        $laporanPrioritas = Laporan::where('teknisi_id', $user->id)
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->with(['fasilitas', 'kelas', 'lokasi'])
            ->orderByRaw("FIELD(tingkat_urgency, 'tinggi', 'sedang', 'rendah')")
            ->take(5)
            ->get();

        $riwayatSelesai = Laporan::where('teknisi_id', $user->id)
            ->where('status', 'selesai')
            ->with(['fasilitas', 'lokasi'])
            ->latest('tanggal_selesai')
            ->take(5)
            ->get();

        return view('teknisi.dashboard', compact(
            'totalAssigned',
            'totalBaru',
            'totalDiproses',
            'totalSelesai',
            'laporanPrioritas',
            'riwayatSelesai'
        ));
    }
}
