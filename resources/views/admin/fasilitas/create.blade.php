@extends('layouts.backend')

@section('title', 'Tambah Fasilitas')

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
        white-space: nowrap;
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

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        color: #ef4444;
        margin-top: 0.35rem;
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

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        .btn-back { width: 100%; justify-content: center; }
        .form-card .card-body { padding: 1.25rem; }
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
                <h4>Tambah Fasilitas</h4>
                <p>Form untuk menambahkan fasilitas baru</p>
            </div>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('admin.fasilitas.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label"><i class='bx bx-buildings me-1'></i> Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas"
                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                        value="{{ old('nama_fasilitas') }}"
                        placeholder="Contoh: Proyektor, AC, Kursi"
                        required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.fasilitas.index') }}" class="btn-cancel">
                        <i class='bx bx-x'></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class='bx bx-save'></i> Simpan Fasilitas
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
