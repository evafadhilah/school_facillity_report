<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalLaporan    = Laporan::count();
        $laporanPending  = Laporan::where('status', 'pending')->count();
        $sedangDiproses  = Laporan::where('status', 'diproses')->count();
        $laporanSelesai  = Laporan::where('status', 'selesai')->count();

        // Laporan Terbaru (5 terakhir)
        $laporanTerbaru = Laporan::with(['fasilitas', 'lokasi'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($l) => [
                'id'              => $l->id,
                'pelapor'         => $l->nama_pelapor ?? '-',
                'fasilitas'       => $l->fasilitas->nama_fasilitas ?? '-',
                'lokasi'          => $l->lokasi->nama_lokasi ?? '-',
                'tingkat_urgency' => $l->tingkat_urgency,
                'status'          => $l->status,
                'tanggal'         => $l->created_at->format('d/m/Y'),
            ]);

        // Urgency Tinggi
        $urgencyTinggi = Laporan::with(['fasilitas'])
            ->where('tingkat_urgency', 'tinggi')
            ->whereIn('status', ['pending', 'diproses'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($l) => [
                'id'        => $l->id,
                'pelapor'   => $l->nama_pelapor ?? '-',
                'fasilitas' => $l->fasilitas->nama_fasilitas ?? '-',
                'status'    => $l->status,
            ]);

        // Laporan Pending
        $pending = Laporan::with(['fasilitas'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($l) => [
                'id'              => $l->id,
                'pelapor'         => $l->nama_pelapor ?? '-',
                'fasilitas'       => $l->fasilitas->nama_fasilitas ?? '-',
                'tingkat_urgency' => $l->tingkat_urgency,
                'tanggal'         => $l->created_at->format('d/m/Y'),
            ]);

        // Riwayat Selesai
        $riwayatSelesai = Laporan::with(['fasilitas', 'lokasi'])
            ->where('status', 'selesai')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($l) => [
                'id'        => $l->id,
                'pelapor'   => $l->nama_pelapor ?? '-',
                'fasilitas' => $l->fasilitas->nama_fasilitas ?? '-',
                'lokasi'    => $l->lokasi->nama_lokasi ?? '-',
                'selesai'   => $l->tanggal_selesai
                                    ? $l->tanggal_selesai->format('d/m/Y')
                                    : $l->updated_at->format('d/m/Y'),
            ]);

        return response()->json([
            'statistik' => [
                'total_laporan'   => $totalLaporan,
                'laporan_pending' => $laporanPending,
                'sedang_diproses' => $sedangDiproses,
                'laporan_selesai' => $laporanSelesai,
            ],
            'laporan_terbaru' => $laporanTerbaru,
            'urgency_tinggi'  => $urgencyTinggi,
            'laporan_pending' => $pending,
            'riwayat_selesai' => $riwayatSelesai,
        ]);
    }
}
