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
        top: -50%; right: -5%;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .index-header::after {
        content: '';
        position: absolute;
        bottom: -30%; left: -3%;
        width: 150px; height: 150px;
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
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
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
        margin: 0; padding: 0;
        border-radius: 20px;
        overflow-x: auto;
    }

    .custom-table {
        margin: 0;
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        min-width: 900px;
    }
    .custom-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .custom-table thead th {
        padding: 1rem 0.85rem;
        font-weight: 700;
        color: #4338ca;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        border-bottom: 2px solid #e5e7eb;
        background: transparent;
        white-space: nowrap;
    }
    .custom-table tbody td {
        padding: 0.85rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
        font-size: 0.88rem;
        background: white;
    }
    .custom-table tbody tr {
        transition: all 0.3s ease;
    }
    .custom-table tbody tr:hover {
        background: linear-gradient(to right, #f9fafb 0%, #ffffff 100%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .lap-name { font-size: 0.88rem; font-weight: 600; color: #111827; }
    .lap-loc  { font-size: 0.75rem; color: #9ca3af; margin-top: 2px; }
    .pel-name  { font-size: 0.88rem; font-weight: 600; color: #111827; }
    .pel-kelas { font-size: 0.75rem; color: #9ca3af; margin-top: 2px; }

    .catatan-text {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .badge-status {
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.76rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        white-space: nowrap;
    }
    .badge-selesai { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }

    .date-main { font-size: 0.88rem; font-weight: 500; color: #111827; white-space: nowrap; }
    .date-time { font-size: 0.75rem; color: #9ca3af; }

    .action-buttons {
        display: flex;
        gap: 0.4rem;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
    }
    .btn-action {
        padding: 0.4rem 0.5rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.78rem;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-detail {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.4);
        color: white;
    }

    .empty-state { padding: 3rem 1rem; text-align: center; }
    .empty-state i { font-size: 4rem; color: #d1d5db; margin-bottom: 1rem; display: block; }
    .empty-state p { color: #9ca3af; font-size: 1rem; margin: 0; }

    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; align-items: flex-start; }
    }
    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
        .header-title p { font-size: 0.85rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    @if(session('success'))
    <div class="alert alert-dismissible fade show mb-4" role="alert"
         style="border-radius:12px; border:none; background:#d1e7dd; color:#0f5132;">
        <i class='bx bx-check-circle me-2'></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Header --}}
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Riwayat Laporan</h4>
                <p>Histori dan rekam jejak penanganan laporan kerusakan fasilitas</p>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th style="width:50px;" class="text-center">No</th>
                            <th>Laporan</th>
                            <th>Pelapor</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                            <th style="width:90px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatLaporans as $riwayat)
                        <tr>
                            <td class="text-center">
                                <strong>{{ $loop->iteration }}</strong>
                            </td>
                            <td>
                                <div class="lap-name">
                                    {{ $riwayat->fasilitas->nama_fasilitas ?? ($riwayat->deskripsi ?? 'Laporan') }}
                                </div>
                                <div class="lap-loc">{{ $riwayat->lokasi->nama_lokasi ?? '' }}</div>
                            </td>
                            <td>
                                <div class="pel-name">{{ $riwayat->user->name ?? '-' }}</div>
                                <div class="pel-kelas">{{ $riwayat->kelas->nama_kelas ?? '' }}</div>
                            </td>
                            <td>
                                <span class="catatan-text" title="{{ $riwayat->deskripsi }}">
                                    {{ $riwayat->deskripsi ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-status badge-selesai">
                                    <i class='bx bx-check-circle'></i> Selesai
                                </span>
                            </td>
                            <td>
                                <div class="date-main">
                                    {{ $riwayat->updated_at ? $riwayat->updated_at->format('d M Y') : '-' }}
                                </div>
                                <div class="date-time">
                                    {{ $riwayat->updated_at ? $riwayat->updated_at->format('H:i') : '' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.riwayatlaporan.show', $riwayat->id) }}"
                                       class="btn-action btn-detail" title="Detail">
                                        <i class='bx bx-show'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class='bx bx-history'></i>
                                    <p>Belum ada riwayat laporan</p>
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
