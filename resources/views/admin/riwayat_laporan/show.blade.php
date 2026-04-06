@extends('layouts.backend')

@section('title', 'Detail Riwayat Laporan')

@section('content')

<style>
    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .detail-header::before {
        content: '';
        position: absolute;
        top: -50%; right: -5%;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.1);
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
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,255,255,0.4);
        color: #764ba2;
    }

    /* Grid layout */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .full-width { grid-column: span 2; }

    /* Card */
    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        border: 1px solid #e5e7eb;
    }
    .card-head {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }
    .card-head i {
        font-size: 1.4rem;
        color: #667eea;
    }
    .card-head h5 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Info row */
    .info-row {
        display: flex;
        align-items: flex-start;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .info-row:last-child { border-bottom: none; }
    .info-icon {
        width: 38px; height: 38px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #667eea15, #764ba215);
        border-radius: 10px;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    .info-icon i { font-size: 1.2rem; color: #667eea; }
    .info-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.2rem;
    }
    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1f2937;
    }

    /* Status badge */
    .badge-selesai {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
    }

    /* Deskripsi */
    .desc-box {
        background: #f9fafb;
        padding: 1.25rem;
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.7;
        color: #4b5563;
        border-left: 4px solid #667eea;
        min-height: 80px;
    }

    /* Foto grid */
    .foto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
        background: #f9fafb;
        padding: 1rem;
        border-radius: 12px;
    }
    .foto-grid a img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .foto-grid a img:hover { transform: scale(1.04); }
    .no-foto {
        text-align: center;
        padding: 2.5rem 1rem;
        color: #9ca3af;
        background: #f9fafb;
        border-radius: 12px;
    }
    .no-foto i { font-size: 3rem; display: block; margin-bottom: 0.5rem; opacity: 0.4; }

    @media (max-width: 992px) {
        .detail-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
    }
    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .btn-back { width: 100%; justify-content: center; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="detail-header">
        <div class="header-content">
            <div class="header-title">
                <h4><i class='bx bx-file me-2'></i>Detail Riwayat Laporan</h4>
                <p>Informasi lengkap laporan #{{ $laporan->id }}</p>
            </div>
            <a href="{{ route('admin.riwayatlaporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    <div class="detail-grid">

        {{-- Card: Informasi Pelapor --}}
        <div class="detail-card">
            <div class="card-head">
                <i class='bx bx-user-circle'></i>
                <h5>Informasi Pelapor</h5>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-user'></i></div>
                <div>
                    <div class="info-label">Nama Pelapor</div>
                    <div class="info-value">{{ $laporan->user->name ?? $laporan->nama_pelapor ?? '-' }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-book'></i></div>
                <div>
                    <div class="info-label">Kelas</div>
                    <div class="info-value">{{ $laporan->kelas->nama_kelas ?? '-' }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-calendar'></i></div>
                <div>
                    <div class="info-label">Tanggal Lapor</div>
                    <div class="info-value">
                        {{ $laporan->created_at ? $laporan->created_at->format('d M Y, H:i') : '-' }} WIB
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Informasi Fasilitas --}}
        <div class="detail-card">
            <div class="card-head">
                <i class='bx bx-building'></i>
                <h5>Informasi Fasilitas</h5>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-category'></i></div>
                <div>
                    <div class="info-label">Kategori</div>
                    <div class="info-value">{{ $laporan->kategori->nama_kategori ?? '-' }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-buildings'></i></div>
                <div>
                    <div class="info-label">Fasilitas</div>
                    <div class="info-value">{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon"><i class='bx bx-map'></i></div>
                <div>
                    <div class="info-label">Lokasi</div>
                    <div class="info-value">{{ $laporan->lokasi->nama_lokasi ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- Card: Status --}}
        <div class="detail-card full-width">
            <div class="card-head">
                <i class='bx bx-info-circle'></i>
                <h5>Status Laporan</h5>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class='bx bx-check-shield'></i></div>
                <div>
                    <div class="info-label">Status</div>
                    <div class="info-value" style="margin-top:0.25rem;">
                        <span class="badge-selesai">
                            <i class='bx bx-check-circle'></i> Selesai Diperbaiki
                        </span>
                    </div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon"><i class='bx bx-time-five'></i></div>
                <div>
                    <div class="info-label">Tanggal Selesai</div>
                    <div class="info-value">
                        {{ $laporan->updated_at ? $laporan->updated_at->format('d M Y, H:i') : '-' }} WIB
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Deskripsi --}}
        <div class="detail-card full-width">
            <div class="card-head">
                <i class='bx bx-note'></i>
                <h5>Deskripsi Kerusakan</h5>
            </div>
            <div class="desc-box">{{ $laporan->deskripsi ?? '-' }}</div>
        </div>

        {{-- Card: Foto --}}
        <div class="detail-card full-width">
            <div class="card-head">
                <i class='bx bx-camera'></i>
                <h5>Foto Laporan</h5>
            </div>

            @php
                $fotoRaw = $laporan->foto;
                $fotos = [];
                if ($fotoRaw) {
                    $decoded = json_decode($fotoRaw, true);
                    $fotos = is_array($decoded) ? $decoded : [$fotoRaw];
                }
            @endphp

            @if(count($fotos) > 0)
                <div class="foto-grid">
                    @foreach($fotos as $foto)
                        <a href="{{ asset('storage/' . $foto) }}" target="_blank">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Laporan">
                        </a>
                    @endforeach
                </div>
            @else
                <div class="no-foto">
                    <i class='bx bx-image'></i>
                    <p>Tidak ada foto</p>
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
