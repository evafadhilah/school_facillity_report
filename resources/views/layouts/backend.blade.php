<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/admin/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/admin/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/admin/js/config.js') }}"></script>

    <style>
        .menu-item.active > .menu-link {
    background-color: #7367F0; /* warna background saat aktif */
    color: #fff; /* warna teks */
}
.menu-item.active > .menu-link i {
    color: #fff; /* warna icon */
}

    </style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Sidebar -->
       <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    @if(Auth::user()->role == 'admin')
        @include('layouts.admin.sidebar')
    @elseif(Auth::user()->role == 'siswa')
        @include('layouts.siswa.sidebar')
    @endif
</aside>

        <!-- / Sidebar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.admin.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/admin/js/dashboards-analytics.js') }}"></script>

    <!-- GitHub Buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
