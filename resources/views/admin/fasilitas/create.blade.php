@extends('layouts.backend')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Tambah Fasilitas</h4>
            <p class="text-muted mb-0">Form untuk menambahkan fasilitas baru</p>
        </div>
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Form Tambah -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.fasilitas.store') }}" method="POST">
                @csrf

                <!-- Nama Fasilitas -->
                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas"
                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                        value="{{ old('nama_fasilitas') }}" required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id"
                        class="form-select @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi"
                        class="form-control @error('lokasi') is-invalid @enderror"
                        value="{{ old('lokasi') }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kode Fasilitas -->
                <div class="mb-3">
                    <label class="form-label">Kode Fasilitas</label>
                    <input type="text" name="kode_fasilitas"
                        class="form-control @error('kode_fasilitas') is-invalid @enderror"
                        value="{{ old('kode_fasilitas') }}" required>
                    @error('kode_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kondisi -->
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi"
                        class="form-select @error('kondisi') is-invalid @enderror" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Fasilitas</button>
            </form>
        </div>
    </div>
</div>
@endsection
