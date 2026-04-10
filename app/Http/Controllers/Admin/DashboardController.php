<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = now()->year;

        // ── Stat Cards ──
        $totalLaporan  = Laporan::count();
        $totalDiproses = Laporan::whereIn('status', ['ditugaskan', 'diproses'])->count();
        $totalSelesai  = Laporan::where('status', 'selesai')->count();

        // ── Bar Chart: laporan masuk & selesai per bulan ──
        $masukPerBulan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $selesaiPerBulan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->where('status', 'selesai')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Susun array 12 bulan (index 0 = Jan, index 11 = Des)
        $chartMasuk   = [];
        $chartSelesai = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartMasuk[]   = $masukPerBulan[$i]   ?? 0;
            $chartSelesai[] = $selesaiPerBulan[$i] ?? 0;
        }

        // ── Donut Chart: jumlah per status ──
        // Urutan: pending, ditugaskan, diproses, selesai, ditolak
        $statusCount = Laporan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusData = [
            $statusCount['pending']    ?? 0,
            $statusCount['ditugaskan'] ?? 0,
            $statusCount['diproses']   ?? 0,
            $statusCount['selesai']    ?? 0,
            $statusCount['ditolak']    ?? 0,
        ];

        // ── Tabel ──
        $laporanTerbaru = Laporan::with(['user', 'fasilitas', 'lokasi', 'kelas'])
            ->latest()
            ->take(5)
            ->get();

        $laporanUrgent = Laporan::with(['user', 'fasilitas', 'lokasi'])
            ->where('tingkat_urgency', 'tinggi')
            ->whereNotIn('status', ['selesai', 'ditolak'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'totalDiproses',
            'totalSelesai',
            'chartMasuk',
            'chartSelesai',
            'statusData',
            'laporanTerbaru',
            'laporanUrgent'
        ));
    }
}
