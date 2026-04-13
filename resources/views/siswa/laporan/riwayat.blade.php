@extends('layouts.backend')

@section('title', 'Riwayat Laporan')

@section('content')

<style>
    .index-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .index-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .index-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -3%;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title h4 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .header-title p {
        margin: 0.5rem 0 0 0;
        opacity: 1;
        font-size: 0.95rem;
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .btn-back {
        background: white;
        color: #667eea;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255,255,255,0.3);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,255,255,0.4);
        color: #764ba2;
    }

    .table-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: visible;
    }

    .table-card .card-body {
        padding: 0;
        overflow: hidden;
        border-radius: 20px;
    }

    .table-responsive {
        margin: 0;
        padding: 0;
        border-radius: 20px;
        overflow-x: auto;
    }

    .custom-table {
        margin: 0;
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .custom-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .custom-table thead th {
        padding: 1.25rem 1rem;
        font-weight: 700;
        color: #4338ca;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        border-bottom: 2px solid #e5e7eb;
        background: transparent;
    }

    .custom-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
        font-size: 0.95rem;
        background: white;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(to right, #f9fafb 0%, #ffffff 100%);
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 0.5rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-selesai {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .foto-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
    }

    .foto-thumb:hover {
        transform: scale(1.1);
    }

    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }

    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 1rem;
        margin: 0;
    }

    .desc-cell {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .btn-back {
            width: 100%;
            justify-content: center;
        }
        .custom-table { font-size: 0.85rem; }
        .custom-table thead th { padding: 1rem 0.75rem; font-size: 0.8rem; }
        .custom-table tbody td { padding: 0.75rem 0.5rem; }
        .action-buttons { flex-direction: column; }
        .action-buttons .btn-action { width: 100%; justify-content: center; }
        .badge { font-size: 0.75rem; padding: 0.4rem 0.75rem; }
    }

    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
        .header-title p { font-size: 0.85rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Riwayat Laporan</h4>
                <p>Daftar laporan fasilitas yang sudah selesai ditangani</p>
            </div>
            <a href="{{ route('siswa.laporan.index') }}" class="btn-back">
                Laporan Aktif
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Fasilitas</th>
                            <th>Foto</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $item)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong>{{ $item->user->name ?? '-' }}</strong></td>
                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->fasilitas->nama_fasilitas ?? '-' }}</td>

                            {{-- COVER --}}
                            <td>
                                @if($item->cover)
                                    <a href="{{ asset('storage/' . $item->cover) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->cover) }}" class="foto-thumb" alt="Foto Laporan">
                                    </a>
                                @else
                                    <span style="color:#d1d5db;">-</span>
                                @endif
                            </td>

                            <td>{{ $item->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>
                                <div class="desc-cell" title="{{ $item->deskripsi }}">
                                    {{ $item->deskripsi }}
                                </div>
                            </td>
                            <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                            <td>
                                <span class="badge badge-selesai">
                                    <i class='bx bx-check-circle'></i> Selesai
                                </span>
                            </td>

                            {{-- AKSI - hanya Detail karena sudah selesai --}}
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('siswa.laporan.show', $item->id) }}"
                                       class="btn-action btn-detail">
                                        <i class='bx bx-show'></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="11">
                                <div class="empty-state">
                                    <i class='bx bx-check-shield'></i>
                                    <p>
                                        @if($search ?? false)
                                            Tidak ada riwayat yang cocok dengan "{{ $search }}"
                                        @else
                                            Belum ada laporan yang selesai ditangani
                                        @endif
                                    </p>
                                </div>
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
