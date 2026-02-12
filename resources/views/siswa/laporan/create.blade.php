@extends('layouts.backend')

@section('title', 'Tambah Laporan')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Buat Laporan Fasilitas</h4>
                <p>Laporkan kerusakan fasilitas sekolah</p>
            </div>
            <a href="{{ route('siswa.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card form-card">
        <div class="card-body">
           <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- Nama Pelapor --}}
<div class="mb-4">
    <label class="form-label">Nama Pelapor</label>
    <input
        type="text"
        name="nama_pelapor"
        class="form-control"
        placeholder="Masukkan nama kamu"
        value="{{ old('nama_pelapor') }}"
        required
    >
</div>


{{-- Kategori --}}
<div class="mb-4">
    <label class="form-label">Kategori</label>
    <select name="kategori_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($kategori as $k)
            <option value="{{ $k->id }}">
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

{{-- Fasilitas --}}
<div class="mb-4">
    <label class="form-label">Fasilitas</label>
    <select name="fasilitas_id" class="form-control" required>
        <option value="">-- Pilih Fasilitas --</option>
        @foreach ($fasilitas as $f)
            <option value="{{ $f->id }}">
                {{ $f->nama_fasilitas }}
            </option>
        @endforeach
    </select>
</div>

{{-- Lokasi --}}
<div class="mb-4">
    <label class="form-label">Lokasi</label>
    <select name="lokasi_id" class="form-control" required>
        <option value="">-- Pilih Lokasi --</option>
        @foreach ($lokasi as $l)
            <option value="{{ $l->id }}">
                {{ $l->nama_lokasi }}
            </option>
        @endforeach
    </select>
</div>

{{-- Upload Foto --}}
<div class="mb-4">
    <label class="form-label">Upload Foto</label>
    <input type="file" name="foto" class="form-control">
</div>

{{-- Deskripsi --}}
<div class="mb-4">
    <label class="form-label">Deskripsi Kerusakan</label>
    <textarea
        name="deskripsi"
        class="form-control"
        rows="4"
        placeholder="Contoh: Kursi rusak, AC tidak dingin, dll"
        required
    ></textarea>
</div>

{{-- Tombol --}}
<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('siswa.laporan.index') }}" class="btn-cancel">
        Batal
    </a>
    <button type="submit" class="btn-submit">
        Simpan Laporan
    </button>
</div>

</form>

        </div>
    </div>

</div>

@endsection
