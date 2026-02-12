@extends('layouts.backend')

@section('title', 'Data Laporan')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Data Laporan Saya</h4>
                <p>Daftar laporan fasilitas yang sudah dikirim</p>
            </div>

            <a href="{{ route('siswa.laporan.create') }}" class="btn-submit">
                <i class='bx bx-plus'></i> Buat Laporan
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card Table -->
    <div class="card form-card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Fasilitas</th>
                            <th>Foto</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Laporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $item->user->name ?? '-' }}
                    </td>
                    <td>
                        {{ $item->kelas->nama_kelas ?? '-' }}
                    </td>
                    <td>
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </td>
                    <td>
                        {{ $item->fasilitas->nama_fasilitas ?? '-' }}
                    </td>
                    <td>{{ $item->lokasi ?? '-' }}</td>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}" width="60">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                    </td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status == 'diproses')
                            <span class="badge bg-info">Diproses</span>
                        @elseif($item->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            {{ $item->status }}
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">
                        Belum ada laporan
                    </td>
                </tr>
                @endforelse
            </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
