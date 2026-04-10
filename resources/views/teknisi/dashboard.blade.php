{{-- resources/views/teknisi/dashboard.blade.php --}}
@extends('layouts.backend')

@section('content')

<style>
    /* ── Penyesuaian Agar Konten Mengecil & Sejajar ── */
    .tkn-wrap {
        /* Tambahkan padding kiri-kanan agar konten masuk ke dalam
           dan lurus dengan bar pencarian di atas */
        padding: 1.5rem 8.75rem;
        width: 100%;
        box-sizing: border-box;
    }

    /* ── Welcome Banner ── */
    .tkn-banner {
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 1.75rem 2rem;
        min-height: 90px;
        margin-bottom: 1.5rem;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 32px rgba(102,126,234,0.25);
    }
    .tkn-banner::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
    }
    .tkn-banner::after {
        content: '';
        position: absolute;
        bottom: -50px; left: 30%;
        width: 140px; height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
    }
    .tkn-banner-left { position: relative; z-index: 1; }
    .tkn-banner-left h4 { font-size: 1.35rem; font-weight: 700; margin: 0 0 0.3rem; }
    .tkn-banner-left p  { font-size: 0.85rem; color: rgba(255,255,255,0.75); margin: 0; }

    /* ── Stat Cards ── */
    .tkn-stat {
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        position: relative;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        transition: transform 0.25s, box-shadow 0.25s;
    }
    .tkn-stat:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,0.12); }
    .tkn-stat::after {
        content: '';
        position: absolute;
        bottom: -20px; right: -20px;
        width: 90px; height: 90px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
    }
    .tkn-stat-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        color: white;
        margin-bottom: 0.85rem;
    }
    .tkn-stat-val  { font-size: 2rem; font-weight: 700; color: white; line-height: 1; }
    .tkn-stat-lbl  { font-size: 0.82rem; color: rgba(255,255,255,0.8); margin-top: 0.2rem; font-weight: 500; }
    .tkn-stat-sub  { font-size: 0.72rem; color: rgba(255,255,255,0.55); margin-top: 0.4rem; }
    .ts-indigo  { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .ts-red     { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .ts-blue    { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .ts-green   { background: linear-gradient(135deg, #10b981, #059669); }

    /* ── Cards generic ── */
    .tkn-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        background: white;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .tkn-card-head {
        padding: 0.9rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
        background: #fafbfc;
    }
    .tkn-card-head h6 {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .tkn-card-head a {
        font-size: 0.76rem;
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
    }
    .tkn-card-head a:hover { text-decoration: underline; }
    .tkn-card-head span {
        font-size: 0.75rem;
        color: #94a3b8;
    }
    .tkn-card-body {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* ── Priority List ── */
    .priority-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f8fafc;
    }
    .priority-item:last-child { border-bottom: none; }
    .pi-urgbar {
        width: 4px;
        border-radius: 4px;
        align-self: stretch;
        flex-shrink: 0;
        min-height: 40px;
    }
    .pi-urgbar.tinggi { background: #ef4444; }
    .pi-urgbar.sedang { background: #f59e0b; }
    .pi-urgbar.rendah { background: #10b981; }
    .pi-body { flex: 1; min-width: 0; }
    .pi-title {
        font-size: 0.84rem;
        font-weight: 600;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pi-sub {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 1px;
    }
    .pi-badge {
        padding: 0.22rem 0.55rem;
        border-radius: 6px;
        font-size: 0.68rem;
        font-weight: 700;
        flex-shrink: 0;
        white-space: nowrap;
    }
    .pi-badge.tinggi { background: #fee2e2; color: #b91c1c; }
    .pi-badge.sedang { background: #fef3c7; color: #92400e; }
    .pi-badge.rendah { background: #d1fae5; color: #065f46; }
    .pi-status {
        font-size: 0.68rem;
        font-weight: 600;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        flex-shrink: 0;
    }
    .pi-status.ditugaskan { background: #ede9fe; color: #5b21b6; }
    .pi-status.diproses   { background: #dbeafe; color: #1e40af; }

    /* ── Donut Stat ── */
    .donut-stat-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.45rem 0;
        border-bottom: 1px solid #f8fafc;
        font-size: 0.82rem;
    }
    .donut-stat-row:last-child { border-bottom: none; }
    .dsr-left { display: flex; align-items: center; gap: 8px; color: #475569; }
    .dsr-dot { width: 9px; height: 9px; border-radius: 2px; flex-shrink: 0; }
    .dsr-right { font-weight: 700; color: #1e293b; font-size: 0.85rem; }
    .dsr-pct { font-size: 0.7rem; color: #94a3b8; margin-left: 4px; font-weight: 400; }

    /* ── Bar Chart ── */
    .bar-chart-wrap {
        flex: 1;
        min-height: 160px;
        position: relative;
        width: 100%;
    }

    /* ── Row stretch ── */
    .row-stretch { align-items: stretch; }
    .row-stretch > [class*="col"] { display: flex; flex-direction: column; }
    .row-stretch > [class*="col"] > * { flex: 1; }

    /* ── Empty state ── */
    .tkn-empty {
        padding: 2rem 1rem;
        text-align: center;
        color: #94a3b8;
        font-size: 0.83rem;
    }
    .tkn-empty i { font-size: 2rem; display: block; margin-bottom: 0.4rem; color: #cbd5e1; }

    /* ── Responsive ── */
    @media (max-width: 640px) {
        .tkn-banner { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="tkn-wrap">

    {{-- ── Welcome Banner ── --}}
    <div class="tkn-banner">
        <div class="tkn-banner-left">
            <h4>Halo, {{ auth()->user()?->name ?? 'Teknisi' }}!</h4>
            <p>Berikut ringkasan tugas perbaikan fasilitas kamu hari ini.</p>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="row g-3 mb-4 row-stretch">
        <div class="col-6 col-md-3">
            <div class="tkn-stat ts-indigo">
                <div class="tkn-stat-icon"><i class='bx bx-task'></i></div>
                <div class="tkn-stat-val">{{ $totalDitugaskan }}</div>
                <div class="tkn-stat-lbl">Total Ditugaskan</div>
                <div class="tkn-stat-sub">Aktif ditangani</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="tkn-stat ts-red">
                <div class="tkn-stat-icon"><i class='bx bx-error'></i></div>
                <div class="tkn-stat-val">{{ $totalUrgent }}</div>
                <div class="tkn-stat-lbl">Urgent / Prioritas Tinggi</div>
                <div class="tkn-stat-sub">
                    @if($totalUrgent > 0)
                        ↑ Harus segera ditangani
                    @else
                        Tidak ada urgent
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="tkn-stat ts-blue">
                <div class="tkn-stat-icon"><i class='bx bx-wrench'></i></div>
                <div class="tkn-stat-val">{{ $totalDiproses }}</div>
                <div class="tkn-stat-lbl">Sedang Dikerjakan</div>
                <div class="tkn-stat-sub">Status diproses</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="tkn-stat ts-green">
                <div class="tkn-stat-icon"><i class='bx bx-check-circle'></i></div>
                <div class="tkn-stat-val">{{ $totalSelesaiBulan }}</div>
                <div class="tkn-stat-lbl">Selesai Bulan Ini</div>
                <div class="tkn-stat-sub">{{ now()->translatedFormat('F Y') }}</div>
            </div>
        </div>
    </div>

    {{-- ── Main Content Row ── --}}
    <div class="row g-3 mb-4 row-stretch">
        <div class="col-12 col-xl-5">
            <div class="tkn-card">
                <div class="tkn-card-head">
                    <h6><i class='bx bx-error-circle' style="color:#ef4444"></i> Laporan Prioritas</h6>
                    <a href="{{ route('teknisi.laporan.index') }}">Lihat Semua →</a>
                </div>
                <div class="tkn-card-body" style="padding-top:0.5rem; padding-bottom:0.5rem;">
                    @forelse($laporanPrioritas as $lap)
                    <div class="priority-item">
                        <div class="pi-urgbar {{ strtolower($lap->tingkat_urgency ?? 'rendah') }}"></div>
                        <div class="pi-body">
                            <div class="pi-title">{{ $lap->fasilitas->nama_fasilitas ?? '-' }}</div>
                            <div class="pi-sub">
                                {{ $lap->lokasi->nama_lokasi ?? '-' }} &bull;
                                {{ $lap->created_at?->diffForHumans() }}
                            </div>
                        </div>
                        <span class="pi-badge {{ strtolower($lap->tingkat_urgency ?? 'rendah') }}">
                            {{ strtoupper($lap->tingkat_urgency ?? '-') }}
                        </span>
                        <span class="pi-status {{ strtolower($lap->status ?? '') }}">
                            {{ ucfirst($lap->status ?? '-') }}
                        </span>
                    </div>
                    @empty
                    <div class="tkn-empty">
                        <i class='bx bx-check-shield'></i>
                        Tidak ada laporan prioritas
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="tkn-card">
                <div class="tkn-card-head">
                    <h6><i class='bx bx-pie-chart-alt-2' style="color:#6366f1"></i> Statistik Perbaikan</h6>
                    <span>Semua waktu</span>
                </div>
                <div class="tkn-card-body">
                    <div style="position:relative; width:100%; height:170px; flex-shrink:0;">
                        <canvas id="donutChart"></canvas>
                    </div>
                    <div class="mt-3">
                        <div class="donut-stat-row">
                            <div class="dsr-left"><div class="dsr-dot" style="background:#10b981;"></div> Selesai</div>
                            <div class="dsr-right">{{ $statSelesai }} <span class="dsr-pct">({{ $statTotal > 0 ? round(($statSelesai / $statTotal) * 100) : 0 }}%)</span></div>
                        </div>
                        <div class="donut-stat-row">
                            <div class="dsr-left"><div class="dsr-dot" style="background:#3b82f6;"></div> Sedang Dikerjakan</div>
                            <div class="dsr-right">{{ $statDiproses }} <span class="dsr-pct">({{ $statTotal > 0 ? round(($statDiproses / $statTotal) * 100) : 0 }}%)</span></div>
                        </div>
                        <div class="donut-stat-row">
                            <div class="dsr-left"><div class="dsr-dot" style="background:#f59e0b;"></div> Belum Dikerjakan</div>
                            <div class="dsr-right">{{ $statDitugaskan }} <span class="dsr-pct">({{ $statTotal > 0 ? round(($statDitugaskan / $statTotal) * 100) : 0 }}%)</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-3">
            <div class="tkn-card">
                <div class="tkn-card-head">
                    <h6><i class='bx bx-trending-up' style="color:#10b981"></i> Performa</h6>
                    <span>{{ now()->year }}</span>
                </div>
                <div class="tkn-card-body">
                    <p style="font-size:0.75rem; color:#94a3b8; margin:0 0 0.5rem;">Laporan selesai per bulan</p>
                    <div class="bar-chart-wrap">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
    const statSelesai    = {{ $statSelesai }};
    const statDiproses   = {{ $statDiproses }};
    const statDitugaskan = {{ $statDitugaskan }};
    const chartSelesai   = @json($chartSelesai ?? array_fill(0, 12, 0));

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Dikerjakan', 'Belum'],
            datasets: [{
                data: [statSelesai, statDiproses, statDitugaskan],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ` ${ctx.label}: ${ctx.raw}` } }
            }
        }
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Selesai',
                data: chartSelesai,
                backgroundColor: 'rgba(99,102,241,0.8)',
                borderRadius: 5,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 }, color: '#94a3b8', maxRotation: 0 } },
                y: { grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 10 }, color: '#94a3b8', precision: 0 }, beginAtZero: true }
            }
        }
    });
</script>

@endsection
