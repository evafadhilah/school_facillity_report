<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">

  <!-- Toggle -->
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <!-- Search -->
  <div class="navbar-nav align-items-center flex-grow-1">
    <form method="GET" action="{{ route('siswa.laporan.index') }}" class="w-100">
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
          <a href="{{ route('siswa.laporan.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-x"></i>
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- User -->
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">

        <!-- Avatar -->
        <div style="position: relative; display: inline-block;">
          <img
            src="{{ asset('storage/laporan/images.jpeg') }}"
            alt="User Avatar"
            style="width:40px; height:40px; object-fit:cover; border-radius:50%;"
          />
          <!-- Online Dot -->
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
          <a class="dropdown-item" href="#">
            <div class="d-flex align-items-center">

              <!-- Avatar kecil -->
              <div class="me-3">
                <img
                  src="{{ asset('storage/laporan/images.jpeg') }}"
                  alt="User Avatar"
                  style="width:40px; height:40px; object-fit:cover; border-radius:50%;"
                />
              </div>

              <!-- Info -->
              <div>
                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
              </div>

            </div>
          </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">
              <i class="bx bx-power-off me-2"></i>
              Log Out
            </button>
          </form>
        </li>
      </ul>
    </li>
  </ul>

</nav>
