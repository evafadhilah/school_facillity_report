@extends('layouts.backend')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Edit Fasilitas</h4>
            <p class="text-muted mb-0">Form untuk memperbarui data fasilitas</p>
        </div>
        <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Form Edit -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Method PUT untuk update -->

                <!-- Nama Fasilitas -->
                <div class="mb-3">
                    <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" class="form-control @error('nama_fasilitas') is-invalid @enderror"
                        value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id', $fasilitas->kategori_id) == $k->id ? 'selected' : '' }}>
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
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                        value="{{ old('lokasi', $fasilitas->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kode Fasilitas -->
                <div class="mb-3">
                    <label for="kode_fasilitas" class="form-label">Kode Fasilitas</label>
                    <input type="text" name="kode_fasilitas" class="form-control @error('kode_fasilitas') is-invalid @enderror"
                        value="{{ old('kode_fasilitas', $fasilitas->kode_fasilitas) }}" required>
                    @error('kode_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kondisi -->
                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Baik" {{ old('kondisi', $fasilitas->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi', $fasilitas->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi', $fasilitas->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Update Fasilitas</button>
            </form>
        </div>
    </div>
</div>
@endsection
