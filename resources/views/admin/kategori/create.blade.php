@extends('layouts.backend')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Tambah Kategori</h4>
      <p class="text-muted mb-0">Form penambahan kategori baru</p>
    </div>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
      <i class='bx bx-arrow-back'></i> Kembali
    </a>
  </div>

  <!-- Error Alert -->
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class='bx bx-error-circle me-2'></i>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Card Form -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Form Tambah Kategori</h5>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input
            type="text"
            name="nama_kategori"
            class="form-control @error('nama_kategori') is-invalid @enderror"
            value="{{ old('nama_kategori') }}"
            placeholder="Masukkan nama kategori"
          >
          @error('nama_kategori')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">
            Batal
          </a>
          <button type="submit" class="btn btn-primary">
            <i class='bx bx-save'></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
