@extends('layouts.backend')

@section('title', 'Detail Riwayat Laporan')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
        --soft-bg: #f9fafb;
        --border-color: #f1f5f9;
        --text-muted: #64748b;
        --text-dark: #1e293b;
    }

    .index-header {
        background: var(--primary-gradient);
        padding: 2.5rem 2rem;
        border-radius: 24px;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .index-header::after {
        content: '';
        position: absolute;
        top: -20%; right: -10%;
        width: 300px; height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .header-content {
        position: relative; z-index: 2;
        display: flex; justify-content: space-between; align-items: center;
    }

    .header-title h4 {
        margin: 0; font-size: 1.75rem; font-weight: 800; color: white;
        letter-spacing: -0.025em;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: flex; align-items: center; gap: 0.5rem;
    }

    .btn-back:hover {
        background: white; color: #4338ca;
        transform: translateX(-5px);
    }

    .detail-card {
        border: none; border-radius: 20px;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .detail-card .card-header {
        background: white;
        border-bottom: 1px solid var(--border-color);
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex; align-items: center;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        padding: 0.5rem;
    }

    .info-item {
        display: flex; flex-direction: column; gap: 6px;
    }

    .info-label {
        font-size: 0.75rem; font-weight: 600;
        color: var(--text-muted); text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 1rem; color: var(--text-dark); font-weight: 500;
    }

    /* Status Badges */
    .badge-custom {
        padding: 6px 16px; border-radius: 10px; font-weight: 700; font-size: 0.75rem;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .status-selesai { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
    .urgency-rendah { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
    .urgency-sedang { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
    .urgency-tinggi { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }

    /* Photos Section */
    .foto-container {
        display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;
    }
    .foto-item {
        background: #f8fafc; border-radius: 16px; padding: 1rem;
        border: 1px solid var(--border-color);
    }
    .foto-display {
        width: 100%; height: 220px; object-fit: cover;
        border-radius: 12px; margin-top: 10px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        transition: filter 0.3s ease;
    }
    .foto-display:hover { filter: brightness(0.9); cursor: zoom-in; }

    .no-foto-placeholder {
        width: 100%; height: 220px; border-radius: 12px;
        background: #f1f5f9; border: 2px dashed #cbd5e1;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        color: #94a3b8; margin-top: 10px;
    }

    .catatan-content {
        background: #f8fafc; border-left: 4px solid #6366f1;
        padding: 1.25rem; border-radius: 0 12px 12px 0;
        font-style: italic; color: #475569;
    }

    @media (max-width: 992px) { .info-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 576px) {
        .info-grid { grid-template-columns: 1fr; }
        .foto-container { grid-template-columns: 1fr; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Detail Riwayat Laporan</h4>
                <p class="mb-0 opacity-75">Manajemen perbaikan fasilitas sekolah</p>
            </div>
            <a href="{{ route('teknisi.laporan.riwayat') }}" class="btn-back">
                <i class='bx bx-left-arrow-alt fs-4'></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            {{-- DATA UTAMA --}}
            <div class="detail-card card">
                <div class="card-header">
                    <i class='bx bxs-info-circle me-2 text-primary'></i> Rincian Informasi
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nama Pelapor</span>
                            <span class="info-value">{{ $laporan->user->name ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fasilitas</span>
                            <span class="info-value">{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Lokasi</span>
                            <span class="info-value"><i class='bx bx-map-pin text-danger'></i> {{ $laporan->lokasi->nama_lokasi ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tingkat Urgensi</span>
                            <div>
                                <span class="badge-custom urgency-{{ $laporan->tingkat_urgency }}">
                                    {{ ucfirst($laporan->tingkat_urgency) }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status Akhir</span>
                            <div>
                                <span class="badge-custom status-selesai">
                                    <i class='bx bxs-check-shield'></i> Selesai
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Waktu Pengerjaan</span>
                            <span class="info-value text-muted small">
                                {{ $laporan->created_at->format('d M') }} — {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <hr class="my-4" style="border-color: #f1f5f9">
                    <div class="info-item">
                        <span class="info-label">Deskripsi Kerusakan</span>
                        <p class="info-value mb-0">{{ $laporan->deskripsi }}</p>
                    </div>
                </div>
            </div>

            {{-- CATATAN --}}
            <div class="detail-card card">
                <div class="card-header">
                    <i class='bx bxs-quote-alt-left me-2 text-primary'></i> Catatan Penyelesaian Teknisi
                </div>
                <div class="card-body">
                    <div class="catatan-content">
                        "{{ $laporan->catatan ?? 'Tidak ada catatan tambahan dari teknisi.' }}"
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- DOKUMENTASI --}}
            <div class="detail-card card h-100">
                <div class="card-header">
                    <i class='bx bxs-camera me-2 text-primary'></i> Dokumentasi Visual
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <span class="info-label">Kondisi Awal</span>
                        @if($laporan->foto)
                            <img src="{{ Storage::url($laporan->cover) }}" class="foto-display" onclick="window.open(this.src)">
                        @else
                            <div class="no-foto-placeholder">
                                <i class='bx bx-image-alt fs-1'></i>
                                <span class="small">Tanpa Foto</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <span class="info-label">Hasil Perbaikan</span>
                        @if($laporan->foto_sesudah)
                            <img src="{{ Storage::url($laporan->foto_sesudah) }}" class="foto-display" onclick="window.open(this.src)">
                        @else
                            <div class="no-foto-placeholder">
                                <i class='bx bx-image-alt fs-1'></i>
                                <span class="small">Tanpa Foto</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
