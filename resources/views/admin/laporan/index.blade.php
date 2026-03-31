@extends('layouts.backend')

@section('title', 'Data Laporan')

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
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .btn-add {
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
        white-space: nowrap;
    }
    .btn-add:hover {
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
        margin: 0; padding: 0;
        border-radius: 20px;
        overflow-x: auto;
    }
    .custom-table {
        margin: 0;
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        min-width: 1100px;
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

    /* Foto thumbnail */
    .foto-thumb {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .foto-thumb:hover {
        transform: scale(1.1);
    }
    .foto-none {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #d1d5db;
        font-size: 1.2rem;
    }

    /* Deskripsi truncate */
    .deskripsi-text {
        max-width: 140px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }

    /* Badge Status */
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
    .badge-pending    { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
    .badge-diproses   { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
    .badge-selesai    { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
    .badge-ditolak    { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }
    .badge-ditugaskan { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; }

    /* Badge Urgency */
    .badge-urgency {
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.76rem;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    .badge-rendah { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
    .badge-sedang { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
    .badge-tinggi { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }

    /* Tombol Aksi */
    .action-buttons {
        display: flex;
        gap: 0.4rem;
        flex-wrap: nowrap;
        align-items: center;
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
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245,158,11,0.4);
        color: white;
    }
    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239,68,68,0.4);
        color: white;
    }

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
    }
    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
        display: block;
    }
    .empty-state p {
        color: #9ca3af;
        font-size: 1rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .btn-add { width: 100%; justify-content: center; }
    }
    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
        .header-title p { font-size: 0.85rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
         style="border-radius:12px; border:none; background:#d1e7dd; color:#0f5132;">
        <i class='bx bx-check-circle me-2'></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Header --}}
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Data Laporan</h4>
                <p>Kelola laporan kerusakan fasilitas sekolah</p>
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
                            <th style="width:50px;">No</th>
                            <th>Pelapor</th>
                            <th>Kelas</th>
                            <th>Kategori</th>
                            <th>Fasilitas</th>
                            <th>Foto</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th style="width:210px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong>{{ $laporan->user->name ?? $laporan->nama_pelapor ?? '-' }}</strong></td>
                            <td>{{ $laporan->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $laporan->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</td>
                            <td>
                                @php
                                    $fotos = is_array($laporan->foto)
                                        ? $laporan->foto
                                        : json_decode($laporan->foto, true) ?? ($laporan->foto ? [$laporan->foto] : []);
                                @endphp
                                @if($fotos && count($fotos) > 0)
                                    <img src="{{ Storage::url($fotos[0]) }}"
                                         class="foto-thumb"
                                         alt="foto"
                                         onclick="window.open('{{ Storage::url($fotos[0]) }}', '_blank')">
                                @else
                                    <div class="foto-none"><i class='bx bx-image'></i></div>
                                @endif
                            </td>
                            <td>{{ $laporan->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>
                                <span class="deskripsi-text" title="{{ $laporan->deskripsi }}">
                                    {{ $laporan->deskripsi ?? '-' }}
                                </span>
                            </td>
                            <td style="white-space:nowrap;">
                                {{ $laporan->created_at ? $laporan->created_at->format('d-m-Y') : '-' }}
                            </td>
                            <td>
                                @php $urgency = strtolower($laporan->tingkat_urgency ?? '') @endphp
                                @if($urgency)
                                    <span class="badge-urgency badge-{{ $urgency }}">
                                        {{ ucfirst($laporan->tingkat_urgency) }}
                                    </span>
                                @else
                                    <span style="color:#d1d5db;">-</span>
                                @endif
                            </td>
                            <td>
                                @php $status = strtolower($laporan->status ?? '') @endphp
                                <span class="badge-status badge-{{ $status }}">
                                    {{ ucfirst($laporan->status ?? '-') }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.laporan.show', $laporan->id) }}"
                                    class="btn-action btn-detail" title="Detail">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}"
                                    class="btn-action btn-edit" title="Edit">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form action="{{ route('admin.laporan.destroy', $laporan->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                                </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">
                                <div class="empty-state">
                                    <i class='bx bx-folder-open'></i>
                                    <p>Belum ada laporan masuk</p>
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
