<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $teknisiId = auth()->id();

        $totalDitugaskan = Laporan::where('teknisi_id', $teknisiId)
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->count();

        $totalUrgent = Laporan::where('teknisi_id', $teknisiId)
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->where('tingkat_urgency', 'tinggi')
            ->count();

        $totalDiproses = Laporan::where('teknisi_id', $teknisiId)
            ->where('status', 'diproses')
            ->count();

        $totalSelesaiBulan = Laporan::where('teknisi_id', $teknisiId)
            ->where('status', 'selesai')
            ->whereMonth('tanggal_selesai', now()->month)
            ->whereYear('tanggal_selesai', now()->year)
            ->count();

        $laporanPrioritas = Laporan::where('teknisi_id', $teknisiId)
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->with(['fasilitas', 'lokasi'])
            ->orderByRaw("CASE tingkat_urgency WHEN 'tinggi' THEN 1 WHEN 'sedang' THEN 2 WHEN 'rendah' THEN 3 ELSE 4 END")
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        $statSelesai    = Laporan::where('teknisi_id', $teknisiId)->where('status', 'selesai')->count();
        $statDiproses   = Laporan::where('teknisi_id', $teknisiId)->where('status', 'diproses')->count();
        $statDitugaskan = Laporan::where('teknisi_id', $teknisiId)->where('status', 'ditugaskan')->count();
        $statTotal      = $statSelesai + $statDiproses + $statDitugaskan;

        $chartSelesai = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartSelesai[] = Laporan::where('teknisi_id', $teknisiId)
                ->where('status', 'selesai')
                ->whereMonth('tanggal_selesai', $m)
                ->whereYear('tanggal_selesai', now()->year)
                ->count();
        }

        return view('teknisi.dashboard', compact(
            'totalDitugaskan',
            'totalUrgent',
            'totalDiproses',
            'totalSelesaiBulan',
            'laporanPrioritas',
            'statSelesai',
            'statDiproses',
            'statDitugaskan',
            'statTotal',
            'chartSelesai'
        ));
    }
}
