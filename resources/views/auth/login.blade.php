<!DOCTYPE html>
<html
  lang="id"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Halaman Login SFR" />

    <title>Login - SFR</title>

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-auth.css') }}" />

    <!-- STYLE ELEGANT -->
    <style>
      body {
        background: #f5f6fa;
      }

      .card {
        border-radius: 18px;
        border: none;
        background: linear-gradient(135deg, #696cff, #8f94fb);
        padding: 2px;
      }

      .card-body {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
      }

      .btn-primary {
        border-radius: 10px;
        font-weight: 500;
        background: linear-gradient(135deg, #696cff, #8f94fb);
        border: none;
      }

      .btn-primary:hover {
        opacity: 0.9;
      }

      .form-control {
        border-radius: 10px;
      }

      .app-brand-text {
        letter-spacing: 1px;
      }
    </style>

    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">

              <!-- LOGO -->
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
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder fs-2 ms-2">SFR</span>
                </div>
              </div>

              <!-- JUDUL -->
              <h4 class="mb-2 text-center">Selamat Datang di SFR 👋</h4>
              <p class="mb-4 text-center">Silakan masuk ke akun Anda</p>

              <!-- ALERT -->
              @if (session('success'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
              @endif

              @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                  </div>
              @endif

              <!-- FORM -->
              <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- EMAIL -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Masukkan email Anda"
                    value="{{ old('email') }}"
                    required
                  />
                </div>

                <!-- PASSWORD -->
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Kata Sandi</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="Masukkan kata sandi"
                      required
                    />
                    <span class="input-group-text cursor-pointer">
                      <i class="bx bx-hide"></i>
                    </span>
                  </div>
                </div>

                <!-- REMEMBER -->
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                      Ingat saya
                    </label>
                  </div>
                </div>

                <!-- BUTTON -->
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">
                    Masuk
                  </button>
                </div>
              </form>

              <!-- REGISTER -->
              <p class="text-center">
                <span>Belum punya akun?</span>
                <a href="{{ route('register') }}">
                  <span>Daftar sekarang</span>
                </a>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>

    <!-- TOGGLE PASSWORD -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.querySelector(".input-group-text");
        const password = document.querySelector("#password");
        const icon = document.querySelector(".input-group-text i");

        toggle.addEventListener("click", function () {
          if (password.type === "password") {
            password.type = "text";
            icon.classList.replace("bx-hide", "bx-show");
          } else {
            password.type = "password";
            icon.classList.replace("bx-show", "bx-hide");
          }
        });
      });
    </script>

  </body>
</html>
