@extends('layouts.backend')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.kategori.index') }}">Kategori</a>
      </li>
      <li class="breadcrumb-item active">Edit</li>
    </ol>
  </nav>

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-1">
        <i class='bx bx-edit-alt text-warning'></i> Edit Kategori
      </h4>
      <p class="text-muted mb-0">Perbarui data kategori produk</p>
    </div>
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-label-secondary">
      <i class='bx bx-arrow-back me-1'></i> Kembali
    </a>
  </div>

  <!-- Error Alert -->
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <div class="d-flex align-items-start">
        <i class='bx bx-error-circle fs-4 me-2'></i>
        <div class="flex-grow-1">
          <h6 class="alert-heading mb-1">Terjadi Kesalahan!</h6>
          <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Card Form -->
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="card shadow-sm">
        <div class="card-header bg-label-warning">
          <div class="d-flex align-items-center">
            <i class='bx bx-edit fs-5 me-2'></i>
            <h5 class="card-title mb-0">Form Edit Kategori</h5>
          </div>
        </div>

        <div class="card-body p-4">
          <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
              <label class="form-label fw-semibold">
                Nama Kategori <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-text">
                  <i class='bx bx-category'></i>
                </span>
                <input
                  type="text"
                  name="nama_kategori"
                  class="form-control @error('nama_kategori') is-invalid @enderror"
                  value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                  placeholder="Masukkan nama kategori"
                  required
                >
                @error('nama_kategori')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <small class="text-muted">
                <i class='bx bx-info-circle'></i>
                Masukkan nama kategori yang jelas dan mudah dipahami
              </small>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
              <a href="{{ route('admin.kategori.index') }}" class="btn btn-label-secondary">
                <i class='bx bx-x'></i> Batal
              </a>
              <button type="submit" class="btn btn-warning">
                <i class='bx bx-save me-1'></i> Update Kategori
              </button>
            </div>
          </form>
        </div>
      </div>

      
    </div>
  </div>

</div>

@push('scripts')
<script>
  // Auto hide alert after 5 seconds
  setTimeout(function() {
    var alert = document.querySelector('.alert-danger');
    if (alert) {
      var bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }
  }, 5000);
</script>
@endpush
@endsection
