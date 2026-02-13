<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('siswa.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- SVG LOGO (tidak diubah) -->
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
      <a href="{{ route('siswa.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Operasional -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Operasional</span>
    </li>

    <li class="menu-item {{ request()->routeIs('siswa.laporan.*') ? 'active' : '' }}">
      <a href="{{ route('siswa.laporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div>Laporan</div>
      </a>
    </li>
{{--
    <li class="menu-item {{ request()->routeIs('siswa.riwayatlaporan.*') ? 'active' : '' }}">
      <a href="{{ route('siswa.riwayatlaporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-history"></i>
        <div>Riwayat Laporan</div>
      </a>
    </li> --}}

  </ul>
</aside>
