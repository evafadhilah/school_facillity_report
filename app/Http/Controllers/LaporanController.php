<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Fasilitas;
use App\Models\Kelas;  // ← TAMBAH INI
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan
    public function index()
    {
        if(auth()->user()->role == 'siswa'){
            // Siswa hanya lihat laporan sendiri
            $laporans = Laporan::with(['fasilitas', 'kelas', 'teknisi'])  // ← TAMBAH 'kelas'
                ->where('user_id', auth()->id())
                ->latest()
                ->get();

            return view('siswa.laporan.index', compact('laporans'));
        }

        // Admin & role lain lihat semua laporan
        $laporans = Laporan::with(['pelapor', 'fasilitas', 'kelas', 'teknisi'])->latest()->get();  // ← TAMBAH 'kelas'
        return view('laporan.index', compact('laporans'));
    }

    // Form membuat laporan
    public function create()
    {
        $fasilitas = Fasilitas::all();
        $kelas = Kelas::all();  // ← TAMBAH INI
        $teknisi = User::where('role', 'teknisi')->get();

        if(auth()->user()->role == 'siswa'){
            return view('siswa.laporan.create', compact('fasilitas', 'kelas', 'teknisi'));  // ← TAMBAH 'kelas'
        }

        return view('laporan.create', compact('fasilitas', 'kelas', 'teknisi'));  // ← TAMBAH 'kelas'
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas,id',
            'kelas_id' => 'required|exists:kelas,id',  // ← TAMBAH INI
            'deskripsi' => 'required',
            'tingkat_urgency' => 'required|in:rendah,sedang,tinggi',
            'foto' => 'nullable|image|max:2048',  // ← TAMBAH INI (optional)
        ]);

        $data = [
            'user_id' => auth()->id(),
            'fasilitas_id' => $request->fasilitas_id,
            'kelas_id' => $request->kelas_id,  // ← TAMBAH INI
            'teknisi_id' => $request->teknisi_id,
            'deskripsi' => $request->deskripsi,
            'tingkat_urgency' => $request->tingkat_urgency,
            'status' => 'pending',
        ];

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        Laporan::create($data);

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
        $laporan->load(['pelapor', 'fasilitas', 'kelas', 'teknisi', 'riwayat']);  // ← TAMBAH 'kelas'
        return view('laporan.show', compact('laporan'));
    }

    // Form edit laporan
    public function edit(Laporan $laporan)
    {
        $fasilitas = Fasilitas::all();
        $kelas = Kelas::all();  // ← TAMBAH INI
        $teknisi = User::where('role', 'teknisi')->get();

        return view('laporan.edit', compact('laporan', 'fasilitas', 'kelas', 'teknisi'));  // ← TAMBAH 'kelas'
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
