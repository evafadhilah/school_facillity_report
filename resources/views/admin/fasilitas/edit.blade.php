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
            <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Fasilitas -->
                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas"
                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                        value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Fasilitas</button>
            </form>
        </div>
    </div>
</div>
@endsection
