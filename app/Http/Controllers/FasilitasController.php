<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kategori;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // 📌 Tampilkan semua data fasilitas
    public function index()
    {
        $fasilitas = Fasilitas::with('kategori')->get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    // 📌 Form tambah fasilitas
    public function create()
    {
        $kategori = Kategori::all();
        return view('fasilitas.create', compact('kategori'));
    }

    // 📌 Simpan data fasilitas
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'kategori_id'    => 'required',
            'lokasi'         => 'required',
            'kode_fasilitas' => 'required|unique:fasilitas',
            'kondisi'        => 'required',
        ]);

        Fasilitas::create($request->all());

        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    // 📌 Detail fasilitas
    public function show(Fasilitas $fasilitas)
    {
        return view('fasilitas.show', compact('fasilitas'));
    }

    // 📌 Form edit fasilitas
    public function edit(Fasilitas $fasilitas)
    {
        $kategori = Kategori::all();
        return view('fasilitas.edit', compact('fasilitas', 'kategori'));
    }

    // 📌 Update data fasilitas
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'kategori_id'    => 'required',
            'lokasi'         => 'required',
            'kode_fasilitas' => 'required|unique:fasilitas,kode_fasilitas,' . $fasilitas->id,
            'kondisi'        => 'required',
        ]);

        $fasilitas->update($request->all());

        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil diperbarui');
    }

    // 📌 Hapus fasilitas
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return redirect()->route('fasilitas.index')
                         ->with('success', 'Fasilitas berhasil dihapus');
    }
}
