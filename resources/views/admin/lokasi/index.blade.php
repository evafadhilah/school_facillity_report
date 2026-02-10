@extends('layouts.backend')

@section('title', 'Data Lokasi')

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
        overflow: hidden;
    }

    .table-card .card-body {
        padding: 0;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1rem;
        border: none;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
        transform: translateX(5px);
    }

    .badge-number {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
        min-width: 40px;
        text-align: center;
    }

    .btn-action {
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
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

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 2px solid #6ee7b7;
        border-radius: 12px;
        color: #065f46;
        padding: 1rem 1.5rem;
    }

    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 2px solid #fca5a5;
        border-radius: 12px;
        color: #991b1b;
        padding: 1rem 1.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state p {
        font-size: 1.1rem;
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

        .table {
            font-size: 0.875rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
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

        .btn-action {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Data Lokasi</h4>
                <p>Kelola daftar lokasi fasilitas sekolah</p>
            </div>
            <a href="{{ route('admin.lokasi.create') }}" class="btn-add">
                <i class='bx bx-plus-circle'></i>
                Tambah Lokasi
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class='bx bx-check-circle me-2'></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Error Alert -->
    @if (session('error'))
        <div class="alert alert-error alert-dismissible fade show mb-4" role="alert">
            <i class='bx bx-error-circle me-2'></i>
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Table -->
    <div class="card table-card">
        <div class="card-body">
            @if($lokasis->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 80px;">NO</th>
                                <th>NAMA LOKASI</th>
                                <th style="width: 200px;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasis as $lokasi)
                            <tr>
                                <td>
                                    <span class="badge-number">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <strong>{{ $lokasi->nama_lokasi }}</strong>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.lokasi.edit', $lokasi->id) }}" class="btn-action btn-edit">
                                        <i class='bx bx-edit'></i> Edit
                                    </a>
                                    <form action="{{ route('admin.lokasi.destroy', $lokasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class='bx bx-trash'></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class='bx bx-map'></i>
                    <p>Belum ada data lokasi</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
