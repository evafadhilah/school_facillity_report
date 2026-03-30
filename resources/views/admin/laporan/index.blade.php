@extends('layouts.admin.app')

@section('title', 'Data Laporan')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Data Laporan</h5>
    <a href="{{ route('admin.laporan.create') }}" class="btn btn-primary">
      + Buat Laporan
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th width="50">No</th>
            <th>Pelapor</th>
            <th>Fasilitas</th>
            <th>Teknisi</th>
            <th>Urgency</th>
            <th>Status</th>
            <th width="200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($laporans as $laporan)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $laporan->user->name ?? '-' }}</td>
            <td>{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</td>
            <td>{{ $laporan->teknisi->name ?? '-' }}</td>
            <td>{{ ucfirst($laporan->tingkat_urgency) }}</td>
            <td>{{ ucfirst($laporan->status) }}</td>
            <td>
              <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-sm btn-info">Detail</a>
              <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus laporan?')">
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
