<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::where('user_id', Auth::id())->get();
        return view('siswa.laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('siswa.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->route('siswa.laporan.index')->with('success', 'Laporan berhasil dibuat');
    }
}
