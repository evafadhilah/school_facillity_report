@extends('layouts.backend')

@section('title', 'Edit Laporan')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    *, *::before, *::after { box-sizing: border-box; }

    .ep-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ── ALERTS ── */
    .ep-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 16px;
        border-radius: 12px;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        font-weight: 500;
    }
    .ep-alert i { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }
    .ep-alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
    .ep-alert-danger  { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .ep-alert ul { margin: 4px 0 0 1rem; padding: 0; }
    .ep-alert li { margin-top: 3px; font-size: 0.84rem; }

    /* ── HEADER ── */
    .ep-header {
        background: linear-gradient(135deg, #7c6ff7 0%, #6457e8 50%, #8b5cf6 100%);
        border-radius: 16px;
        padding: 1.5rem 1.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.25rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 6px 28px rgba(100, 87, 232, 0.28);
    }
    .ep-header::before {
        content: '';
        position: absolute;
        right: -40px; top: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        pointer-events: none;
    }
    .ep-header::after {
        content: '';
        position: absolute;
        left: -25px; bottom: -40px;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        pointer-events: none;
    }
    .ep-header-text { position: relative; z-index: 1; }
    .ep-header-text h4 {
        margin: 0 0 4px;
        font-size: 1.3rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.2px;
    }
    .ep-header-text p {
        margin: 0;
        font-size: 0.84rem;
        color: rgba(255,255,255,0.78);
        font-weight: 500;
    }
    .ep-btn-back {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255,255,255,0.16);
        backdrop-filter: blur(8px);
        color: #fff;
        border: 1.5px solid rgba(255,255,255,0.28);
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.2s, transform 0.15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .ep-btn-back:hover {
        background: rgba(255,255,255,0.26);
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* ── CARD ── */
    .ep-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #ececf5;
        overflow: hidden;
        box-shadow: 0 3px 16px rgba(100, 87, 232, 0.07);
    }

    /* ── SECTION TITLE BAR ── */
    .ep-section-bar {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 20px;
        background: #f5f4ff;
        border-bottom: 1.5px solid #ececf5;
    }
    .ep-section-bar i    { font-size: 0.95rem; color: #6457e8; }
    .ep-section-bar span {
        font-size: 0.69rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #6457e8;
    }

    /* ── INFO BODY ── */
    .ep-info-body {
        padding: 20px;
        border-bottom: 1.5px solid #ececf5;
    }
    .ep-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
    .ep-field-label {
        font-size: 0.69rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.65px;
        color: #8b84d0;
        margin-bottom: 5px;
    }
    .ep-field-box {
        background: #f8f7ff;
        border: 1.5px solid #eceaf8;
        border-radius: 9px;
        padding: 9px 13px;
        font-size: 0.875rem;
        color: #374151;
        font-weight: 500;
        min-height: 40px;
        display: flex;
        align-items: center;
        line-height: 1.4;
    }
    .ep-field-full {
        grid-column: 1 / -1;
    }
    .ep-field-desc {
        align-items: flex-start;
        padding-top: 10px;
        min-height: 52px;
        white-space: normal;
        word-break: break-word;
    }

    /* ── BADGE ── */
    .ep-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 13px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
    }
    .ep-badge-rendah { background: #d1fae5; color: #065f46; }
    .ep-badge-sedang  { background: #fef3c7; color: #92400e; }
    .ep-badge-tinggi  { background: #fee2e2; color: #991b1b; }

    /* ── FORM BODY ── */
    .ep-form-body {
        padding: 20px 20px 24px;
    }
    .ep-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .ep-form-label {
        display: block;
        font-size: 0.69rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.65px;
        color: #8b84d0;
        margin-bottom: 5px;
    }
    .ep-select {
        width: 100%;
        padding: 9px 34px 9px 13px;
        border: 1.5px solid #e0deef;
        border-radius: 9px;
        font-size: 0.875rem;
        color: #374151;
        font-weight: 500;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13' height='13' fill='%236457e8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .ep-select:focus {
        outline: none;
        border-color: #6457e8;
        box-shadow: 0 0 0 3px rgba(100, 87, 232, 0.12);
    }
    .ep-field-status {
        grid-column: 1 / -1;
        max-width: calc(50% - 7px);
    }

    /* ── SUBMIT BTN ── */
    .ep-btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #7c6ff7 0%, #6457e8 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 26px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 4px 16px rgba(100, 87, 232, 0.32);
        transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .ep-btn-submit:hover {
        opacity: 0.92;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(100, 87, 232, 0.4);
    }
    .ep-btn-submit:active { transform: scale(0.98); }

    /* ── RESPONSIVE ── */
    @media (max-width: 560px) {
        .ep-header { flex-direction: column; align-items: flex-start; }
        .ep-btn-back { width: 100%; justify-content: center; }
        .ep-info-grid, .ep-form-grid { grid-template-columns: 1fr; }
        .ep-field-status { max-width: 100%; grid-column: auto; }
        .ep-btn-submit { width: 100%; justify-content: center; }
    }
</style>

<div class="ep-wrap container-xxl flex-grow-1 container-p-y">

    @if(session('success'))
    <div class="ep-alert ep-alert-success">
        <i class='bx bx-check-circle'></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="ep-alert ep-alert-danger">
        <i class='bx bx-error-circle'></i>
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- ── HEADER ── --}}
    <div class="ep-header">
        <div class="ep-header-text">
            <h4><i class='bx bx-edit-alt' style="margin-right:6px;vertical-align:-2px;font-size:1.15rem;"></i>Edit Laporan</h4>
            <p>Perbarui data laporan kerusakan fasilitas sekolah</p>
        </div>
        <a href="{{ route('admin.laporan.index') }}" class="ep-btn-back">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>
    </div>

    {{-- ── CARD ── --}}
    <div class="ep-card">

        {{-- SECTION: Informasi Laporan --}}
        <div class="ep-section-bar">
            <i class='bx bx-info-circle'></i>
            <span>Informasi Laporan</span>
        </div>

        <div class="ep-info-body">
            <div class="ep-info-grid">
                <div>
                    <div class="ep-field-label">Pelapor</div>
                    <div class="ep-field-box">{{ $laporan->user->name ?? '-' }}</div>
                </div>
                <div>
                    <div class="ep-field-label">Kelas</div>
                    <div class="ep-field-box">{{ $laporan->kelas->nama_kelas ?? '-' }}</div>
                </div>
                <div>
                    <div class="ep-field-label">Kategori</div>
                    <div class="ep-field-box">{{ $laporan->kategori->nama_kategori ?? '-' }}</div>
                </div>
                <div>
                    <div class="ep-field-label">Tanggal</div>
                    <div class="ep-field-box">{{ $laporan->created_at?->format('d-m-Y') ?? '-' }}</div>
                </div>
                <div>
                    <div class="ep-field-label">Lokasi</div>
                    <div class="ep-field-box">{{ $laporan->lokasi->nama_lokasi ?? '-' }}</div>
                </div>
                <div>
                    <div class="ep-field-label">Urgency</div>
                    <div class="ep-field-box" style="background:transparent;border-color:transparent;padding-left:0;">
                        @php $u = strtolower($laporan->tingkat_urgency ?? '') @endphp
                        @if($u)
                            <span class="ep-badge ep-badge-{{ $u }}">{{ ucfirst($laporan->tingkat_urgency) }}</span>
                        @else
                            <span style="color:#9ca3af;">-</span>
                        @endif
                    </div>
                </div>

                <div class="ep-field-full">
                    <div class="ep-field-label">Deskripsi</div>
                    <div class="ep-field-box ep-field-desc">{{ $laporan->deskripsi ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- SECTION: Update Data --}}
        <div class="ep-section-bar">
            <i class='bx bx-edit-alt'></i>
            <span>Update Data</span>
        </div>

        <div class="ep-form-body">
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="ep-form-grid">
                    <div>
                        <label class="ep-form-label">Fasilitas</label>
                        <select name="fasilitas_id" class="ep-select">
                            @foreach($fasilitas as $item)
                                <option value="{{ $item->id }}"
                                    {{ $laporan->fasilitas_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_fasilitas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="ep-form-label">Teknisi</label>
                        <select name="teknisi_id" class="ep-select">
                            <option value="">-- Tidak Ada --</option>
                            @foreach($teknisi as $t)
                                <option value="{{ $t->id }}"
                                    {{ $laporan->teknisi_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ep-field-status">
                        <label class="ep-form-label">Status</label>
                        <select name="status" class="ep-select">
                            @foreach(['pending','ditugaskan','diproses','selesai','ditolak'] as $s)
                                <option value="{{ $s }}"
                                    {{ $laporan->status == $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="ep-btn-submit">
                    <i class='bx bx-save'></i> Update Laporan
                </button>

            </form>
        </div>

    </div>
</div>

@endsection
