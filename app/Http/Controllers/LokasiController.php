<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::latest()->get();
        return view('admin.lokasi.index', compact('lokasis')); // ✅ Tambahin 'admin.'
    }

    public function create()
    {
        return view('admin.lokasi.create'); // ✅ Tambahin 'admin.'
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
        ], [
            'nama_lokasi.required' => 'Nama lokasi wajib diisi',
            'nama_lokasi.max' => 'Nama lokasi maksimal 255 karakter',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect()->route('admin.lokasi.index') // ✅ Ubah jadi admin.lokasi.index
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function show(Lokasi $lokasi)
    {
        return view('admin.lokasi.show', compact('lokasi')); // ✅ Tambahin 'admin.'
    }

    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit', compact('lokasi')); // ✅ Tambahin 'admin.'
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
        ], [
            'nama_lokasi.required' => 'Nama lokasi wajib diisi',
            'nama_lokasi.max' => 'Nama lokasi maksimal 255 karakter',
        ]);

        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
        ]);

        return redirect()->route('admin.lokasi.index') // ✅ Ubah jadi admin.lokasi.index
            ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(Lokasi $lokasi)
    {
        try {
            $lokasi->delete();
            return redirect()->route('admin.lokasi.index') // ✅ Ubah jadi admin.lokasi.index
                ->with('success', 'Lokasi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.lokasi.index') // ✅ Ubah jadi admin.lokasi.index
                ->with('error', 'Lokasi tidak dapat dihapus karena masih digunakan di data fasilitas');
        }
    }
}
