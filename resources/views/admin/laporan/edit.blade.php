@extends('layouts.backend')

@section('title', 'Edit Laporan')

@section('content')

<style>
    *, *::before, *::after { box-sizing: border-box; }

    .ep-wrap {
        padding: 1.5rem 1.75rem;
        font-family: 'Segoe UI', sans-serif;
        max-width: 820px;
    }

    /* Alerts */
    .ep-alert {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 13px 16px; border-radius: 10px;
        font-size: 0.875rem; margin-bottom: 1.25rem;
    }
    .ep-alert-success { background:#d1fae5; color:#065f46; border:1px solid #a7f3d0; }
    .ep-alert-danger  { background:#fee2e2; color:#991b1b; border:1px solid #fecaca; }
    .ep-alert ul { margin: 4px 0 0 1rem; padding: 0; }

    /* Header */
    .ep-header {
        background: linear-gradient(135deg, #7c6ff7 0%, #6457e8 45%, #8b5cf6 100%);
        border-radius: 14px; padding: 1.5rem 1.75rem;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.25rem; position: relative; overflow: hidden;
    }
    .ep-header::before {
        content:''; position:absolute; right:-30px; top:-30px;
        width:150px; height:150px; border-radius:50%;
        background:rgba(255,255,255,0.08); pointer-events:none;
    }
    .ep-header-text h4 {
        margin:0 0 4px; font-size:1.25rem; font-weight:700; color:#fff;
    }
    .ep-header-text p { margin:0; font-size:0.83rem; color:rgba(255,255,255,0.80); }
    .ep-btn-back {
        display:inline-flex; align-items:center; gap:7px;
        background:rgba(255,255,255,0.18); color:#fff;
        border:1px solid rgba(255,255,255,0.30); border-radius:9px;
        padding:8px 18px; font-size:0.85rem; font-weight:600;
        text-decoration:none; white-space:nowrap; position:relative; z-index:1;
        transition:background 0.2s;
    }
    .ep-btn-back:hover { background:rgba(255,255,255,0.28); color:#fff; text-decoration:none; }

    /* Card */
    .ep-card {
        background:#fff; border-radius:14px;
        border:1px solid #e8e8f0; overflow:hidden;
        box-shadow:0 2px 12px rgba(100,87,232,0.06);
    }

    /* Section title */
    .ep-section-title {
        display:flex; align-items:center; gap:9px;
        padding:12px 20px; background:#f8f7ff;
        border-bottom:1px solid #ebebf5;
    }
    .ep-section-title i   { font-size:0.95rem; color:#6457e8; }
    .ep-section-title span {
        font-size:0.68rem; font-weight:700;
        text-transform:uppercase; letter-spacing:0.7px; color:#6457e8;
    }

    /* Info body */
    .ep-info-body { padding: 18px 20px; border-bottom:1px solid #ebebf5; }
    .ep-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 14px;
    }
    .ep-field-label {
        font-size:0.68rem; font-weight:700;
        text-transform:uppercase; letter-spacing:0.65px;
        color:#6457e8; margin-bottom:6px;
    }
    .ep-field-box {
        background:#f9f9fc; border:1px solid #e8e8f0;
        border-radius:8px; padding:9px 14px;
        font-size:0.875rem; color:#374151;
        min-height:38px; display:flex; align-items:center;
    }
    .ep-badge {
        display:inline-flex; align-items:center;
        padding:4px 14px; border-radius:20px;
        font-size:0.8rem; font-weight:600;
    }
    .ep-badge-rendah { background:#d1fae5; color:#065f46; }
    .ep-badge-sedang  { background:#fef3c7; color:#92400e; }
    .ep-badge-tinggi  { background:#fee2e2; color:#991b1b; }
    .ep-field-full { margin-top:14px; }

    /* Form body */
    .ep-form-body { padding: 18px 20px 22px; }
    .ep-form-grid {
        display:grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap:14px; margin-bottom:20px;
    }
    .ep-form-label {
        font-size:0.68rem; font-weight:700;
        text-transform:uppercase; letter-spacing:0.65px;
        color:#6457e8; margin-bottom:6px; display:block;
    }
    .ep-select {
        width:100%; padding:9px 14px;
        border:1px solid #e8e8f0; border-radius:8px;
        font-size:0.875rem; color:#374151; background:#fff;
        appearance:auto; cursor:pointer; font-family:inherit;
        transition:border-color 0.18s, box-shadow 0.18s;
    }
    .ep-select:focus {
        outline:none; border-color:#6457e8;
        box-shadow:0 0 0 3px rgba(100,87,232,0.12);
    }
    .ep-field-status { grid-column: 1 / -1; max-width: calc(50% - 7px); }

    /* Submit */
    .ep-btn-submit {
        display:inline-flex; align-items:center; gap:8px;
        background:linear-gradient(135deg,#7c6ff7 0%,#6457e8 100%);
        color:#fff; border:none; border-radius:9px;
        padding:10px 24px; font-size:0.88rem; font-weight:600;
        cursor:pointer; font-family:inherit;
        box-shadow:0 4px 14px rgba(100,87,232,0.30);
        transition:opacity 0.2s, transform 0.15s;
    }
    .ep-btn-submit:hover { opacity:0.9; transform:translateY(-1px); }
    .ep-btn-submit:active { transform:scale(0.98); }

    @media(max-width:540px) {
        .ep-info-grid, .ep-form-grid { grid-template-columns:1fr; }
        .ep-field-status { max-width:100%; }
        .ep-header { flex-direction:column; align-items:flex-start; gap:1rem; }
    }
</style>

<div class="ep-wrap container-xxl flex-grow-1 container-p-y">

    @if(session('success'))
    <div class="ep-alert ep-alert-success">
        <i class='bx bx-check-circle'></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="ep-alert ep-alert-danger">
        <i class='bx bx-error-circle'></i>
        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- Header --}}
    <div class="ep-header">
        <div class="ep-header-text">
            <h4>Edit Laporan</h4>
            <p>Perbarui data laporan kerusakan fasilitas sekolah</p>
        </div>
        <a href="{{ route('admin.laporan.index') }}" class="ep-btn-back">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>
    </div>

    <div class="ep-card">

        {{-- Informasi Laporan --}}
        <div class="ep-section-title">
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
                    <div style="display:flex; align-items:center; min-height:38px;">
                        @php $u = strtolower($laporan->tingkat_urgency ?? '') @endphp
                        @if($u)
                            <span class="ep-badge ep-badge-{{ $u }}">{{ ucfirst($laporan->tingkat_urgency) }}</span>
                        @else
                            <div class="ep-field-box">-</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="ep-field-full">
                <div class="ep-field-label">Deskripsi</div>
                <div class="ep-field-box" style="min-height:48px; align-items:flex-start; padding-top:10px; white-space:normal;">
                    {{ $laporan->deskripsi ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Update Data --}}
        <div class="ep-section-title" style="border-top:1px solid #ebebf5;">
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
