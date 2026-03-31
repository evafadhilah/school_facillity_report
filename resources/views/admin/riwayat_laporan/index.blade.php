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
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Filter bar */
    .filter-bar {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .filter-bar label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0;
        white-space: nowrap;
    }
    .filter-select {
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.45rem 0.9rem;
        font-size: 0.85rem;
        color: #374151;
        background: #f9fafb;
        transition: all 0.2s;
        cursor: pointer;
        outline: none;
    }
    .filter-select:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
    }
    .filter-info {
        margin-left: auto;
        font-size: 0.82rem;
        color: #9ca3af;
        white-space: nowrap;
    }

    /* Table */
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
        padding: 0.9rem 0.85rem;
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
        background: linear-gradient(to right, #f5f3ff 0%, #ffffff 100%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* No cell dengan dot */
    .no-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
    }
    .dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .dot-pending    { background: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.2); }
    .dot-diproses,
    .dot-proses     { background: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }
    .dot-selesai    { background: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.2); }
    .dot-ditolak    { background: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,0.2); }
    .dot-ditugaskan { background: #8b5cf6; box-shadow: 0 0 0 3px rgba(139,92,246,0.2); }

    /* Laporan cell */
    .laporan-cell { display: flex; flex-direction: column; gap: 0.1rem; }
    .lap-id   { font-size: 0.73rem; color: #9ca3af; font-family: monospace; }
    .lap-name { font-weight: 600; color: #1f2937; font-size: 0.87rem; }
    .lap-loc  { font-size: 0.75rem; color: #9ca3af; }

    /* Pelapor cell */
    .pelapor-cell { display: flex; flex-direction: column; gap: 0.1rem; }
    .pel-name  { font-weight: 600; color: #1f2937; font-size: 0.87rem; }
    .pel-kelas { font-size: 0.75rem; color: #9ca3af; }

    /* Teknisi cell */
    .teknisi-cell { display: flex; align-items: center; gap: 0.5rem; }
    .teknisi-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.72rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* Catatan */
    .catatan-text {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        color: #6b7280;
        font-size: 0.85rem;
    }

    /* Badge Status */
    .badge-status {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.76rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        white-space: nowrap;
    }
    .badge-pending    { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .badge-diproses,
    .badge-proses     { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
    .badge-selesai    { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .badge-ditolak    { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .badge-ditugaskan { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

    /* Empty state */
    .empty-state { padding: 3rem 1rem; text-align: center; }
    .empty-state i { font-size: 4rem; color: #d1d5db; margin-bottom: 1rem; display: block; }
    .empty-state p { color: #9ca3af; font-size: 1rem; margin: 0; }

    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .filter-bar { flex-direction: column; align-items: flex-start; }
        .filter-info { margin-left: 0; }
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
                <h4><i class='bx bx-history me-2'></i>Riwayat Laporan</h4>
                <p>Histori dan rekam jejak penanganan laporan kerusakan fasilitas</p>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="filter-bar">
        <label><i class='bx bx-filter-alt me-1'></i> Filter Status</label>
        <select class="filter-select" id="filterStatus" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="diproses">Diproses</option>
            <option value="ditugaskan">Ditugaskan</option>
            <option value="selesai">Selesai</option>
            <option value="ditolak">Ditolak</option>
        </select>
        <span class="filter-info" id="filterInfo">
            Menampilkan {{ $riwayatLaporans->count() }} riwayat
        </span>
    </div>

    {{-- Tabel --}}
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table custom-table" id="riwayatTable">
                    <thead>
                        <tr>
                            <th style="width:50px;" class="text-center">No</th>
                            <th>Laporan</th>
                            <th>Pelapor</th>
                            <th>Teknisi</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatLaporans as $riwayat)
                        @php
                            $statusSlug = strtolower(str_replace(' ', '', $riwayat->status ?? ''));
                            $icon = match($statusSlug) {
                                'selesai'            => 'bx-check-circle',
                                'diproses', 'proses' => 'bx-loader-alt',
                                'ditolak'            => 'bx-x-circle',
                                'ditugaskan'         => 'bx-user-check',
                                default              => 'bx-time-five',
                            };
                        @endphp
                        <tr data-status="{{ $statusSlug }}">

                            {{-- No --}}
                            <td class="text-center">
                                <div class="no-cell">
                                    <div class="dot dot-{{ $statusSlug }}"></div>
                                    <strong>{{ $loop->iteration }}</strong>
                                </div>
                            </td>

                            {{-- Laporan --}}
                            <td>
                                <div class="laporan-cell">
                                    <span class="lap-id">#{{ $riwayat->laporan->id ?? '-' }}</span>
                                    <span class="lap-name">
                                        {{ $riwayat->laporan->fasilitas->nama_fasilitas ?? ($riwayat->laporan->deskripsi ?? 'Laporan') }}
                                    </span>
                                    <span class="lap-loc">
                                        {{ $riwayat->laporan->lokasi->nama_lokasi ?? '' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Pelapor --}}
                            <td>
                                <div class="pelapor-cell">
                                    <span class="pel-name">{{ $riwayat->laporan->user->name ?? '-' }}</span>
                                    <span class="pel-kelas">{{ $riwayat->laporan->kelas->nama_kelas ?? '' }}</span>
                                </div>
                            </td>

                            {{-- Teknisi --}}
                            <td>
                                @if($riwayat->teknisi)
                                <div class="teknisi-cell">
                                    <div class="teknisi-avatar">
                                        {{ strtoupper(substr($riwayat->teknisi->name, 0, 2)) }}
                                    </div>
                                    <span>{{ $riwayat->teknisi->name }}</span>
                                </div>
                                @else
                                <span style="color:#d1d5db; font-size:0.85rem;">Belum ditugaskan</span>
                                @endif
                            </td>

                            {{-- Catatan --}}
                            <td>
                                <span class="catatan-text" title="{{ $riwayat->catatan }}">
                                    {{ $riwayat->catatan ?? '-' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge-status badge-{{ $statusSlug }}">
                                    <i class='bx {{ $icon }}'></i>
                                    {{ ucfirst($riwayat->status ?? '-') }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td style="white-space:nowrap;">
                                <div style="font-weight:600; color:#374151; font-size:0.87rem;">
                                    {{ $riwayat->created_at ? $riwayat->created_at->format('d M Y') : '-' }}
                                </div>
                                <small style="color:#9ca3af;">
                                    {{ $riwayat->created_at ? $riwayat->created_at->format('H:i') : '' }}
                                </small>
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

<script>
function filterTable() {
    const filter = document.getElementById('filterStatus').value.toLowerCase();
    const rows   = document.querySelectorAll('#riwayatTable tbody tr[data-status]');
    let visible  = 0;

    rows.forEach(row => {
        const match = !filter || row.getAttribute('data-status') === filter;
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    document.getElementById('filterInfo').textContent = `Menampilkan ${visible} riwayat`;
}
</script>

@endsection
