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

    .index-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -3%;
        width: 150px;
        height: 150px;
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
        opacity: 1;
        font-size: 0.95rem;
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,255,255,0.4);
        color: #764ba2;
    }

    .form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #4338ca;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #4b5563;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        background-color: #fff;
        outline: none;
    }

    .form-control::placeholder {
        color: #c0c5d0;
    }

    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%234338ca' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .form-divider {
        border: none;
        border-top: 2px dashed #e5e7eb;
        margin: 1.75rem 0;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        color: white;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        color: #374151;
        transform: translateY(-2px);
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: none;
        border-radius: 12px;
        color: #991b1b;
        padding: 1rem 1.5rem;
        font-weight: 500;
    }

    .alert-danger ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.25rem;
    }

    .alert-danger li {
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .existing-photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 8px;
        margin-top: 10px;
    }

    .existing-photo-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        border: 1.5px solid #e5e7eb;
    }

    .existing-photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .existing-photo-item .photo-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.5);
        padding: 3px 6px;
        font-size: 10px;
        color: #fff;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .photo-section-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .drop-zone {
        border: 2px dashed #667eea;
        border-radius: 12px;
        padding: 1.5rem 1rem;
        text-align: center;
        cursor: pointer;
        background: #fafafa;
        transition: all 0.3s;
        margin-top: 0.5rem;
    }

    .drop-zone:hover, .drop-zone.dragover {
        background: #ede9ff;
        border-color: #764ba2;
    }

    .drop-zone i {
        font-size: 2rem;
        color: #667eea;
    }

    .drop-zone p {
        margin: 0.4rem 0 0;
        font-size: 0.9rem;
        color: #667eea;
        font-weight: 600;
    }

    .drop-zone small {
        font-size: 0.8rem;
        color: #9ca3af;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 8px;
        margin-top: 10px;
    }

    .preview-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        border: 1.5px solid #667eea;
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .preview-item .preview-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.5);
        padding: 3px 6px;
        font-size: 10px;
        color: #fff;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        z-index: 1;
    }

    .preview-item .btn-remove {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(239, 68, 68, 0.9);
        border: none;
        cursor: pointer;
        color: #fff;
        font-size: 16px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .preview-item .btn-remove:hover {
        background: rgba(220, 38, 38, 1);
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .btn-back { width: 100%; justify-content: center; }
        .form-card .card-body { padding: 1.25rem; }
        .form-row-2 { grid-template-columns: 1fr; }
        .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
        .d-flex.justify-content-end { flex-direction: column-reverse; }
    }

    @media (max-width: 576px) {
        .index-header { padding: 1.5rem; }
        .header-title h4 { font-size: 1.5rem; }
        .header-title p { font-size: 0.85rem; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Edit Laporan Fasilitas</h4>
                <p>Perbarui data laporan kerusakan fasilitas sekolah</p>
            </div>
            <a href="{{ route('siswa.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <i class='bx bx-error-circle me-2'></i>
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card form-card">
        <div class="card-body">

            <form action="{{ route('siswa.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data" id="formLaporan">
                @csrf
                @method('PUT')

                <div class="form-row-2">
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-user me-1'></i> Nama Pelapor</label>
                        <input type="text" name="nama_pelapor"
                            class="form-control @error('nama_pelapor') is-invalid @enderror"
                            placeholder="Masukkan nama kamu"
                            value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-book me-1'></i> Kelas</label>
                        <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $laporan->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="form-row-2">
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-category me-1'></i> Kategori</label>
                        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id', $laporan->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-buildings me-1'></i> Fasilitas</label>
                        <select name="fasilitas_id" class="form-control @error('fasilitas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->id }}" {{ old('fasilitas_id', $laporan->fasilitas_id) == $f->id ? 'selected' : '' }}>
                                    {{ $f->nama_fasilitas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="form-row-2">
                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-map me-1'></i> Lokasi</label>
                        <select name="lokasi_id" class="form-control @error('lokasi_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($lokasi as $l)
                                <option value="{{ $l->id }}" {{ old('lokasi_id', $laporan->lokasi_id) == $l->id ? 'selected' : '' }}>
                                    {{ $l->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><i class='bx bx-camera me-1'></i> Foto Laporan</label>

                        @php
                            $fotoLama = [];
                            if ($laporan->foto) {
                                $decoded = json_decode($laporan->foto, true);
                                $fotoLama = is_array($decoded) ? $decoded : [$laporan->foto];
                            }
                        @endphp

                        @if(count($fotoLama) > 0)
                            <p class="photo-section-label">Foto saat ini</p>
                            <div class="existing-photos-grid">
                                @foreach ($fotoLama as $fotoPath)
                                    <div class="existing-photo-item">
                                        <img src="{{ asset('storage/' . $fotoPath) }}" alt="Foto laporan">
                                        <span class="photo-name">{{ basename($fotoPath) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="form-divider" style="margin: 1rem 0;">
                        @endif

                        <p class="photo-section-label">Tambah foto baru (akan menggantikan semua foto lama)</p>

                        {{-- Input file hidden, di-trigger oleh dropzone --}}
                        <input type="file" name="foto[]" id="fotoInput" accept="image/jpeg,image/png" multiple style="display:none;">

                        <div class="drop-zone" id="dropZone">
                            <i class='bx bx-cloud-upload'></i>
                            <p>Klik atau drag foto ke sini</p>
                            <small>JPG, PNG · Bisa pilih beberapa foto sekaligus</small>
                        </div>

                        <div class="preview-grid" id="previewGrid" style="display:none;"></div>
                        <p id="fotoCounter" style="font-size:0.8rem; color:#9ca3af; margin-top:6px; display:none;"></p>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="mb-4">
                    <label class="form-label"><i class='bx bx-note me-1'></i> Deskripsi Kerusakan</label>
                    <textarea name="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="4" placeholder="Contoh: Kursi rusak, AC tidak dingin, dll" required
                    >{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('siswa.laporan.index') }}" class="btn-cancel">
                        <i class='bx bx-x'></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class='bx bx-save'></i> Perbarui Laporan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    const dropZone   = document.getElementById('dropZone');
    const fotoInput  = document.getElementById('fotoInput');
    const previewGrid = document.getElementById('previewGrid');
    const fotoCounter = document.getElementById('fotoCounter');

    // Klik dropzone → buka file picker
    dropZone.addEventListener('click', () => fotoInput.click());

    // Drag over styling
    dropZone.addEventListener('dragover', e => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

    // Drop file
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    // Pilih file via picker
    fotoInput.addEventListener('change', e => {
        handleFiles(e.target.files);
    });

    function handleFiles(newFiles) {
        // Langsung render preview dari files yang dipilih
        // (tidak hapus yang lama, bisa pilih berkali-kali = akumulasi)
        renderPreview(newFiles);
    }

    function renderPreview(fileList) {
        previewGrid.innerHTML = '';
        if (!fileList || fileList.length === 0) {
            previewGrid.style.display = 'none';
            fotoCounter.style.display = 'none';
            return;
        }

        previewGrid.style.display = 'grid';
        fotoCounter.style.display = 'block';
        fotoCounter.textContent = fileList.length + ' foto dipilih';

        Array.from(fileList).forEach(f => {
            const url  = URL.createObjectURL(f);
            const wrap = document.createElement('div');
            wrap.className = 'preview-item';
            wrap.innerHTML = `
                <img src="${url}" alt="${f.name}">
                <span class="preview-name">${f.name}</span>
            `;
            previewGrid.appendChild(wrap);
        });
    }
</script>

@endsection
