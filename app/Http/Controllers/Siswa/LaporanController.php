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
    // Biar cuma user login yang bisa akses
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan laporan milik siswa
    public function index()
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.laporan.index', compact('laporan'));
    }

    // Form tambah laporan
    public function create()
{
    $kelas = Kelas::all();
    $kategori = Kategori::all();
    $fasilitas = Fasilitas::all();
    $lokasi = Lokasi::all();

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
        'kelas_id' => 'required',
        'fasilitas_id' => 'required',
        'deskripsi' => 'required'
    ]);

    $data = $request->all();
    $data['user_id'] = auth()->id();
    $data['status'] = 'pending';

    Laporan::create($data);

    return redirect()->route('siswa.laporan.index')
        ->with('success', 'Laporan berhasil dikirim');
}

}
