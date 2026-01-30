@extends('layouts.backend')

@section('title', 'Detail Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Detail Fasilitas</h4>
            <p class="text-muted mb-0">Informasi lengkap fasilitas</p>
        </div>
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Detail Card -->
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Nama Fasilitas</th>
                    <td>: {{ $fasilitas->nama_fasilitas }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>: {{ $fasilitas->kategori->nama_kategori ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>: {{ $fasilitas->lokasi }}</td>
                </tr>
                <tr>
                    <th>Kode Fasilitas</th>
                    <td>: {{ $fasilitas->kode_fasilitas }}</td>
                </tr>
                <tr>
                    <th>Kondisi</th>
                    <td>:
                        @if ($fasilitas->kondisi == 'baik')
                            <span class="badge bg-success">Baik</span>
                        @elseif ($fasilitas->kondisi == 'rusak_ringan')
                            <span class="badge bg-warning">Rusak Ringan</span>
                        @else
                            <span class="badge bg-danger">Rusak Berat</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.fasilitas.edit', $fasilitas) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </a>
                <form action="{{ route('admin.fasilitas.destroy', $fasilitas) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bx bx-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
