<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">

    <!-- LOGO (tidak bisa diklik) -->
    <span class="app-brand-logo demo">
      <img src="{{ asset('storage/laporan/logo_siswa_sfr.svg') }}"
           alt="Logo"
           style="height: 110px; width: auto;">
    </span>

    <!-- TOGGLE MENU -->
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>

  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Operasional -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Operasional</span>
    </li>

    <!-- Laporan -->
    <li class="menu-item {{ request()->routeIs('siswa.laporan.index') || request()->routeIs('siswa.laporan.create') || request()->routeIs('siswa.laporan.edit') ? 'active' : '' }}">
        <a href="{{ route('siswa.laporan.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div>Laporan</div>
        </a>
    </li>

    <!-- Riwayat Laporan -->
    <li class="menu-item {{ request()->routeIs('siswa.laporan.riwayat') || (request()->routeIs('siswa.laporan.show') && request()->is('siswa/laporan/riwayat*') == false && \App\Models\Laporan::find(request()->route('laporan'))?->status == 'selesai') ? 'active' : '' }}">
        <a href="{{ route('siswa.laporan.riwayat') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-history"></i>
            <div>Riwayat Laporan</div>
        </a>
    </li>
  </ul>
</aside>
