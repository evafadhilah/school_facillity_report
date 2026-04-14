<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kategori;
use App\Models\Fasilitas;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $laporans = Laporan::with(['kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('deskripsi', 'like', "%$search%")
                      ->orWhere('status', 'like', "%$search%")
                      ->orWhere('tingkat_urgency', 'like', "%$search%")
                      ->orWhereHas('kategori', fn($q) => $q->where('nama_kategori', 'like', "%$search%"))
                      ->orWhereHas('fasilitas', fn($q) => $q->where('nama_fasilitas', 'like', "%$search%"))
                      ->orWhereHas('lokasi', fn($q) => $q->where('nama_lokasi', 'like', "%$search%"));
                });
            })
            ->latest()
            ->get();

        return view('guru.laporan.index', compact('laporans', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasis   = Lokasi::all();

        return view('guru.laporan.create', compact('kategoris', 'fasilitas', 'lokasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'    => 'required',
            'fasilitas_id'   => 'required',
            'lokasi_id'      => 'required',
            'tingkat_urgency'=> 'required|in:rendah,sedang,tinggi',
            'deskripsi'      => 'required',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'kategori_id',
            'fasilitas_id',
            'lokasi_id',
            'tingkat_urgency',
            'deskripsi',
        ]);

        $data['nama_pelapor'] = Auth::user()->name;
        $data['user_id']      = Auth::id();
        $data['status']       = 'pending';

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('laporan/cover', 'public');
        }

        Laporan::create($data);

        return redirect()->route('guru.laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    public function edit($id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $kategoris = Kategori::all();
        $fasilitas = Fasilitas::all();
        $lokasis   = Lokasi::all();

        return view('guru.laporan.edit', compact('laporan', 'kategoris', 'fasilitas', 'lokasis'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $request->validate([
            'kategori_id'    => 'required',
            'fasilitas_id'   => 'required',
            'lokasi_id'      => 'required',
            'tingkat_urgency'=> 'required|in:rendah,sedang,tinggi',
            'deskripsi'      => 'required',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'kategori_id',
            'fasilitas_id',
            'lokasi_id',
            'tingkat_urgency',
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

        return redirect()->route('guru.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function show($id)
    {
        $laporan = Laporan::with(['kategori', 'fasilitas', 'lokasi'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('guru.laporan.show', compact('laporan'));
    }
}
