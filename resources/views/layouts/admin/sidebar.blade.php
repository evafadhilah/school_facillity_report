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
 <div class="app-brand demo" style="display: flex; justify-content: center; width: 100%;">
    <span style="justify-content: center;">
        <img src="{{ asset('storage/laporan/school_facility_report_logo (1).png') }}"
            alt="Logo"
            style="height: 70px; width: auto;">
    </span>
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
