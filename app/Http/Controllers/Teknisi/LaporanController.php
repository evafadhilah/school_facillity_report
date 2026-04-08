<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Daftar laporan yang ditugaskan ke teknisi ini
    public function index()
    {
        $laporans = Laporan::where('teknisi_id', auth()->id())
            ->with(['fasilitas', 'kelas', 'lokasi'])
            ->orderByRaw("CASE tingkat_urgency WHEN 'tinggi' THEN 1 WHEN 'sedang' THEN 2 WHEN 'rendah' THEN 3 ELSE 4 END")
            ->paginate(10);

        return view('teknisi.laporan.index', compact('laporans'));
    }

    // Form edit laporan (teknisi hanya bisa update status)
    public function edit($id)
    {
        $laporan = Laporan::where('teknisi_id', auth()->id())
            ->with(['fasilitas', 'kelas', 'lokasi'])
            ->findOrFail($id);

        return view('teknisi.laporan.edit', compact('laporan'));
    }

    // Simpan perubahan status oleh teknisi
    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('teknisi_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:ditugaskan,diproses,selesai',
            'catatan_teknisi' => 'nullable|string|max:500',
        ]);

        $laporan->update([
            'status' => $request->status,
            'catatan_teknisi' => $request->catatan_teknisi,
            'tanggal_selesai' => $request->status === 'selesai' ? now() : $laporan->tanggal_selesai,
        ]);

        return redirect()->route('teknisi.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }
}
