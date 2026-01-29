@extends('layouts.backend')

@section('title', 'Data Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold mb-0">Data Kategori</h4>
      <p class="text-muted mb-0">Kelola kategori produk Anda</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
      <i class='bx bx-plus'></i> Tambah Kategori
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
      <h5 class="card-title mb-0">Daftar Kategori</h5>
    </div>

    <div class="card-body">
      @if($kategoris->count() > 0)
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th width="60" class="text-center">No</th>
                <th>Nama Kategori</th>
                <th width="150" class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($kategoris as $kategori)
              <tr>
                <td class="text-center">
                  <span class="badge bg-label-primary">{{ $loop->iteration }}</span>
                </td>
                <td>
                  <strong>{{ $kategori->nama_kategori }}</strong>
                </td>
                <td class="text-end">
                  <a href="{{ route('admin.kategori.show', $kategori->id) }}"
                     class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Detail">
                    <i class='bx bx-show'></i>
                  </a>
                  <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                     class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                     data-bs-toggle="tooltip"
                     data-bs-placement="top"
                     title="Edit">
                    <i class='bx bx-edit'></i>
                  </a>
                  <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                        method="POST"
                        class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
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
          <i class='bx bx-folder-open bx-lg text-muted mb-3'></i>
          <h5 class="text-muted">Belum Ada Data Kategori</h5>
          <p class="text-muted">Silakan tambahkan kategori baru</p>
          <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mt-2">
            <i class='bx bx-plus'></i> Tambah Kategori
          </a>
        </div>
      @endif
    </div>
  </div>
</div>

@push('scripts')
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

      if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        this.submit();
      }
    });
  });
</script>
@endpush
@endsection
