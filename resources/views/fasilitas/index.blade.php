@extends('layouts.admin.app')

@section('title', 'Data Fasilitas')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Data Fasilitas</h5>
    <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
      + Tambah Fasilitas
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th width="50">No</th>
            <th>Nama Fasilitas</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Kode</th>
            <th>Kondisi</th>
            <th width="220">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fasilitas as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_fasilitas }}</td>
            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
            <td>{{ $item->lokasi }}</td>
            <td>{{ $item->kode_fasilitas }}</td>
            <td>
              <span class="badge
                @if($item->kondisi == 'Baik') bg-success
                @elseif($item->kondisi == 'Rusak Ringan') bg-warning
                @else bg-danger
                @endif
              ">
                {{ $item->kondisi }}
              </span>
            </td>
            <td>
              <a href="{{ route('fasilitas.show', $item->id) }}" class="btn btn-sm btn-info">
                Detail
              </a>
              <a href="{{ route('fasilitas.edit', $item->id) }}" class="btn btn-sm btn-warning">
                Edit
              </a>
              <form action="{{ route('fasilitas.destroy', $item->id) }}"
                    method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin hapus?')">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
