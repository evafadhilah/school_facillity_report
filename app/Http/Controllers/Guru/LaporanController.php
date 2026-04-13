<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\Lokasi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())
                           ->latest()
                           ->get();

        return view('guru.laporan.index', compact('laporans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasis   = Lokasi::all();
        $kelas     = Kelas::all();

        return view('guru.laporan.create', compact('kategoris', 'fasilitas', 'lokasis', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required',
            'lokasi_id'    => 'required',
            'deskripsi'    => 'required',
            'foto'         => 'nullable|image|max:2048',
        ]);

        $data            = $request->all();
        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_laporan', 'public');
        }

        Laporan::create($data);

        return redirect()->route('guru.laporan.index')
                         ->with('success', 'Laporan berhasil dikirim!');
    }
}
