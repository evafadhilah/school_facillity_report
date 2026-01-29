@extends('layouts.backend')

@section('title', 'Data Fasilitas')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Data Fasilitas</h4>
      <p class="text-muted mb-0">Kelola fasilitas sekolah Anda</p>
    </div>
    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
      <i class='bx bx-plus'></i> Tambah Fasilitas
    </a>
  </div>

  <!-- Alert Success -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class='bx bx-check-circle me-2'></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Card Table -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Daftar Fasilitas</h5>
    </div>

    <div class="card-body">
      @if($fasilitas->count() > 0)
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="60" class="text-center">No</th>
                <th>Nama Fasilitas</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kode</th>
                <th width="120" class="text-center">Kondisi</th>
                <th width="150" class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($fasilitas as $item)
              <tr>
                <td class="text-center">
                  <span class="badge bg-label-primary">{{ $loop->iteration }}</span>
                </td>
                <td>
                  <strong>{{ $item->nama_fasilitas }}</strong>
                </td>
                <td>
                  <span class="badge bg-label-info">
                    {{ $item->kategori->nama_kategori ?? '-' }}
                  </span>
                </td>
                <td>
                  <i class='bx bx-map me-1 text-muted'></i>
                  {{ $item->lokasi }}
                </td>
                <td>
                  <code class="text-primary">{{ $item->kode_fasilitas }}</code>
                </td>
                <td class="text-center">
                  <span class="badge
                    @if($item->kondisi == 'Baik') bg-success
                    @elseif($item->kondisi == 'Rusak Ringan') bg-warning
                    @else bg-danger
                    @endif
                  ">
                    {{ $item->kondisi }}
                  </span>
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.fasilitas.show', $item->id) }}"
                     class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Detail">
                    <i class='bx bx-show'></i>
                  </a>
                  <a href="{{ route('admin.fasilitas.edit', ['fasilitas' => $item->id]) }}"
                    class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                    data-bs-toggle="tooltip"
                    title="Edit">
                    <i class='bx bx-edit'></i>
                </a>

                  <form action="{{ route('admin.fasilitas.destroy', ['fasilitas' => $item->id]) }}"
                    method="POST"
                    class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                title="Hapus">
                            <i class='bx bx-trash'></i>
                        </button>
                </form>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="text-center py-5">
          <i class='bx bx-building-house bx-lg text-muted mb-3'></i>
          <h5 class="text-muted">Belum Ada Data Fasilitas</h5>
          <p class="text-muted">Silakan tambahkan fasilitas baru</p>
          <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary mt-2">
            <i class='bx bx-plus'></i> Tambah Fasilitas
          </a>
        </div>
      @endif
    </div>
  </div>
</div>

{{-- @push('scripts')
<script>
  // Initialize tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  // Auto hide alert after 5 seconds
  setTimeout(function() {
    var alert = document.querySelector('.alert');
    if (alert) {
      var bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }
  }, 5000);

  // Confirm delete
  document.querySelectorAll('.delete-form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      if (confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')) {
        this.submit();
      }
    });
  });
</script>
@endpush --}}
@endsection
