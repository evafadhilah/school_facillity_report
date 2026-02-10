@extends('layouts.backend')

@section('title', 'Detail Lokasi')

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

    .detail-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .detail-card .card-body {
        padding: 2rem;
    }

    .info-row {
        display: flex;
        padding: 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.3s ease;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background-color: #f9fafb;
    }

    .info-label {
        font-weight: 600;
        color: #6b7280;
        min-width: 180px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .info-label i {
        font-size: 1.25rem;
        color: #667eea;
    }

    .info-value {
        color: #1f2937;
        font-size: 1rem;
        font-weight: 500;
        flex: 1;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #f3f4f6;
    }

    .btn-edit {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .badge-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
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

        .detail-card .card-body {
            padding: 1.5rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.5rem;
            padding: 1rem;
        }

        .info-label {
            min-width: auto;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-edit,
        .btn-delete {
            width: 100%;
            justify-content: center;
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
                <h4>Detail Lokasi</h4>
                <p>Informasi lengkap data lokasi</p>
            </div>
            <a href="{{ route('admin.lokasi.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Card Detail -->
    <div class="card detail-card">
        <div class="card-body">
            <!-- Info ID -->
            <div class="info-row">
                <div class="info-label">
                    <i class='bx bx-hash'></i>
                    ID Lokasi
                </div>
                <div class="info-value">
                    <span class="badge-info">{{ $lokasi->id }}</span>
                </div>
            </div>

            <!-- Info Nama Lokasi -->
            <div class="info-row">
                <div class="info-label">
                    <i class='bx bx-map'></i>
                    Nama Lokasi
                </div>
                <div class="info-value">
                    {{ $lokasi->nama_lokasi }}
                </div>
            </div>

            <!-- Info Tanggal Dibuat -->
            <div class="info-row">
                <div class="info-label">
                    <i class='bx bx-calendar-plus'></i>
                    Tanggal Dibuat
                </div>
                <div class="info-value">
                    {{ $lokasi->created_at->format('d F Y, H:i') }} WIB
                </div>
            </div>

            <!-- Info Terakhir Diupdate -->
            <div class="info-row">
                <div class="info-label">
                    <i class='bx bx-calendar-edit'></i>
                    Terakhir Diupdate
                </div>
                <div class="info-value">
                    {{ $lokasi->updated_at->format('d F Y, H:i') }} WIB
                </div>
            </div>

            <!-- Info Jumlah Fasilitas -->
            <div class="info-row">
                <div class="info-label">
                    <i class='bx bx-desktop'></i>
                    Jumlah Fasilitas
                </div>
                <div class="info-value">
                    <span class="badge-info">{{ $lokasi->fasilitas->count() }} Fasilitas</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.lokasi.edit', $lokasi->id) }}" class="btn-edit">
                    <i class='bx bx-edit'></i> Edit Lokasi
                </a>
                <form action="{{ route('admin.lokasi.destroy', $lokasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?\n\nPeringatan: Semua fasilitas yang terkait dengan lokasi ini juga akan terhapus!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class='bx bx-trash'></i> Hapus Lokasi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
