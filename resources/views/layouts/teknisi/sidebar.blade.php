<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">

    <!-- LOGO -->
    <a href="{{ route('teknisi.dashboard') }}" class="app-brand-link d-flex align-items-center justify-content-center w-100">
      <img src="{{ asset('storage/laporan/school_facility_report_logo (1).png') }}"
           alt="Logo"
           style="height: 70px; width: auto;">
    </a>

    <!-- TOGGLE MENU -->
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>

  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}">
      <a href="{{ route('teknisi.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Operasional -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Operasional</span>
    </li>

    <!-- Laporan -->
    <li class="menu-item {{ request()->routeIs('teknisi.laporan.*') ? 'active' : '' }}">
      <a href="{{ route('teknisi.laporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div>Laporan</div>
      </a>
    </li>

  </ul>
</aside>    
