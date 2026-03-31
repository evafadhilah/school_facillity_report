<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLaporan;
use Illuminate\Http\Request;

class RiwayatLaporanController extends Controller
{
    public function index()
    {
        $riwayatLaporans = RiwayatLaporan::with(['laporan', 'teknisi'])
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.riwayat_laporan.index', compact('riwayatLaporans'));
    }
}
