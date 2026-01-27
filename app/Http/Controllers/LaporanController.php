<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['pelapor', 'fasilitas', 'teknisi'])->latest()->get();

        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        $fasilitas = Fasilitas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('laporan.create', compact('fasilitas', 'teknisi'));
    }

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

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(['pelapor', 'fasilitas', 'teknisi', 'riwayat']);
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $fasilitas = Fasilitas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('laporan.edit', compact('laporan', 'fasilitas', 'teknisi'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:pending,ditugaskan,diproses,selesai,ditolak',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
