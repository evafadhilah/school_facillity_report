@extends('layouts.backend')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Tambah Fasilitas</h4>
      <p class="text-muted mb-0">Form penambahan fasilitas sekolah</p>
    </div>
    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-label-secondary">
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
        <div class="card-header bg-label-primary">
          <h5 class="card-title mb-0">Form Tambah Fasilitas</h5>
        </div>

        <div class="card-body p-4">
          <form action="{{ route('admin.fasilitas.store') }}" method="POST">
            @csrf

            <!-- Nama Fasilitas -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Fasilitas</label>
              <input type="text"
                     name="nama_fasilitas"
                     class="form-control @error('nama_fasilitas') is-invalid @enderror"
                     value="{{ old('nama_fasilitas') }}"
                     placeholder="Contoh: Proyektor, Laboratorium Komputer">
              @error('nama_fasilitas')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Kategori</label>
              <select name="kategori_id"
                      class="form-select @error('kategori_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $item)
                  <option value="{{ $item->id }}"
                    {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                  </option>
                @endforeach
              </select>
              @error('kategori_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Lokasi -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Lokasi</label>
              <input type="text"
                     name="lokasi"
                     class="form-control @error('lokasi') is-invalid @enderror"
                     value="{{ old('lokasi') }}"
                     placeholder="Contoh: Ruang 101, Gedung A">
              @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Kode Fasilitas -->
            <div class="mb-3">
              <label class="form-label fw-semibold">Kode Fasilitas</label>
              <input type="text"
                     name="kode_fasilitas"
                     class="form-control @error('kode_fasilitas') is-invalid @enderror"
                     value="{{ old('kode_fasilitas') }}"
                     placeholder="Contoh: FS-001">
              @error('kode_fasilitas')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Kondisi -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Kondisi</label>
                <select name="kondisi"
                        class="form-select @error('kondisi') is-invalid @enderror">
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                    Baik
                    </option>
                    <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>
                    Rusak Ringan
                    </option>
                    <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>
                    Rusak Berat
                    </option>
                </select>
                @error('kondisi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Action -->
            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-label-secondary">
                Batal
              </a>
              <button type="submit" class="btn btn-primary">
                <i class='bx bx-save me-1'></i> Simpan
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
