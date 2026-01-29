@extends('layouts.backend')

@section('title', 'Detail Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Detail Fasilitas</h4>
      <p class="text-muted mb-0">Informasi lengkap fasilitas sekolah</p>
    </div>
    <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-label-secondary">
      <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
  </div>

  <!-- Card -->
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="card shadow-sm">
        <div class="card-header bg-label-info">
          <h5 class="card-title mb-0">Data Fasilitas</h5>
        </div>

        <div class="card-body p-4">
          <table class="table table-borderless mb-0">
            <tr>
              <th width="35%">Nama Fasilitas</th>
              <td>{{ $fasilitas->nama_fasilitas }}</td>
            </tr>
            <tr>
              <th>Kategori</th>
              <td>{{ $fasilitas->kategori->nama_kategori ?? '-' }}</td>
            </tr>
            <tr>
              <th>Lokasi</th>
              <td>{{ $fasilitas->lokasi }}</td>
            </tr>
            <tr>
              <th>Kode Fasilitas</th>
              <td>
                <span class="badge bg-label-primary">
                  {{ $fasilitas->kode_fasilitas }}
                </span>
              </td>
            </tr>
            <tr>
              <th>Kondisi</th>
              <td>
                @php
                  $kondisiLabel = [
                    'baik' => 'Baik',
                    'rusak_ringan' => 'Rusak Ringan',
                    'rusak_berat' => 'Rusak Berat',
                  ];
                @endphp

                <span class="badge
                  @if($fasilitas->kondisi == 'baik') bg-label-success
                  @elseif($fasilitas->kondisi == 'rusak_ringan') bg-label-warning
                  @else bg-label-danger
                  @endif
                ">
                  {{ $kondisiLabel[$fasilitas->kondisi] ?? '-' }}
                </span>
              </td>
            </tr>
            <tr>
              <th>Dibuat</th>
                <td>
                {{ $fasilitas->created_at
                    ? $fasilitas->created_at->format('d M Y H:i')
                    : '-' }}
                </td>
            </tr>
            <tr>
              <th>Terakhir Update</th>
                <td>
                {{ $fasilitas->updated_at
                    ? $fasilitas->updated_at->format('d M Y H:i')
                    : '-' }}
                </td>
            </tr>
          </table>
        </div>


<!-- Action -->
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.fasilitas.edit', ['fasilitas' => $fasilitas->id]) }}"
                class="btn btn-warning">
                <i class="bx bx-edit me-1"></i> Edit
            </a>

            <a href="{{ route('admin.fasilitas.index') }}"
                class="btn btn-secondary">
                Tutup
            </a>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection
