@extends('layouts.backend')

@section('title', 'Edit Lokasi')

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
        color: #4b5563;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .form-control.is-invalid:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.15);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: white;
        color: #6b7280;
        border: 2px solid #e5e7eb;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        border-color: #d1d5db;
        color: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 2px solid #fca5a5;
        border-radius: 12px;
        color: #991b1b;
        padding: 1rem 1.5rem;
    }

    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .alert-danger .btn-close {
        filter: brightness(0.5);
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
            padding: 1.5rem;
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
                <h4>Edit Lokasi</h4>
                <p>Form perubahan data lokasi</p>
            </div>
            <a href="{{ route('admin.lokasi.index') }}" class="btn-back">
                <i class='bx bx-arrow-back'></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class='bx bx-error-circle me-2'></i>
            <strong>Terjadi Kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('admin.lokasi.update', $lokasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="nama_lokasi"
                        class="form-control @error('nama_lokasi') is-invalid @enderror"
                        value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}"
                        placeholder="Masukkan nama lokasi"
                        autofocus
                    >
                    @error('nama_lokasi')
                        <div class="invalid-feedback">
                            <i class='bx bx-error-circle me-1'></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.lokasi.index') }}" class="btn-cancel">
                        <i class='bx bx-x'></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class='bx bx-save'></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
