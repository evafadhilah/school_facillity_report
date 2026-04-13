<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">

    <span class="app-brand-logo demo">
      <img src="{{ asset('storage/laporan/avatar_guru_fixed.svg') }}"
           alt="Logo"
           style="height: 70px; width: auto;">
    </span>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>

  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Operasional</span>
    </li>

    <!-- Laporan -->
    <li class="menu-item {{ request()->routeIs('guru.laporan.index') || request()->routeIs('guru.laporan.create') ? 'active' : '' }}">
        <a href="{{ route('guru.laporan.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div>Laporan Saya</div>
        </a>
    </li>

  </ul>
</aside>
