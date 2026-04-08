@extends('layouts.backend')

@section('title', 'Edit Laporan')

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
    .header-title p { margin: 0.5rem 0 0 0; font-size: 0.95rem; color: white; opacity: 0.9; }
    .btn-back {
        background: white; color: #667eea; border: none;
        padding: 0.75rem 1.5rem; border-radius: 12px; font-weight: 600;
        transition: all 0.3s ease; display: flex; align-items: center;
        gap: 0.5rem; text-decoration: none;
    }
    .btn-back:hover { transform: translateY(-2px); color: #764ba2; }
    .form-card { border: none; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
    .form-card .card-body { padding: 2rem; }
    .form-label { font-weight: 600; color: #4338ca; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 0.5rem; }
    .form-control { border: 2px solid #e5e7eb; border-radius: 12px; padding: 0.75rem 1rem; font-size: 0.95rem; color: #4b5563; transition: all 0.3s ease; background-color: #fafafa; }
    .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15); background-color: #fff; outline: none; }
    select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234338ca' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; padding-right: 2.5rem; }
    textarea.form-control { resize: vertical; min-height: 120px; }
    .form-divider { border: none; border-top: 2px dashed #e5e7eb; margin: 1.75rem 0; }
    .btn-submit { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.75rem 2rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); }
    .btn-submit:hover { transform: translateY(-2px); color: white; }
    .btn-cancel { background: #f3f4f6; color: #6b7280; border: none; padding: 0.75rem 2rem; border-radius: 12px; font-weight: 600; font-size: 0.95rem; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; }
    .btn-cancel:hover { background: #e5e7eb; color: #374151; transform: translateY(-2px); }
    .alert-danger { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: none; border-radius: 12px; color: #991b1b; padding: 1rem 1.5rem; }
    .info-box { background: #f8f7ff; border: 2px solid #e5e7eb; border-radius: 14px; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; }
    .info-box .info-row { display: flex; gap: 2rem; flex-wrap: wrap; }
    .info-box .info-item label { font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 2px; }
    .info-box .info-item span { font-size: 0.95rem; color: #374151; font-weight: 500; }
    .badge-urgency { display: inline-block; padding: 3px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; }
    .badge-tinggi { background: #fee2e2; color: #dc2626; }
    .badge-sedang { background: #fef3c7; color: #d97706; }
    .badge-rendah { background: #d1fae5; color: #059669; }
    @media (max-width: 768px) {
        .header-content { flex-direction: column; gap: 1rem; }
        .btn-back { width: 100%; justify-content: center; }
        .form-card .card-body { padding: 1.25rem; }
        .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4><i class='bx bx-edit me-2'></i>Edit Laporan</h4>
                <p>Perbarui status laporan kerusakan fasilitas sekolah</p>
            </div>
            <a href="{{ route('teknisi.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <i class='bx bx-error-circle me-2'></i>
            <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="info-box mb-4">
        <p style="font-weight:700; color:#4338ca; margin-bottom:0.75rem;"><i class='bx bx-info-circle me-1'></i> Informasi Laporan</p>
        <div class="info-row">
            <div class="info-item">
                <label>Pelapor</label>
                <span>{{ $laporan->user->name ?? '-' }}</span>
            </div>
            <div class="info-item">
                <label>Fasilitas</label>
                <span>{{ $laporan->fasilitas->nama ?? '-' }}</span>
            </div>
            <div class="info-item">
                <label>Lokasi</label>
                <span>{{ $laporan->lokasi->nama ?? '-' }}</span>
            </div>
            <div class="info-item">
                <label>Urgency</label>
                <span class="badge-urgency badge-{{ $laporan->tingkat_urgency }}">
                    {{ ucfirst($laporan->tingkat_urgency) }}
                </span>
            </div>
            <div class="info-item">
                <label>Deskripsi</label>
                <span>{{ $laporan->deskripsi }}</span>
            </div>
        </div>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('teknisi.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-timer me-1'></i> Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="ditugaskan" {{ $laporan->status == 'ditugaskan' ? 'selected' : '' }}>Ditugaskan</option>
                            <option value="diproses"   {{ $laporan->status == 'diproses'   ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai"    {{ $laporan->status == 'selesai'    ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-calendar-check me-1'></i> Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control"
                            value="{{ old('tanggal_selesai', optional($laporan->tanggal_selesai)->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class='bx bx-note me-1'></i> Catatan Teknisi</label>
                    <textarea name="catatan_teknisi" class="form-control @error('catatan_teknisi') is-invalid @enderror"
                        rows="3" placeholder="Tuliskan catatan penanganan...">{{ old('catatan_teknisi', $laporan->catatan) }}</textarea>
                        {{-- ↑ diambil dari $laporan->catatan (nama kolom di database) --}}
                </div>

                <hr class="form-divider">

                <div class="mb-4">
                    <label class="form-label"><i class='bx bx-image-add me-1'></i> Foto Sesudah Diperbaiki</label>
                    @if($laporan->foto_sesudah)
                        <div style="margin-bottom:0.75rem;">
                            <img src="{{ Storage::url($laporan->foto_sesudah) }}"
                                style="height:100px; border-radius:10px; object-fit:cover; border:2px solid #e5e7eb;">
                            <p style="font-size:0.8rem; color:#9ca3af; margin-top:4px;">Foto sesudah saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="foto_sesudah" accept="image/*" class="form-control">
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('teknisi.laporan.index') }}" class="btn-cancel">
                        <i class='bx bx-x'></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class='bx bx-save'></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
