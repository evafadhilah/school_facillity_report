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

                <button type="submit" class="btn btn-primary">Simpan Fasilitas</button>
            </form>
        </div>
    </div>
</div>
@endsection
@endsection
