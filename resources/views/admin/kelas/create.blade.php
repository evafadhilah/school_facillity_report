@extends('layouts.backend')

@section('title', 'Tambah Kelas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Tambah Kelas</h4>
            <p class="text-muted mb-0">Form untuk menambahkan kelas baru</p>
        </div>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Form Tambah -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf

                <!-- Nama Kelas -->
                <div class="mb-3">
                    <label class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas"
                        class="form-control @error('nama_kelas') is-invalid @enderror"
                        value="{{ old('nama_kelas') }}"
                        placeholder="Contoh: X RPL 1"
                        required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class='bx bx-save'></i> Simpan Kelas
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
