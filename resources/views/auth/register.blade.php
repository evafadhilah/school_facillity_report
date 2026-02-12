<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register - SFR</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-auth.css') }}" />

    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">

              <div class="app-brand justify-content-center">
                <div class="app-brand-link gap-2 d-flex align-items-center">
                  <span class="app-brand-logo demo d-flex align-items-center">
                    <svg width="64" height="64" viewBox="0 0 64 64">
                      <rect x="8" y="18" width="30" height="38" rx="3" fill="#696cff"/>
                      <rect x="14" y="24" width="6" height="6" fill="#ffffff"/>
                      <rect x="24" y="24" width="6" height="6" fill="#ffffff"/>
                      <rect x="14" y="34" width="6" height="6" fill="#ffffff"/>
                      <rect x="24" y="34" width="6" height="6" fill="#ffffff"/>
                      <rect x="42" y="22" width="14" height="28" rx="2" fill="#696cff" opacity="0.85"/>
                      <rect x="45" y="26" width="8" height="2" fill="#ffffff"/>
                      <rect x="45" y="32" width="8" height="2" fill="#ffffff"/>
                      <rect x="45" y="38" width="6" height="2" fill="#ffffff"/>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder fs-2 ms-2">SFR</span>
                </div>
              </div>

              <h4 class="mb-2">Daftar Akun Baru</h4>
              <p class="mb-4">Buat akun untuk mengakses sistem</p>

              {{-- ALERT ERROR --}}
              @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif

              <form id="formAuthentication" class="mb-3" action="{{ route('register.process') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      name="name"
                      placeholder="Masukkan nama lengkap"
                      value="{{ old('name') }}"
                      autofocus
                      required
                    />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name="email"
                      placeholder="Masukkan email"
                      value="{{ old('email') }}"
                      required
                    />
                </div>

                <!-- DROPDOWN ROLE (SISWA / GURU) -->
                <div class="mb-3">
                    <label for="role" class="form-label">Daftar Sebagai</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">-- Pilih --</option>
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="••••••••"
                        required
                      />
                      <span class="input-group-text cursor-pointer">
                        <i class="bx bx-hide"></i>
                      </span>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                      />
                      <span class="input-group-text cursor-pointer">
                        <i class="bx bx-hide"></i>
                      </span>
                    </div>
                </div>

                <!-- Terms -->
                <div class="mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                      <label class="form-check-label" for="terms-conditions">
                        Saya setuju dengan
                        <a href="javascript:void(0);">kebijakan & ketentuan</a>
                      </label>
                    </div>
                </div>

                <!-- Button -->
                <button class="btn btn-primary d-grid w-100" type="submit">
                    Daftar
                </button>
              </form>

              <p class="text-center">
                <span>Sudah memiliki akun?</span>
                <a href="{{ route('login') }}">
                  <span>Login di sini</span>
                </a>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- Script Toggle Password --}}
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const toggles = document.querySelectorAll(".form-password-toggle");

        toggles.forEach(function (wrapper) {
          const toggle = wrapper.querySelector(".input-group-text");
          const password = wrapper.querySelector("input");
          const icon = wrapper.querySelector("i");

          toggle.addEventListener("click", function () {
            if (password.type === "password") {
              password.type = "text";
              icon.classList.remove("bx-hide");
              icon.classList.add("bx-show");
            } else {
              password.type = "password";
              icon.classList.remove("bx-show");
              icon.classList.add("bx-hide");
            }
          });
        });
      });
    </script>

  </body>
</html>
