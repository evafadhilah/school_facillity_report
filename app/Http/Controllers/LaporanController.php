<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kelas;
use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pelapor', 'like', "%$search%")
                      ->orWhere('deskripsi', 'like', "%$search%")
                      ->orWhere('status', 'like', "%$search%")
                      ->orWhereHas('kelas', fn($q) => $q->where('nama_kelas', 'like', "%$search%"))
                      ->orWhereHas('kategori', fn($q) => $q->where('nama_kategori', 'like', "%$search%"))
                      ->orWhereHas('fasilitas', fn($q) => $q->where('nama_fasilitas', 'like', "%$search%"))
                      ->orWhereHas('lokasi', fn($q) => $q->where('nama_lokasi', 'like', "%$search%"));
                });
            })
            ->latest()
            ->get();

        return view('siswa.laporan.index', compact('laporan', 'search'));
    }

    public function create()
    {
        $kelas     = Kelas::all();
        $kategori  = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasi    = Lokasi::all();

        return view('siswa.laporan.create', compact('kelas', 'kategori', 'fasilitas', 'lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'kelas_id'     => 'required',
            'kategori_id'  => 'required',
            'fasilitas_id' => 'required',
            'lokasi_id'    => 'required',
            'deskripsi'    => 'required',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_pelapor',
            'kelas_id',
            'kategori_id',
            'fasilitas_id',
            'lokasi_id',
            'deskripsi',
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('laporan/cover', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status']  = 'pending';

        Laporan::create($data);

        return redirect()->route('siswa.laporan.index')
            ->with('success', 'Laporan berhasil dikirim');
    }

    public function edit($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $kelas     = Kelas::all();
        $kategori  = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasi    = Lokasi::all();

        return view('siswa.laporan.edit', compact('laporan', 'kelas', 'kategori', 'fasilitas', 'lokasi'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $request->validate([
            'nama_pelapor' => 'required',
            'kelas_id'     => 'required',
            'kategori_id'  => 'required',
            'fasilitas_id' => 'required',
            'lokasi_id'    => 'required',
            'deskripsi'    => 'required',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_pelapor',
            'kelas_id',
            'kategori_id',
            'fasilitas_id',
            'lokasi_id',
            'deskripsi',
        ]);

        if ($request->hasFile('cover')) {
            if ($laporan->cover) {
                Storage::disk('public')->delete($laporan->cover);
            }
            $data['cover'] = $request->file('cover')->store('laporan/cover', 'public');
        } else {
            $data['cover'] = $laporan->cover;
        }

        $laporan->update($data);

        return redirect()->route('siswa.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function show($id)
    {
        $laporan = Laporan::with(['user', 'kelas', 'kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.laporan.show', compact('laporan'));
    }

    public function destroy($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        if ($laporan->cover) {
            Storage::disk('public')->delete($laporan->cover);
        }

        $laporan->delete();

        return redirect()->route('siswa.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }
}
