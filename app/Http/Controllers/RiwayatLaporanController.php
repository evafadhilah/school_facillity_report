<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class RiwayatLaporanController extends Controller
{
    public function index()
    {
        $riwayatLaporans = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
                            ->where('status', 'selesai')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        return view('admin.riwayat_laporan.index', compact('riwayatLaporans'));
    }

     public function show($id)
    {
        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
                    ->where('status', 'selesai')
                    ->findOrFail($id);

        return view('admin.riwayat_laporan.show', compact('laporan'));
    }
}
