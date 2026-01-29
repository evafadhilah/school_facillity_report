<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
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
    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Components -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Master Data</span>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
      <a href="{{ route('admin.kategori.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div>Kategori</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
      <a href="{{ route('admin.fasilitas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-buildings"></i>
        <div>Fasilitas</div>
      </a>
    </li>

    <!-- Operasional -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Operasional</span>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
      <a href="{{ route('admin.laporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-file"></i>
        <div>Laporan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.riwayatlaporan.*') ? 'active' : '' }}">
      <a href="{{ route('admin.riwayatlaporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-history"></i>
        <div>Riwayat Laporan</div>
      </a>
    </li>

  </ul>
</aside>
