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
            ->with(['fasilitas', 'kelas', 'lokasi', 'user'])
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
            'foto_sesudah' => 'nullable|image|max:2048',
        ]);

        $laporan->update([
            'status'          => $request->status,
            'catatan'         => $request->catatan_teknisi,
            'tanggal_selesai' => $request->tanggal_selesai ?: ($request->status === 'selesai' ? now()->toDateString() : $laporan->tanggal_selesai),
        ]);

        if ($request->hasFile('foto_sesudah')) {
            $path = $request->file('foto_sesudah')->store('foto_sesudah', 'public');
            $laporan->update(['foto_sesudah' => $path]);
        }

        return redirect()->route('teknisi.laporan.index')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }

    public function show($id)
        {
            $laporan = Laporan::where('teknisi_id', auth()->id())
                ->with(['fasilitas', 'lokasi', 'kelas', 'user'])
                ->findOrFail($id);

            return view('teknisi.laporan.show', compact('laporan'));
        }

    public function riwayat()
    {
        $riwayats = Laporan::where('teknisi_id', auth()->id())
            ->where('status', 'selesai')
            ->with(['fasilitas', 'lokasi', 'kelas', 'user'])
            ->orderBy('tanggal_selesai', 'desc')
            ->paginate(10);

        return view('teknisi.laporan.riwayat', compact('riwayats'));
    }
}
