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
        opacity: 0.9;
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
        white-space: nowrap;
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,255,255,0.4);
        color: #764ba2;
        text-decoration: none;
    }

    .detail-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .detail-card .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #e5e7eb;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .detail-card .card-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #4338ca;
    }
    .detail-card .card-body {
        padding: 1.5rem;
        background: white;
    }

    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
        align-items: flex-start;
    }
    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .info-label {
        width: 160px;
        min-width: 160px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #6b7280;
        padding-top: 2px;
    }
    .info-value {
        flex: 1;
        font-size: 0.92rem;
        color: #1f2937;
    }

    .badge-status {
        padding: 0.4rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.82rem;
        display: inline-flex;
        align-items: center;
    }
    .badge-pending    { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
    .badge-diproses   { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
    .badge-selesai    { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
    .badge-ditolak    { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }
    .badge-ditugaskan { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; }

    .badge-urgency {
        padding: 0.4rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.82rem;
        display: inline-flex;
        align-items: center;
    }
    .badge-rendah { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; }
    .badge-sedang { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
    .badge-tinggi { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }

    .foto-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 0.25rem;
    }
    .foto-grid img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .foto-grid img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border-color: #667eea;
    }

    .action-footer {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    .btn-action {
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.88rem;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-decoration: none;
        cursor: pointer;
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
        .info-row { flex-direction: column; gap: 0.25rem; }
        .info-label { width: 100%; }
    }
    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header --}}
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Detail Laporan</h4>
                <p>Informasi lengkap laporan kerusakan</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri --}}
        <div class="col-lg-8">

            {{-- Info Pelapor --}}
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-user' style="color:#4338ca; font-size:1.1rem;"></i>
                    <h6>Informasi Pelapor</h6>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-user me-1'></i> Nama</div>
                        <div class="info-value"><strong>{{ $laporan->user->name ?? $laporan->nama_pelapor ?? '-' }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-group me-1'></i> Kelas</div>
                        <div class="info-value">{{ $laporan->kelas->nama_kelas ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-calendar me-1'></i> Tanggal Lapor</div>
                        <div class="info-value">{{ $laporan->created_at ? $laporan->created_at->format('d M Y, H:i') : '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- Info Kerusakan --}}
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-wrench' style="color:#4338ca; font-size:1.1rem;"></i>
                    <h6>Informasi Kerusakan</h6>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-category me-1'></i> Kategori</div>
                        <div class="info-value">{{ $laporan->kategori->nama_kategori ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-desktop me-1'></i> Fasilitas</div>
                        <div class="info-value">{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-map me-1'></i> Lokasi</div>
                        <div class="info-value">{{ $laporan->lokasi->nama_lokasi ?? '-' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label"><i class='bx bx-file-blank me-1'></i> Deskripsi</div>
                        <div class="info-value" style="white-space: pre-line;">{{ $laporan->deskripsi ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- Catatan Penolakan --}}
            @if($laporan->status == 'ditolak' && $laporan->catatan_penolakan)
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-x-circle' style="color:#ef4444; font-size:1.1rem;"></i>
                    <h6 style="color:#ef4444;">Alasan Penolakan</h6>
                </div>
                <div class="card-body">
                    <div class="catatan-tolak-box">
                        <i class='bx bx-error-circle'></i>
                        <span>{{ $laporan->catatan_penolakan }}</span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Foto --}}
            @php
                $fotos = is_array($laporan->foto)
                    ? $laporan->foto
                    : json_decode($laporan->foto, true) ?? ($laporan->foto ? [$laporan->foto] : []);
            @endphp
            @if($fotos && count($fotos) > 0)
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-image' style="color:#4338ca; font-size:1.1rem;"></i>
                    <h6>Foto Kerusakan</h6>
                </div>
                <div class="card-body">
                    <div class="foto-grid">
                        @foreach($fotos as $foto)
                            <img src="{{ Storage::url($foto) }}"
                                 alt="foto kerusakan"
                                 onclick="window.open('{{ Storage::url($foto) }}', '_blank')"
                                 title="Klik untuk lihat full">
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-4">

            {{-- Status & Urgency --}}
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-info-circle' style="color:#4338ca; font-size:1.1rem;"></i>
                    <h6>Status Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            @php $status = strtolower($laporan->status ?? '') @endphp
                            <span class="badge-status badge-{{ $status }}">
                                {{ ucfirst($laporan->status ?? '-') }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Urgency</div>
                        <div class="info-value">
                            @php $urgency = strtolower($laporan->tingkat_urgency ?? '') @endphp
                            @if($urgency)
                                <span class="badge-urgency badge-{{ $urgency }}">
                                    {{ ucfirst($laporan->tingkat_urgency) }}
                                </span>
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Teknisi</div>
                        <div class="info-value">{{ $laporan->teknisi->name ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="card detail-card">
                <div class="card-header">
                    <i class='bx bx-cog' style="color:#4338ca; font-size:1.1rem;"></i>
                    <h6>Aksi</h6>
                </div>
                <div class="card-body">
                    <div class="action-footer" style="flex-direction:column;">
                        <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="btn-action btn-edit" style="width:100%; justify-content:center;">
                            <i class='bx bx-edit'></i> Edit Laporan
                        </a>
                        <form action="{{ route('admin.laporan.destroy', $laporan->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" style="width:100%; justify-content:center;">
                                <i class='bx bx-trash'></i> Hapus Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
