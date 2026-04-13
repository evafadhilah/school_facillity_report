<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">

  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav align-items-center flex-grow-1">
    <form method="GET" action="{{ route('teknisi.laporan.index') }}" class="w-100">
      <div class="input-group">
        <button class="btn btn-outline-secondary" type="submit">
          <i class="bx bx-search"></i>
        </button>
        <input
          type="text"
          name="search"
          class="form-control"
          placeholder="Search..."
          value="{{ request('search') }}"
        />
        @if(request('search'))
          <a href="{{ route('teknisi.laporan.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-x"></i>
          </a>
        @endif
      </div>
    </form>
  </div>

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">

        <div style="position: relative; display: inline-block;">
          <img
            src="{{ asset('storage/laporan/man_person_people_avatar_icon_230017.png') }}"
            alt="User Avatar"
            style="width:40px; height:40px; object-fit:cover; border-radius:50%;"
          />
          <span style="
            position:absolute;
            bottom:2px;
            right:2px;
            width:10px;
            height:10px;
            background:#28c76f;
            border:2px solid #fff;
            border-radius:50%;
          "></span>
        </div>

      </a>

      <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="javascript:void(0);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                <div class="avatar">
                    <img
                    src="{{ asset('storage/laporan/man_person_people_avatar_icon_230017.png') }}"
                    alt="User Avatar"
                    class="w-px-40 h-auto rounded-circle"
                    />
                </div>
                </div>
                <div class="flex-grow-1">
                <span class="fw-semibold d-block text-dark">Leo</span>
                <small class="text-muted">Teknisi</small>
                </div>
            </div>
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
            </button>
            </form>
        </li>
</ul>
    </li>
  </ul>

</nav>
