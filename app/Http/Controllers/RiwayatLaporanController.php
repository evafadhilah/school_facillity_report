<?php

namespace App\Http\Controllers;

use App\Models\RiwayatLaporan;
use App\Models\Laporan;
use Illuminate\Http\Request;

class RiwayatLaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'status' => 'required|in:pending,ditugaskan,diproses,selesai,ditolak',
        ]);

        RiwayatLaporan::create([
            'laporan_id' => $request->laporan_id,
            'teknisi_id' => auth()->id(),
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Riwayat laporan ditambahkan');
    }

    public function destroy(RiwayatLaporan $riwayatLaporan)
    {
        $riwayatLaporan->delete();

        return back()->with('success', 'Riwayat laporan dihapus');
    }
}
