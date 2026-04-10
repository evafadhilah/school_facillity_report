<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.backend')

@section('content')

<style>
    /* ── Stat Cards ── */
    .stat-card {
        border: none;
        border-radius: 20px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.13);
    }
    .stat-card::after {
        content: '';
        position: absolute;
        top: -20px; right: -20px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
    }
    .stat-card .stat-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: rgba(255,255,255,0.22);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        color: white;
        margin-bottom: 1rem;
    }
    .stat-card .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: white;
        line-height: 1;
        margin-bottom: 0.25rem;
    }
    .stat-card .stat-label {
        font-size: 0.88rem;
        color: rgba(255,255,255,0.82);
        font-weight: 500;
    }
    .stat-card .stat-sub {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.65);
        margin-top: 0.5rem;
    }
    .card-total   { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .card-proses  { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
    .card-selesai { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }

    /* ── Welcome Banner ── */
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 1.75rem 2rem;
        margin-bottom: 1.75rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(102,126,234,0.25);
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%; right: -5%;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -40%; left: -3%;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }
    .welcome-banner h4 {
        font-size: 1.5rem; font-weight: 700;
        margin: 0; position: relative; z-index: 1;
    }
    .welcome-banner p {
        margin: 0.4rem 0 0; font-size: 0.9rem;
        color: rgba(255,255,255,0.82); position: relative; z-index: 1;
    }

    /* ── Chart Cards ── */
    .chart-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        overflow: hidden;
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .chart-card .chart-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }
    .chart-card .chart-header h6 {
        margin: 0;
        font-weight: 700;
        color: #4338ca;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .chart-card .chart-header span {
        font-size: 0.8rem;
        color: #9ca3af;
    }
    .chart-body {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 1rem;
        flex-shrink: 0;
    }
    .chart-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        color: #6b7280;
    }
    .chart-legend-dot {
        width: 10px; height: 10px;
        border-radius: 2px;
        flex-shrink: 0;
    }
    .donut-legend-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.4rem 0;
        border-bottom: 1px solid #f9fafb;
        font-size: 0.82rem;
    }
    .donut-legend-row:last-child { border-bottom: none; }
    .donut-legend-left {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4b5563;
    }
    .donut-legend-val { font-weight: 700; color: #111827; }
    .donut-legend-pct { font-size: 0.73rem; color: #9ca3af; margin-left: 4px; }

    /* ── Section Tables ── */
    .section-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.07);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .section-card .section-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1rem 1.25rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }
    .section-card .section-header h6 {
        margin: 0;
        font-weight: 700;
        color: #4338ca;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .section-card .section-header a {
        font-size: 0.8rem;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }
    .section-card .section-header a:hover { text-decoration: underline; }
    .section-card .table-responsive {
        flex: 1;
    }

    .dash-table {
        margin: 0; width: 100%;
        border-collapse: collapse;
    }
    .dash-table thead th {
        padding: 0.75rem 1rem;
        font-size: 0.72rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #fafafa;
        border-bottom: 1px solid #f3f4f6;
        white-space: nowrap;
    }
    .dash-table tbody td {
        padding: 0.85rem 1rem;
        font-size: 0.85rem;
        color: #4b5563;
        border-bottom: 1px solid #f9fafb;
        vertical-align: middle;
        background: white;
    }
    .dash-table tbody tr:last-child td { border-bottom: none; }
    .dash-table tbody tr:hover td { background: #f9fafb; }

    .badge-status {
        padding: 0.3rem 0.65rem;
        border-radius: 7px;
        font-weight: 600;
        font-size: 0.73rem;
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        white-space: nowrap;
    }
    .badge-pending    { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .badge-diproses   { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
    .badge-selesai    { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .badge-ditolak    { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .badge-ditugaskan { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

    .badge-urgency {
        padding: 0.3rem 0.65rem;
        border-radius: 7px;
        font-weight: 600;
        font-size: 0.73rem;
        white-space: nowrap;
    }
    .badge-rendah { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .badge-sedang { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .badge-tinggi { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.5rem; color: #d1d5db; }

    .reporter-name { font-weight: 600; color: #111827; font-size: 0.85rem; }
    .reporter-sub  { font-size: 0.73rem; color: #9ca3af; }

    /* ── Row stretch fix ── */
    .row-stretch {
        align-items: stretch;
    }
    .row-stretch > [class*="col"] {
        display: flex;
        flex-direction: column;
    }
    .row-stretch > [class*="col"] > .card,
    .row-stretch > [class*="col"] > .chart-card,
    .row-stretch > [class*="col"] > .section-card {
        flex: 1;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        <h4>Selamat datang, {{ auth()->user()?->name ?? 'Admin' }}!</h4>
        <p>Berikut ringkasan laporan kerusakan fasilitas sekolah hari ini.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4 row-stretch">
        <div class="col-12 col-md-4">
            <div class="stat-card card-total">
                <div class="stat-icon"><i class='bx bx-file'></i></div>
                <div class="stat-value">{{ $totalLaporan ?? 0 }}</div>
                <div class="stat-label">Total Laporan</div>
                <div class="stat-sub">Semua laporan masuk</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card card-proses">
                <div class="stat-icon"><i class='bx bx-loader-alt'></i></div>
                <div class="stat-value">{{ $totalDiproses ?? 0 }}</div>
                <div class="stat-label">Dalam Penanganan Teknisi</div>
                <div class="stat-sub">Sedang dikerjakan</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="stat-card card-selesai">
                <div class="stat-icon"><i class='bx bx-check-circle'></i></div>
                <div class="stat-value">{{ $totalSelesai ?? 0 }}</div>
                <div class="stat-label">Laporan Selesai</div>
                <div class="stat-sub">Berhasil ditangani</div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="row g-4 mb-4 row-stretch">

        {{-- Bar Chart --}}
        <div class="col-12 col-xl-7">
            <div class="card chart-card">
                <div class="chart-header">
                    <h6><i class='bx bx-bar-chart-alt-2'></i> Laporan per Bulan</h6>
                    <span>{{ now()->year }}</span>
                </div>
                <div class="chart-body">
                    <div class="chart-legend">
                        <div class="chart-legend-item">
                            <div class="chart-legend-dot" style="background:#667eea;"></div>
                            Laporan masuk
                        </div>
                        <div class="chart-legend-item">
                            <div class="chart-legend-dot" style="background:#10b981;"></div>
                            Selesai
                        </div>
                    </div>
                    <div style="position:relative; width:100%; flex:1; min-height:220px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Donut Chart --}}
        <div class="col-12 col-xl-5">
            <div class="card chart-card">
                <div class="chart-header">
                    <h6><i class='bx bx-pie-chart-alt-2'></i> Status Laporan</h6>
                    <span>Semua waktu</span>
                </div>
                <div class="chart-body">
                    <div style="position:relative; width:100%; height:180px; flex-shrink:0;">
                        <canvas id="donutChart"></canvas>
                    </div>
                    <div class="mt-3">
                        @php
                            $statusLabels = ['Pending','Ditugaskan','Diproses','Selesai','Ditolak'];
                            $statusColors = ['#f59e0b','#8b5cf6','#3b82f6','#10b981','#ef4444'];
                            $totalStatus  = array_sum($statusData ?? [0,0,0,0,0]);
                        @endphp
                        @foreach($statusLabels as $i => $label)
                        <div class="donut-legend-row">
                            <div class="donut-legend-left">
                                <div class="chart-legend-dot" style="background:{{ $statusColors[$i] }};"></div>
                                {{ $label }}
                            </div>
                            <div>
                                <span class="donut-legend-val">{{ $statusData[$i] ?? 0 }}</span>
                                <span class="donut-legend-pct">
                                    ({{ $totalStatus > 0 ? round((($statusData[$i] ?? 0) / $totalStatus) * 100) : 0 }}%)
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- End Charts Row --}}

    {{-- Tables Row --}}
    <div class="row g-4 mb-4 row-stretch">

        {{-- Laporan Terbaru --}}
        <div class="col-12 col-xl-7">
            <div class="card section-card">
                <div class="section-header">
                    <h6><i class='bx bx-list-ul'></i> Laporan Terbaru</h6>
                    <a href="{{ route('admin.laporan.index') }}">Lihat semua →</a>
                </div>
                <div class="table-responsive">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th>Pelapor</th>
                                <th>Fasilitas</th>
                                <th>Lokasi</th>
                                <th>Urgency</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanTerbaru ?? [] as $lap)
                            <tr>
                                <td>
                                    <div class="reporter-name">{{ $lap->user->name ?? '-' }}</div>
                                    <div class="reporter-sub">{{ $lap->kelas->nama_kelas ?? '' }}</div>
                                </td>
                                <td>{{ $lap->fasilitas->nama_fasilitas ?? '-' }}</td>
                                <td>{{ $lap->lokasi->nama_lokasi ?? '-' }}</td>
                                <td>
                                    @php $u = strtolower($lap->tingkat_urgency ?? '') @endphp
                                    @if($u)
                                        <span class="badge-urgency badge-{{ $u }}">{{ ucfirst($lap->tingkat_urgency) }}</span>
                                    @else <span style="color:#d1d5db;">-</span> @endif
                                </td>
                                <td>
                                    @php $s = strtolower($lap->status ?? '') @endphp
                                    <span class="badge-status badge-{{ $s }}">{{ ucfirst($lap->status ?? '-') }}</span>
                                </td>
                                <td style="white-space:nowrap; color:#9ca3af; font-size:0.78rem;">
                                    {{ $lap->created_at?->format('d M Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6">
                                <div class="empty-state"><i class='bx bx-folder-open'></i>Belum ada laporan</div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Urgency Tinggi --}}
        <div class="col-12 col-xl-5">
            <div class="card section-card">
                <div class="section-header">
                    <h6><i class='bx bx-error' style="color:#ef4444;"></i> Urgency Tinggi</h6>
                    <a href="{{ route('admin.laporan.index') }}">Lihat semua →</a>
                </div>
                <div class="table-responsive">
                    <table class="dash-table">
                        <thead>
                            <tr>
                                <th>Pelapor</th>
                                <th>Fasilitas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanUrgent ?? [] as $lap)
                            <tr>
                                <td>
                                    <div class="reporter-name">{{ $lap->user->name ?? '-' }}</div>
                                    <div class="reporter-sub">{{ $lap->lokasi->nama_lokasi ?? '' }}</div>
                                </td>
                                <td>{{ $lap->fasilitas->nama_fasilitas ?? '-' }}</td>
                                <td>
                                    @php $s = strtolower($lap->status ?? '') @endphp
                                    <span class="badge-status badge-{{ $s }}">{{ ucfirst($lap->status ?? '-') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3">
                                <div class="empty-state"><i class='bx bx-check-shield'></i>Tidak ada laporan urgent</div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- End Tables Row --}}

</div>

{{-- Chart.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
    const dataMasuk   = @json($chartMasuk ?? array_fill(0, 12, 0));
    const dataSelesai = @json($chartSelesai ?? array_fill(0, 12, 0));
    const dataStatus  = @json($statusData ?? array_fill(0, 5, 0));

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
            datasets: [
                {
                    label: 'Laporan masuk',
                    data: dataMasuk,
                    backgroundColor: 'rgba(102,126,234,0.85)',
                    borderRadius: 6,
                    borderSkipped: false,
                },
                {
                    label: 'Selesai',
                    data: dataSelesai,
                    backgroundColor: 'rgba(16,185,129,0.85)',
                    borderRadius: 6,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 }, color: '#9ca3af', autoSkip: false }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { font: { size: 11 }, color: '#9ca3af', precision: 0 },
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending','Ditugaskan','Diproses','Selesai','Ditolak'],
            datasets: [{
                data: dataStatus,
                backgroundColor: ['#f59e0b','#8b5cf6','#3b82f6','#10b981','#ef4444'],
                borderWidth: 2,
                borderColor: '#ffffff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: { legend: { display: false } }
        }
    });
</script>

@endsection
