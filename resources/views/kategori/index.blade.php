@extends('layouts.admin.app')

@section('title', 'Data Kategori')

@section('content')

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Data Kategori</h5>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
      + Tambah Kategori
    </a>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th width="50">No</th>
            <th>Nama Kategori</th>
            <th width="180">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kategoris as $kategori)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kategori->nama_kategori }}</td>
            <td>
              <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-info">
                Detail
              </a>
              <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">
                Edit
              </a>
              <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
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
