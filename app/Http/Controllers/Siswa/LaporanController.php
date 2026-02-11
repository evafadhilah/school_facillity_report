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
        $kelas = Kelas::all();
        $fasilitas = Fasilitas::all();
        return view('siswa.laporan.create', compact('kelas', 'fasilitas'));
    }

    public function store(Request $request)
    {
        // Siswa kirim laporan
        $data = $request->all();
        $data['user_id'] = auth()->id(); // ID siswa yang login
        $data['status'] = 'pending';

        Laporan::create($data);

        return redirect()->route('siswa.laporan.index')->with('success', 'Laporan berhasil dikirim');
    }
}
