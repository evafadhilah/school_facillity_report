@extends('layouts.backend')

@section('title', 'Detail Laporan')

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
        top: -50%;
        right: -5%;
        width: 200px;
        height: 200px;
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
        opacity: 0.95;
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

    /* Main Detail Container */
    .detail-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    /* Detail Card */
    .detail-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

    .card-header-custom {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .card-header-custom i {
        font-size: 1.5rem;
        color: #667eea;
    }

    .card-header-custom h5 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Info Row */
    .info-row {
        display: flex;
        align-items: flex-start;
        padding: 0.875rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-radius: 10px;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .info-icon i {
        font-size: 1.25rem;
        color: #667eea;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
        word-wrap: break-word;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .status-proses {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
    }

    .status-selesai {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    /* Full Width Cards */
    .full-width-card {
        grid-column: span 2;
    }

    .description-content {
        background: #f9fafb;
        padding: 1.25rem;
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.7;
        color: #4b5563;
        border-left: 4px solid #667eea;
        min-height: 100px;
    }

    /* Photo Container */
    .photo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f9fafb;
        padding: 2rem;
        border-radius: 12px;
        min-height: 300px;
    }

    .photo-wrapper img {
        max-width: 100%;
        max-height: 500px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        object-fit: contain;
    }

    .no-photo {
        text-align: center;
        color: #9ca3af;
        font-size: 0.95rem;
    }

    .no-photo i {
        font-size: 3rem;
        display: block;
        margin-bottom: 0.5rem;
        opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .detail-container {
            grid-template-columns: 1fr;
        }

        .full-width-card {
            grid-column: span 1;
        }
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

        .detail-header {
            padding: 1.5rem;
        }

        .header-title h4 {
            font-size: 1.5rem;
        }

        .detail-card {
            padding: 1.25rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="detail-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Detail Laporan</h4>
                <p>Informasi lengkap laporan fasilitas</p>
            </div>
            <a href="{{ route('siswa.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    <!-- Detail Container -->
    <div class="detail-container">

        <!-- Card 1: Informasi Pelapor -->
        <div class="detail-card">
            <div class="card-header-custom">
                <i class='bx bx-user-circle'></i>
                <h5>Informasi Pelapor</h5>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Nama Pelapor</div>
                    <div class="info-value">{{ $laporan->nama_pelapor }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-book'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Kelas</div>
                    <div class="info-value">{{ $laporan->kelas->nama_kelas }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-calendar'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Tanggal Lapor</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Informasi Fasilitas -->
        <div class="detail-card">
            <div class="card-header-custom">
                <i class='bx bx-building'></i>
                <h5>Informasi Fasilitas</h5>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-category'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Kategori</div>
                    <div class="info-value">{{ $laporan->kategori->nama_kategori }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-buildings'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Fasilitas</div>
                    <div class="info-value">{{ $laporan->fasilitas->nama_fasilitas }}</div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-map'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Lokasi</div>
                    <div class="info-value">{{ $laporan->lokasi->nama_lokasi }}</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Status (Full Width) -->
        <div class="detail-card full-width-card">
            <div class="card-header-custom">
                <i class='bx bx-info-circle'></i>
                <h5>Status Laporan</h5>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <i class='bx bx-timer'></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Status Saat Ini</div>
                    <div class="info-value">
                        @if($laporan->status == 'pending')
                            <span class="status-badge status-pending">
                                <i class='bx bx-time-five'></i> Menunggu Proses
                            </span>
                        @elseif($laporan->status == 'proses')
                            <span class="status-badge status-proses">
                                <i class='bx bx-loader-alt bx-spin'></i> Sedang Diproses
                            </span>
                        @else
                            <span class="status-badge status-selesai">
                                <i class='bx bx-check-circle'></i> Selesai Diperbaiki
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Deskripsi (Full Width) -->
        <div class="detail-card full-width-card">
            <div class="card-header-custom">
                <i class='bx bx-note'></i>
                <h5>Deskripsi Kerusakan</h5>
            </div>
            <div class="description-content">
                {{ $laporan->deskripsi }}
            </div>
        </div>

        <!-- Card 5: Foto (Full Width) -->
        <div class="detail-card full-width-card">
            <div class="card-header-custom">
                <i class='bx bx-camera'></i>
                <h5>Foto Laporan</h5>
            </div>
            <div class="photo-wrapper">
                @if($laporan->foto)
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan">
                @else
                    <div class="no-photo">
                        <i class='bx bx-image'></i>
                        <p>Tidak ada foto</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection
