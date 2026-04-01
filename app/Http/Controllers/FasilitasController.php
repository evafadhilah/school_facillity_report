<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas,
        ]);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function show(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.show', ['fasilitas' => $fasilita]);
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.edit', ['fasilitas' => $fasilita]);
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        $fasilita->update([
            'nama_fasilitas' => $request->nama_fasilitas,
        ]);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus');
    }
}
