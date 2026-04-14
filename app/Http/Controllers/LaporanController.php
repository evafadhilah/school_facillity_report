<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $laporans = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi', 'teknisi'])
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi', 'teknisi'])
            ->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan  = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi', 'teknisi'])->findOrFail($id);
        $fasilitas = Fasilitas::all();
        $teknisi  = User::where('role', 'teknisi')->get();

        return view('admin.laporan.edit', compact('laporan', 'fasilitas', 'teknisi'));
    }

    public function update(Request $request, $id)
{
    $laporan = Laporan::findOrFail($id);

    $request->validate([
        'fasilitas_id'      => 'required',
        'teknisi_id'        => 'nullable',
        'status'            => 'required|in:pending,ditugaskan,diproses,selesai,ditolak',
        'catatan_penolakan' => 'nullable|string|max:1000',
    ]);

    $laporan->update([
        'fasilitas_id'      => $request->fasilitas_id,
        'teknisi_id'        => $request->teknisi_id ?: null,
        'status'            => $request->status,
        'catatan_penolakan' => $request->status === 'ditolak' ? $request->catatan_penolakan : null,
    ]);

    return redirect()->route('admin.laporan.index')
        ->with('success', 'Laporan berhasil diperbarui');
}   

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->cover) {
            Storage::disk('public')->delete($laporan->cover);
        }

        if ($laporan->foto) {
            $fotos = is_array($laporan->foto)
                ? $laporan->foto
                : json_decode($laporan->foto, true) ?? [];

            foreach ($fotos as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    public function create() { abort(403); }
    public function store(Request $request) { abort(403); }
}
