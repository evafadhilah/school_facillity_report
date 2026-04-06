<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman home default
    public function index()
    {
        return view('home'); // bisa ubah sesuai halaman home umum
    }

    // Halaman dashboard admin
    public function adminDashboard()
    {
        return view('admin.dashboard'); // pastikan file ini ada di resources/views/admin/dashboard.blade.php
    }

    // Halaman dashboard teknisi
    public function teknisiDashboard()
    {
        $userId = auth()->id();

        $totalAssigned = Laporan::where('teknisi_id', $userId)->count();

        $totalBaru = Laporan::where('teknisi_id', $userId)
            ->where('status', 'ditugaskan')
            ->count();

        $totalDiproses = Laporan::where('teknisi_id', $userId)
            ->where('status', 'diproses')
            ->count();

        $totalSelesai = Laporan::where('teknisi_id', $userId)
            ->where('status', 'selesai')
            ->count();

        $totalUrgen = Laporan::where('teknisi_id', $userId)
            ->where('tingkat_urgency', 'tinggi')
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->count();

        $laporanPrioritas = Laporan::with(['fasilitas', 'lokasi', 'kelas'])
            ->where('teknisi_id', $userId)
            ->whereIn('status', ['ditugaskan', 'diproses'])
            ->orderByRaw("CASE tingkat_urgency WHEN 'tinggi' THEN 1 WHEN 'sedang' THEN 2 ELSE 3 END")
            ->latest()
            ->take(5)
            ->get();

        $riwayatSelesai = Laporan::with(['fasilitas', 'lokasi'])
            ->where('teknisi_id', $userId)
            ->where('status', 'selesai')
            ->latest('tanggal_selesai')
            ->take(5)
            ->get();

        return view('teknisi.dashboard', compact(
            'totalAssigned',
            'totalBaru',
            'totalDiproses',
            'totalSelesai',
            'totalUrgen',
            'laporanPrioritas',
            'riwayatSelesai'
        ));
    }
}
