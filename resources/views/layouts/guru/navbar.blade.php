<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">

  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <!-- Search -->
  <div class="navbar-nav align-items-center flex-grow-1">
    <div class="input-group" style="max-width: 400px;">
      <span class="input-group-text border-end-0 bg-transparent">
        <i class="bx bx-search"></i>
      </span>
      <input type="text" class="form-control border-start-0 ps-0" placeholder="Search..." />
    </div>
  </div>

  <!-- User -->
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">

      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
        <div style="position: relative; display: inline-block;">
          <img
            src="{{ asset('storage/laporan/images.jpeg') }}"
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

      <ul class="dropdown-menu dropdown-menu-end mt-2" style="min-width: 220px; z-index: 9999;">
        <li>
          <div class="dropdown-item pe-none">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <img
                  src="{{ asset('storage/laporan/images.jpeg') }}"
                  alt="User Avatar"
                  style="width:40px; height:40px; object-fit:cover; border-radius:50%;"
                />
              </div>
              <div>
                <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
              </div>
            </div>
          </div>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
              <i class="bx bx-power-off me-2"></i>
              Log Out
            </button>
          </form>
        </li>
      </ul>

    </li>
  </ul>

</nav>
