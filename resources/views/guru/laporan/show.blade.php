@extends('layouts.backend')

@section('title', 'Detail Laporan')

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

    .detail-card .card-body { padding: 2rem; }

    .detail-label {
        font-weight: 700;
        color: #4338ca;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        color: #4b5563;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .detail-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        background: #f9fafb;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        border: 1px solid #f3f4f6;
    }

    .detail-divider {
        border: none;
        border-top: 2px dashed #e5e7eb;
        margin: 1.5rem 0;
    }

    .cover-img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
    }

    .badge {
        padding: 0.5rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-pending      { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .badge-diproses     { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
    .badge-selesai      { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .badge-ditolak      { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .badge-ditugaskan   { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

    .badge-urgency  { padding: 0.5rem 0.875rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.25rem; }
    .badge-rendah   { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .badge-sedang   { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .badge-tinggi   { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

    .catatan-box {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        color: #92400e;
        font-size: 0.95rem;
    }

    .catatan-tolak-box {
        background: #fff5f5;
        border: 1.5px solid #fca5a5;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        color: #991b1b;
        font-size: 0.95rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .catatan-tolak-box i {
        font-size: 1.3rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .btn-back { width: 100%; justify-content: center; }
        .detail-card .card-body { padding: 1.25rem; }
        .detail-row { grid-template-columns: 1fr; gap: 1rem; }
    }

    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Detail Laporan</h4>
                <p>Informasi lengkap laporan fasilitas</p>
            </div>
            <a href="{{ route('guru.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    <div class="card detail-card">
        <div class="card-body">

            {{-- Row 1 --}}
            <div class="detail-row">
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-user me-1'></i> Pelapor</p>
                    <p class="detail-value">{{ $laporan->nama_pelapor ?? $laporan->user->name ?? '-' }}</p>
                </div>
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-calendar me-1'></i> Tanggal</p>
                    <p class="detail-value">{{ $laporan->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>

            {{-- Row 2 --}}
            <div class="detail-row">
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-category me-1'></i> Kategori</p>
                    <p class="detail-value">{{ $laporan->kategori->nama_kategori ?? '-' }}</p>
                </div>
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-buildings me-1'></i> Fasilitas</p>
                    <p class="detail-value">{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</p>
                </div>
            </div>

            {{-- Row 3 --}}
            <div class="detail-row">
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-map me-1'></i> Lokasi</p>
                    <p class="detail-value">{{ $laporan->lokasi->nama_lokasi ?? '-' }}</p>
                </div>
                <div class="detail-item">
                    <p class="detail-label"><i class='bx bx-signal-5 me-1'></i> Tingkat Urgency</p>
                    @php $urgency = strtolower($laporan->tingkat_urgency ?? 'rendah'); @endphp
                    <span class="badge-urgency badge-{{ $urgency }}">
                        @if($urgency == 'rendah') <i class='bx bx-down-arrow-circle'></i>
                        @elseif($urgency == 'sedang') <i class='bx bx-minus-circle'></i>
                        @else <i class='bx bx-up-arrow-circle'></i>
                        @endif
                        {{ ucfirst($urgency) }}
                    </span>
                </div>
            </div>

            {{-- Status --}}
            <div class="detail-item mb-4">
                <p class="detail-label"><i class='bx bx-info-circle me-1'></i> Status</p>
                @if($laporan->status == 'pending')
                    <span class="badge badge-pending"><i class='bx bx-time-five'></i> Pending</span>
                @elseif($laporan->status == 'ditugaskan')
                    <span class="badge badge-ditugaskan"><i class='bx bx-user-check'></i> Ditugaskan</span>
                @elseif($laporan->status == 'diproses')
                    <span class="badge badge-diproses"><i class='bx bx-loader-alt'></i> Diproses</span>
                @elseif($laporan->status == 'selesai')
                    <span class="badge badge-selesai"><i class='bx bx-check'></i> Selesai</span>
                @elseif($laporan->status == 'ditolak')
                    <span class="badge badge-ditolak"><i class='bx bx-x-circle'></i> Ditolak</span>
                @else
                    {{ $laporan->status }}
                @endif
            </div>

            {{-- Catatan Penolakan --}}
            @if($laporan->status == 'ditolak' && $laporan->catatan_penolakan)
                <div class="mb-4">
                    <p class="detail-label mb-2"><i class='bx bx-x-circle me-1'></i> Alasan Penolakan</p>
                    <div class="catatan-tolak-box">
                        <i class='bx bx-error-circle'></i>
                        <span>{{ $laporan->catatan_penolakan }}</span>
                    </div>
                </div>
            @endif

            <hr class="detail-divider">

            {{-- Deskripsi --}}
            <div class="detail-item mb-4">
                <p class="detail-label"><i class='bx bx-note me-1'></i> Deskripsi Kerusakan</p>
                <p class="detail-value">{{ $laporan->deskripsi }}</p>
            </div>

            {{-- Cover --}}
            @if($laporan->cover)
                <div class="mb-4">
                    <p class="detail-label mb-2"><i class='bx bx-image me-1'></i> Foto Kerusakan</p>
                    <a href="{{ asset('storage/' . $laporan->cover) }}" target="_blank">
                        <img src="{{ asset('storage/' . $laporan->cover) }}" class="cover-img" alt="Foto Kerusakan">
                    </a>
                </div>
            @endif

            {{-- Catatan Teknisi --}}
            @if($laporan->catatan)
                <hr class="detail-divider">
                <div class="mb-2">
                    <p class="detail-label mb-2"><i class='bx bx-comment-detail me-1'></i> Catatan Teknisi</p>
                    <div class="catatan-box">{{ $laporan->catatan }}</div>
                </div>
            @endif

            {{-- Foto Sesudah --}}
            @if($laporan->foto_sesudah)
                <div class="mt-4">
                    <p class="detail-label mb-2"><i class='bx bx-image-check me-1'></i> Foto Sesudah Perbaikan</p>
                    <a href="{{ asset('storage/' . $laporan->foto_sesudah) }}" target="_blank">
                        <img src="{{ asset('storage/' . $laporan->foto_sesudah) }}" class="cover-img" alt="Foto Sesudah">
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
