@extends('layouts.backend')

@section('title', 'Laporan Saya')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .badge-urgency {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .badge-tinggi  { background: #fee2e2; color: #dc2626; }
    .badge-sedang  { background: #fef3c7; color: #d97706; }
    .badge-rendah  { background: #d1fae5; color: #059669; }

    .badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .badge-ditugaskan { background: #dbeafe; color: #1d4ed8; }
    .badge-diproses   { background: #fef3c7; color: #d97706; }
    .badge-selesai    { background: #d1fae5; color: #059669; }

    .btn-edit {
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
    .btn-edit:hover { transform: translateY(-1px); color: white; opacity: 0.9; }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #9ca3af;
    }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        border: none;
        border-radius: 12px;
        color: #065f46;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4><i class='bx bx-clipboard me-2'></i>Laporan Saya</h4>
                <p>Daftar laporan yang ditugaskan kepada kamu</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class='bx bx-check-circle me-2'></i>{{ session('success') }}
        </div>
    @endif

    <div class="card table-card">
        <div class="card-body">
            @if($laporans->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pelapor</th>
                                <th>Fasilitas</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporans as $i => $laporan)
                            <tr>
                                <td>{{ $laporans->firstItem() + $i }}</td>
                                <td>{{ $laporan->nama_pelapor ?? $laporan->user->name ?? '-' }}</td>
                                <td>{{ $laporan->fasilitas->nama ?? '-' }}</td>
                                <td>{{ $laporan->lokasi->nama ?? '-' }}</td>
                                <td>{{ Str::limit($laporan->deskripsi, 40) }}</td>
                                <td>
                                    <span class="badge-urgency badge-{{ $laporan->tingkat_urgency }}">
                                        {{ ucfirst($laporan->tingkat_urgency) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status badge-{{ $laporan->status }}">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </td>
                                <td>{{ $laporan->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('teknisi.laporan.edit', $laporan->id) }}" class="btn-edit">
                                        <i class='bx bx-edit'></i> Update
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="padding: 1.25rem; border-top: 1px solid #f3f4f6;">
                    {{ $laporans->links() }}
                </div>

            @else
                <div class="empty-state">
                    <i class='bx bx-clipboard'></i>
                    <p style="font-size:1.1rem; font-weight:600; color:#6b7280;">Belum ada laporan yang ditugaskan</p>
                    <p style="font-size:0.9rem;">Laporan akan muncul di sini setelah admin menugaskan ke kamu</p>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
