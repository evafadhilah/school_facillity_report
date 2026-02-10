<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kategori;
use App\Models\Lokasi; // ✅ Tambahin import Lokasi
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::with(['kategori', 'lokasi'])->get(); // ✅ Eager load lokasi juga
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $lokasis = Lokasi::all(); // ✅ Tambahin data lokasi
        return view('admin.fasilitas.create', compact('kategori', 'lokasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'kategori_id'    => 'required|exists:kategoris,id', // ✅ Validasi foreign key
            'lokasi_id'      => 'required|exists:lokasis,id', // ✅ Ubah dari 'lokasi' jadi 'lokasi_id'
            'kode_fasilitas' => 'required|unique:fasilitas',
            'kondisi'        => 'required|in:baik,rusak_ringan,rusak_berat', // ✅ Validasi enum
        ]);

        Fasilitas::create($request->all());

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function show(Fasilitas $fasilitas)
    {
        $fasilitas->load(['kategori', 'lokasi']); // ✅ Load relasi
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    public function edit(Fasilitas $fasilitas)
    {
        $kategori = Kategori::all();
        $lokasis = Lokasi::all(); // ✅ Tambahin data lokasi
        return view('admin.fasilitas.edit', compact('fasilitas', 'kategori', 'lokasis'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'kategori_id'    => 'required|exists:kategoris,id',
            'lokasi_id'      => 'required|exists:lokasis,id', // ✅ Ubah dari 'lokasi'
            'kode_fasilitas' => 'required|unique:fasilitas,kode_fasilitas,' . $fasilitas->id,
            'kondisi'        => 'required|in:baik,rusak_ringan,rusak_berat',
        ]);

        $fasilitas->update($request->all());

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus');
    }
}
