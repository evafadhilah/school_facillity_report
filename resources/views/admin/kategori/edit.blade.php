@extends('layouts.backend')

@section('title', 'Edit Kategori')

@section('content')

<style>
    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .breadcrumb-modern {
        background: transparent;
        padding: 0;
        margin-bottom: 2rem;
    }

    .breadcrumb-modern .breadcrumb {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin: 0;
    }

    .breadcrumb-modern .breadcrumb-item {
        font-size: 0.9rem;
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .breadcrumb-modern .breadcrumb-item a:hover {
        color: #764ba2;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: #6b7280;
    }

    /* Hero Section - Purple Theme */
    .edit-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
    }

    .edit-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .edit-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -3%;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .hero-title {
        color: white;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .hero-subtitle {
        color: white;
        font-size: 0.95rem;
        margin-bottom: 0;
        font-weight: 400;
        opacity: 1;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Alert Styles */
    .alert-modern {
        border: none;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .alert-modern::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: currentColor;
    }

    .alert-danger-modern {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        color: #dc2626;
        border-left: 5px solid #ef4444;
    }

    .alert-heading-modern {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .alert-heading-modern i {
        font-size: 1.5rem;
    }

    .alert-list {
        margin: 0;
        padding-left: 2.5rem;
    }

    .alert-list li {
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .alert-list li:last-child {
        margin-bottom: 0;
    }

    .btn-close-modern {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0,0,0,0.1);
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        opacity: 0.6;
    }

    .btn-close-modern:hover {
        opacity: 1;
        background: rgba(0,0,0,0.2);
        transform: rotate(90deg);
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .form-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem 2rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .form-card-header h5 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 0;
        color: #4338ca;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .form-card-header i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.4rem;
    }

    .form-card-body {
        padding: 2rem;
    }

    .form-group-modern {
        margin-bottom: 1.75rem;
    }

    .form-label-modern {
        font-weight: 700;
        color: #1f2937;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .required-badge {
        color: #ef4444;
        font-weight: 700;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.25rem;
        z-index: 1;
        transition: all 0.3s;
    }

    .form-control-modern {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #f9fafb;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-modern:focus + .input-icon {
        color: #667eea;
    }

    .form-control-modern.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .invalid-feedback-modern {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .invalid-feedback-modern i {
        font-size: 1rem;
    }

    .form-hint {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.625rem;
    }

    .form-hint i {
        color: #667eea;
        font-size: 1rem;
    }

    .form-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #e5e7eb 50%, transparent 100%);
        margin: 2rem 0;
        border: none;
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-modern {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #4b5563;
        border: 2px solid #e5e7eb;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        color: #1f2937;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Info Card */
    .info-card-edit {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 2px solid #93c5fd;
    }

    .info-card-edit h6 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e40af;
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1rem;
    }

    .info-card-edit h6 i {
        font-size: 1.25rem;
    }

    .info-card-edit p {
        color: #1e3a8a;
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-hero {
            padding: 1.5rem;
        }

        .hero-title {
            font-size: 1.5rem;
        }

        .hero-subtitle {
            font-size: 0.85rem;
        }

        .form-card-body {
            padding: 1.5rem;
        }

        .form-card-header {
            padding: 1.25rem 1.5rem;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .edit-hero {
            padding: 1.5rem;
        }

        .hero-title {
            font-size: 1.5rem;
        }

        .form-card-body {
            padding: 1.5rem;
        }

        .alert-modern {
            padding: 1.25rem;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="edit-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb-modern">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class='bx bx-home-alt me-1'></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.kategori.index') }}">Kategori</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Kategori</li>
                </ol>
            </nav>
        </div>

        <!-- Hero Section -->
        <div class="edit-hero">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class='bx bx-edit-alt'></i>
                    <span>Edit Data</span>
                </div>
                <h1 class="hero-title">Edit Kategori</h1>
                <p class="hero-subtitle">Kelola dan atur kategori produk dengan mudah</p>
            </div>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
        <div class="alert-modern alert-danger-modern">
            <div class="alert-heading-modern">
                <i class='bx bx-error-circle'></i>
                <span>Terjadi Kesalahan!</span>
            </div>
            <ul class="alert-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close-modern" onclick="this.parentElement.remove()">
                <i class='bx bx-x'></i>
            </button>
        </div>
        @endif

        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="form-card">
                    <div class="form-card-header">
                        <h5>
                            <i class='bx bx-edit'></i>
                            Form Edit Kategori
                        </h5>
                    </div>

                    <div class="form-card-body">
                        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    Nama Kategori
                                    <span class="required-badge">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input
                                        type="text"
                                        name="nama_kategori"
                                        class="form-control-modern @error('nama_kategori') is-invalid @enderror"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                        placeholder="Contoh: Elektronik, Fashion, Makanan & Minuman"
                                        required
                                        autocomplete="off"
                                    >
                                    <i class='bx bx-category input-icon'></i>
                                    @error('nama_kategori')
                                        <div class="invalid-feedback-modern">
                                            <i class='bx bx-error-circle'></i>
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-hint">
                                    <i class='bx bx-info-circle'></i>
                                    <span>Masukkan nama kategori yang jelas dan mudah dipahami</span>
                                </div>
                            </div>

                            <div class="info-card-edit">
                                <h6>
                                    <i class='bx bx-bulb'></i>
                                    Tips Penamaan Kategori
                                </h6>
                                <p>Gunakan nama yang spesifik dan mudah dikenali. Hindari penggunaan karakter khusus yang tidak perlu. Kategori yang baik membantu pelanggan menemukan produk dengan lebih mudah.</p>
                            </div>

                            <hr class="form-divider">

                            <div class="form-actions">
                                <a href="{{ route('admin.kategori.index') }}" class="btn-modern btn-cancel">
                                    <i class='bx bx-x'></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn-modern btn-submit">
                                    <i class='bx bx-save'></i>
                                    Update Kategori
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // Auto hide alert after 6 seconds
    setTimeout(function() {
        const alert = document.querySelector('.alert-modern');
        if (alert) {
            alert.style.transition = 'all 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        }
    }, 6000);

    // Form validation enhancement
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const input = this.querySelector('input[name="nama_kategori"]');
        const value = input.value.trim();

        if (value.length < 3) {
            e.preventDefault();
            alert('Nama kategori harus minimal 3 karakter!');
            input.focus();
            return false;
        }

        // Show loading state on submit button
        const submitBtn = this.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Menyimpan...';
    });

    // Input focus animation
    const inputs = document.querySelectorAll('.form-control-modern');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });

        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });

    // Character counter (optional)
    const namaInput = document.querySelector('input[name="nama_kategori"]');
    if (namaInput) {
        namaInput.addEventListener('input', function() {
            const length = this.value.length;
            const hint = this.parentElement.querySelector('.form-hint span');
            if (length > 0) {
                hint.textContent = `${length} karakter - `;
                hint.textContent += length < 3 ? 'Minimal 3 karakter' : 'Nama kategori yang baik!';
            }
        });
    }
</script>
@endpush

@endsection
