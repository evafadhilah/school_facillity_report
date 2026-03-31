<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Fasilitas;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan
    public function index()
    {
        if (auth()->user()->role == 'teknisi') {
            $laporans = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
                ->where('teknisi_id', auth()->id())
                ->latest()
                ->get();
            return view('admin.laporan.index', compact('laporans'));
        }

        $laporans = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporans'));
    }

    // Form membuat laporan
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $kelas = Kelas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        if (auth()->user()->role == 'siswa') {
            return view('siswa.laporan.create', compact('fasilitas', 'kelas', 'teknisi'));
        }

        return view('admin.laporan.create', compact('fasilitas', 'kelas', 'teknisi'));
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id'    => 'required|exists:fasilitas,id',
            'kelas_id'        => 'required|exists:kelas,id',
            'deskripsi'       => 'required',
            'tingkat_urgency' => 'required|in:rendah,sedang,tinggi',
            'foto'            => 'nullable|image|max:2048',
        ]);

        $data = [
            'user_id'         => auth()->id(),
            'fasilitas_id'    => $request->fasilitas_id,
            'kelas_id'        => $request->kelas_id,
            'teknisi_id'      => $request->teknisi_id,
            'deskripsi'       => $request->deskripsi,
            'tingkat_urgency' => $request->tingkat_urgency,
            'status'          => 'pending',
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        Laporan::create($data);

        if (auth()->user()->role == 'siswa') {
            return redirect()->route('siswa.laporan.index')
                ->with('success', 'Laporan berhasil dikirim');
        }

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    // Lihat detail laporan
    public function show(Laporan $laporan)
    {
        $laporan->load(['user', 'fasilitas', 'kelas', 'kategori', 'lokasi', 'teknisi']);
        return view('admin.laporan.show', compact('laporan'));
    }

    // Form edit laporan
    public function edit(Laporan $laporan)
    {
        $fasilitas = Fasilitas::all();
        $kelas = Kelas::all();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('admin.laporan.edit', compact('laporan', 'fasilitas', 'kelas', 'teknisi'));
    }

    // Update laporan
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:pending,ditugaskan,diproses,selesai,ditolak',
        ]);

        $laporan->update($request->only(['status', 'teknisi_id']));

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    // Hapus laporan
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
