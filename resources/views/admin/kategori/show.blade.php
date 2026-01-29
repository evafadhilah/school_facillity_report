@extends('layouts.backend')

@section('title', 'Detail Kategori')

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
      <li class="breadcrumb-item active">Detail</li>
    </ol>
  </nav>

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-1">Detail Kategori</h4>
      <p class="text-muted mb-0">Informasi lengkap kategori produk</p>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.kategori.index') }}" class="btn btn-label-secondary">
        <i class='bx bx-arrow-back me-1'></i> Kembali
      </a>
      <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning">
        <i class='bx bx-edit me-1'></i> Edit
      </a>
    </div>
  </div>

  <!-- Card Detail -->
  <div class="row">
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
          <i class='bx bx-category me-2 text-primary'></i>
          <h5 class="card-title mb-0">Informasi Kategori</h5>
        </div>

        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label fw-semibold">ID Kategori</label>
            <div class="col-sm-9">
              <p class="form-control-plaintext">
                <span class="badge bg-label-primary">{{ $kategori->id }}</span>
              </p>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label fw-semibold">Nama Kategori</label>
            <div class="col-sm-9">
              <p class="form-control-plaintext">
                <strong class="text-dark">{{ $kategori->nama_kategori }}</strong>
              </p>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label fw-semibold">Dibuat Pada</label>
            <div class="col-sm-9">
              <p class="form-control-plaintext">
                <i class='bx bx-calendar me-1'></i>
                {{ $kategori->created_at->format('d F Y, H:i') }} WIB
              </p>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label fw-semibold">Terakhir Diupdate</label>
            <div class="col-sm-9">
              <p class="form-control-plaintext">
                <i class='bx bx-time me-1'></i>
                {{ $kategori->updated_at->format('d F Y, H:i') }} WIB
              </p>
            </div>
          </div>
        </div>

        <div class="card-footer bg-light">
          <div class="d-flex justify-content-between">
            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning">
              <i class='bx bx-edit'></i> Edit Kategori
            </a>
            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                  method="POST"
                  class="delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class='bx bx-trash'></i> Hapus Kategori
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
