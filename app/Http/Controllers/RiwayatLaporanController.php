<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLaporan;
use Illuminate\Http\Request;

class RiwayatLaporanController extends Controller
{
    /**
     * Tampilkan semua riwayat laporan
     */
    public function index()
    {
        // Ambil semua riwayat laporan beserta relasi laporan & teknisi
        $riwayatLaporans = RiwayatLaporan::with(['laporan', 'teknisi'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('riwayat_laporan.index', compact('riwayatLaporans'));
    }
}
