<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kelas;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan laporan milik siswa
    public function index()
    {
        // ✅ FIX: tambah with() agar relasi tidak null di tabel
        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.laporan.index', compact('laporan'));
    }

    // Form tambah laporan
    public function create()
    {
        $kelas    = Kelas::all();
        $kategori = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasi   = Lokasi::all();

        return view('siswa.laporan.create', compact(
            'kelas',
            'kategori',
            'fasilitas',
            'lokasi'
        ));
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'kelas_id'     => 'required',
            'kategori_id'  => 'required',
            'fasilitas_id' => 'required',
            'lokasi_id'    => 'required',
            'deskripsi'    => 'required',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ FIX: ambil hanya field yang diperlukan, bukan $request->all()
        $data = $request->only([
            'nama_pelapor',
            'kelas_id',
            'kategori_id',
            'fasilitas_id',
            'lokasi_id',
            'deskripsi',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        Laporan::create($data);

        return redirect()->route('siswa.laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    // Detail laporan milik siswa
    public function show($id)
    {
        // ✅ FIX: tambah with() agar semua relasi termuat
        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.laporan.show', compact('laporan'));
    }
}
