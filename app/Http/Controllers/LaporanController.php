<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan
    public function index()
    {
        if(auth()->user()->role == 'siswa'){
            // Siswa hanya lihat laporan sendiri
            $laporans = Laporan::with(['fasilitas', 'teknisi'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();

            return view('siswa.laporan.index', compact('laporans'));
        }

        // Admin & role lain lihat semua laporan
        $laporans = Laporan::with(['pelapor', 'fasilitas', 'teknisi'])->latest()->get();
        return view('laporan.index', compact('laporans'));
    }

    // Form membuat laporan
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        if(auth()->user()->role == 'siswa'){
            return view('siswa.laporan.create', compact('fasilitas','teknisi'));
        }

        return view('laporan.create', compact('fasilitas', 'teknisi'));
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'deskripsi' => 'required',
            'tingkat_urgency' => 'required|in:rendah,sedang,tinggi',
        ]);

        Laporan::create([
            'user_id' => auth()->id(),
            'fasilitas_id' => $request->fasilitas_id,
            'teknisi_id' => $request->teknisi_id,
            'deskripsi' => $request->deskripsi,
            'tingkat_urgency' => $request->tingkat_urgency,
            'status' => 'pending',
        ]);

        // Redirect sesuai role
        if(auth()->user()->role == 'siswa'){
            return redirect()->route('siswa.laporan.index')
                ->with('success', 'Laporan berhasil dikirim');
        }

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    // Lihat detail laporan
    public function show(Laporan $laporan)
    {
        $laporan->load(['pelapor', 'fasilitas', 'teknisi', 'riwayat']);
        return view('laporan.show', compact('laporan'));
    }

    // Form edit laporan
    public function edit(Laporan $laporan)
    {
        $fasilitas = Fasilitas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('laporan.edit', compact('laporan', 'fasilitas', 'teknisi'));
    }

    // Update laporan (status)
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:pending,ditugaskan,diproses,selesai,ditolak',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    // Hapus laporan
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
