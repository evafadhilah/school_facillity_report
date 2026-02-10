@extends('layouts.backend')

@section('title', 'Data Fasilitas')

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

    .badge-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .badge-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
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

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
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
        font-size: 1rem;<form action="{{ route('siswa.laporan.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block mb-1">Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 rounded" required></textarea>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim Laporan</button>
</form>
        margin: 0;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .btn-add {
            width: 100%;
            justify-content: center;
        }

        .custom-table {
            font-size: 0.85rem;
        }

        .custom-table thead th {
            padding: 1rem 0.75rem;
            font-size: 0.8rem;
        }

        .custom-table tbody td {
            padding: 0.75rem 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn-action {
            width: 100%;
            justify-content: center;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .index-header {
            padding: 1.5rem;
        }

        .header-title h4 {
            font-size: 1.5rem;
        }

        .header-title p {
            font-size: 0.85rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Data Fasilitas</h4>
                <p>Kelola daftar fasilitas sekolah</p>
            </div>
            <a href="{{ route('admin.fasilitas.create') }}" class="btn-add">
                <i class='bx bx-plus-circle'></i>
                Tambah Fasilitas
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
                            <th style="width: 60px;">No</th>
                            <th>Nama Fasilitas</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th style="width: 140px;">Kondisi</th>
                            <th style="width: 280px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fasilitas as $item)
                            <tr>
                                <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                                <td><strong>{{ $item->nama_fasilitas }}</strong></td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    <i class='bx bx-map-pin' style="color: #9ca3af;"></i>
                                    {{ $item->lokasi }}
                                </td>
                                <td>
                                    @if ($item->kondisi == 'baik')
                                        <span class="badge badge-success">
                                            <i class='bx bx-check-circle'></i> Baik
                                        </span>
                                    @elseif ($item->kondisi == 'rusak_ringan')
                                        <span class="badge badge-warning">
                                            <i class='bx bx-error-circle'></i> Rusak Ringan
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class='bx bx-x-circle'></i> Rusak Berat
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.fasilitas.show', $item) }}"
                                           class="btn-action btn-detail">
                                            <i class='bx bx-show'></i> Detail
                                        </a>

                                        <a href="{{ route('admin.fasilitas.edit', $item) }}"
                                           class="btn-action btn-edit">
                                            <i class='bx bx-edit'></i> Edit
                                        </a>

                                        <form action="{{ route('admin.fasilitas.destroy', $item) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete">
                                                <i class='bx bx-trash'></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class='bx bx-folder-open'></i>
                                        <p>Data fasilitas belum tersedia</p>
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
