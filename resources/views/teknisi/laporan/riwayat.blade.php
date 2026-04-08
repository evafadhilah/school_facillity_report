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
    }
    .header-title h4 { margin: 0; font-size: 1.8rem; font-weight: 700; color: white; }
    .header-title p  { margin: 0.5rem 0 0 0; font-size: 0.95rem; color: white; opacity: 0.9; }

    .table-card { border: none; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); overflow: hidden; }
    .table-card .card-body { padding: 0; }

    .table thead th {
        background: #f8f7ff;
        color: #4338ca;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
    }
    .table tbody td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
        color: #374151;
        font-size: 0.92rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .table tbody tr:hover { background: #f8f7ff; }
    .table tbody tr:last-child td { border-bottom: none; }

    .badge-selesai {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
        background: #d1fae5;
        color: #059669;
    }

    .btn-detail {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
    }
    .btn-detail:hover { transform: translateY(-1px); color: white; opacity: 0.9; }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9ca3af;
    }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }

    .stat-badge {
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        display: inline-block;
    }
    .stat-badge span { font-size: 1.8rem; font-weight: 700; display: block; }
    .stat-badge p { margin: 0; font-size: 0.85rem; opacity: 0.9; }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4><i class='bx bx-history me-2'></i>Riwayat Laporan</h4>
                <p>Laporan yang telah kamu selesaikan</p>
            </div>
            <div class="mt-3">
                <div class="stat-badge">
                    <span>{{ $riwayats->total() }}</span>
                    <p>Total Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-body">
            @if($riwayats->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelapor</th>
                                <th>Fasilitas</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayats as $i => $laporan)
                            <tr>
                                <td>{{ $riwayats->firstItem() + $i }}</td>
                                <td>{{ $laporan->nama_pelapor ?? $laporan->user->name ?? '-' }}</td>
                                <td>{{ $laporan->fasilitas->nama_fasilitas ?? '-' }}</td>
                                <td>{{ $laporan->lokasi->nama_lokasi ?? '-' }}</td>
                                <td>{{ Str::limit($laporan->deskripsi, 40) }}</td>
                                <td>
                                    <span class="badge-selesai">
                                        <i class='bx bx-check-circle'></i> Selesai
                                    </span>
                                </td>
                                <td>
                                    @if($laporan->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($laporan->tanggal_selesai)->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teknisi.laporan.edit', $laporan->id) }}" class="btn-detail">
                                        <i class='bx bx-show'></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="padding: 1.25rem; border-top: 1px solid #f3f4f6;">
                    {{ $riwayats->links() }}
                </div>

            @else
                <div class="empty-state">
                    <i class='bx bx-history'></i>
                    <p style="font-size:1.1rem; font-weight:600; color:#6b7280;">Belum ada laporan yang diselesaikan</p>
                    <p style="font-size:0.9rem;">Laporan yang sudah kamu tandai selesai akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
