@extends('layouts.backend')

@section('title', 'Tambah Laporan')

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

    /* Form Card */
    .form-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .form-card .card-body {
        padding: 2rem;
    }

    /* Form Label */
    .form-label {
        font-weight: 600;
        color: #4338ca;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.5rem;
    }

    /* Form Control */
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

    /* File Input */
    input[type="file"].form-control {
        padding: 0.6rem 1rem;
        cursor: pointer;
    }

    input[type="file"].form-control::-webkit-file-upload-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        margin-right: 0.75rem;
        transition: opacity 0.2s;
    }

    input[type="file"].form-control::-webkit-file-upload-button:hover {
        opacity: 0.85;
    }

    /* Divider antar section */
    .form-divider {
        border: none;
        border-top: 2px dashed #e5e7eb;
        margin: 1.75rem 0;
    }

    /* Tombol Submit & Cancel */
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

    /* Alert */
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

    /* Grid 2 kolom untuk field yang lebih pendek */
    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
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

        .form-card .card-body {
            padding: 1.25rem;
        }

        .form-row-2 {
            grid-template-columns: 1fr;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }

        .d-flex.justify-content-end {
            flex-direction: column-reverse;
        }
    }

    @media (max-width: 576px) {
        .index-header {
            padding: 1.5rem;
        }

        .header-title h4 {
            font-size: 1.5rem;
        }

        .header-title p {
            font-size: 0.85rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Header -->
    <div class="index-header">
        <div class="header-content">
            <div class="header-title">
                <h4>Buat Laporan Fasilitas</h4>
                <p>Laporkan kerusakan fasilitas sekolah</p>
            </div>
            <a href="{{ route('siswa.laporan.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    {{-- Error Alert --}}
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

    <!-- Card Form -->
    <div class="card form-card">
        <div class="card-body">

            <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Row 1: Nama Pelapor + Kelas --}}
                <div class="form-row-2">
                    {{-- Nama Pelapor --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-user me-1'></i> Nama Pelapor
                        </label>
                        <input
                            type="text"
                            name="nama_pelapor"
                            class="form-control @error('nama_pelapor') is-invalid @enderror"
                            placeholder="Masukkan nama kamu"
                            value="{{ old('nama_pelapor') }}"
                            required
                        >
                    </div>

                    {{-- Kelas --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-book me-1'></i> Kelas
                        </label>
                        <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>{{-- /.form-row-2 (Row 1) --}}

                <hr class="form-divider">

                {{-- Row 2: Kategori + Fasilitas --}}
                <div class="form-row-2">
                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-category me-1'></i> Kategori
                        </label>
                        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-buildings me-1'></i> Fasilitas
                        </label>
                        <select name="fasilitas_id" class="form-control @error('fasilitas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->id }}" {{ old('fasilitas_id') == $f->id ? 'selected' : '' }}>
                                    {{ $f->nama_fasilitas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>{{-- /.form-row-2 (Row 2) --}}

                {{-- Row 3: Lokasi + Upload Foto --}}
                <div class="form-row-2">
                    {{-- Lokasi --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-map me-1'></i> Lokasi
                        </label>
                        <select name="lokasi_id" class="form-control @error('lokasi_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($lokasi as $l)
                                <option value="{{ $l->id }}" {{ old('lokasi_id') == $l->id ? 'selected' : '' }}>
                                    {{ $l->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Upload Foto --}}
                    <div class="mb-4">
                        <label class="form-label">
                            <i class='bx bx-image me-1'></i> Cover Laporan
                        </label>

                        <div id="dropZone" style="border: 2px dashed #667eea; border-radius: 12px; padding: 1.5rem 1rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.3s; position: relative;">
<input type="file" name="foto" id="coverInput" accept="image/*" style="position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%;">                            <div>
                                <i class='bx bx-cloud-upload' style="font-size: 2rem; color: #667eea; pointer-events:none;"></i>
                                <p style="margin: 0.4rem 0 0; font-size: 0.9rem; color: #667eea; font-weight: 600; pointer-events:none;">Klik atau drag foto ke sini</p>
                                <p style="margin: 0.2rem 0 0; font-size: 0.8rem; color: #9ca3af; pointer-events:none;">JPG, PNG · Satu foto sebagai cover laporan</p>
                            </div>
                        </div>

                        <div id="previewWrap" style="display:none; margin-top:10px; position:relative; display:none;">
                            <img id="previewImg" style="width:100%; max-height:200px; object-fit:cover; border-radius:10px; border:1.5px solid #e5e7eb;">
                            <button type="button" id="hapusCover" style="position:absolute;top:6px;right:6px;width:24px;height:24px;border-radius:50%;background:rgba(0,0,0,0.55);border:none;cursor:pointer;color:#fff;font-size:16px;line-height:1;display:flex;align-items:center;justify-content:center;">&times;</button>
                        </div>
                    </div>
                </div>{{-- /.form-row-2 (Row 3) --}}

                <hr class="form-divider">

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label class="form-label">
                        <i class='bx bx-note me-1'></i> Deskripsi Kerusakan
                    </label>
                    <textarea
                        name="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="4"
                        placeholder="Contoh: Kursi rusak, AC tidak dingin, dll"
                        required
                    >{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('siswa.laporan.index') }}" class="btn-cancel">
                        <i class='bx bx-x'></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class='bx bx-send'></i> Simpan Laporan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
const coverInput  = document.getElementById('coverInput');
const dropZone    = document.getElementById('dropZone');
const previewWrap = document.getElementById('previewWrap');
const previewImg  = document.getElementById('previewImg');
const hapusCover  = document.getElementById('hapusCover');

function showPreview(file) {
    if (!file) return;
    previewImg.src = URL.createObjectURL(file);
    previewWrap.style.display = 'block';
}

coverInput.addEventListener('change', e => {
    if (e.target.files[0]) showPreview(e.target.files[0]);
});

hapusCover.addEventListener('click', () => {
    coverInput.value = '';
    previewWrap.style.display = 'none';
    previewImg.src = '';
});

dropZone.addEventListener('dragover',  e => { e.preventDefault(); dropZone.style.background = '#ede9ff'; dropZone.style.borderColor = '#764ba2'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.background = '#fafafa'; dropZone.style.borderColor = '#667eea'; });
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.background = '#fafafa';
    dropZone.style.borderColor = '#667eea';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const dt = new DataTransfer();
        dt.items.add(file);
        coverInput.files = dt.files;
        showPreview(file);
    }
});
</script>

@endsection
