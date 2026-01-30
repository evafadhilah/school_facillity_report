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
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    // 📌 Form tambah fasilitas
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.fasilitas.create', compact('kategori'));
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

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    // 📌 Detail fasilitas (FIXED - ubah $fasilita jadi $fasilitas)
    public function show(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.show', compact('fasilitas'));
    }

    // 📌 Form edit fasilitas (FIXED)
    public function edit(Fasilitas $fasilitas)
    {
        $kategori = Kategori::all();
        return view('admin.fasilitas.edit', compact('fasilitas', 'kategori'));
    }

    // 📌 Update data fasilitas (FIXED)
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

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

    // 📌 Hapus fasilitas (FIXED)
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus');
    }
}
