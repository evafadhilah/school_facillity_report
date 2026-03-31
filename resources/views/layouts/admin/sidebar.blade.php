<style>
/* Custom Active Menu Styling */
.menu-item.active .menu-link .menu-icon {
    color: #374151 !important; /* Warna abu gelap untuk icon */
}

.menu-item.active .menu-link div {
    color: #1f2937 !important; /* Warna hitam untuk text */
}

/* Opsional: Hover effect */
.menu-item:hover .menu-link .menu-icon {
    color: #1f2937 !important;
}
</style>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
       {{-- <span class="app-brand-logo demo">
            <img src="{{ asset('storage/laporan/school_facility_report_logo.svg') }}"
           alt="Logo"
           style="height: 120px; width: auto;">
        </span> --}}
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
        <br><br><div>Dashboard</div>
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

    <li class="menu-item {{ request()->routeIs('admin.lokasi.*') ? 'active' : '' }}">
      <a href="{{ route('admin.lokasi.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-map"></i>
        <div>Lokasi</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
      <a href="{{ route('admin.fasilitas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-buildings"></i>
        <div>Fasilitas</div>
      </a>
    </li>

     <li class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
      <a href="{{ route('admin.kelas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-buildings"></i>
        <div>Kelas</div>
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
