<!-- Navbar Header -->
<header class="app-navbar">
  <div class="d-flex align-items-center gap-3">
    <button type="button" class="navbar-toggle-btn d-lg-none sidebar-toggle-btn" aria-label="Toggle Sidebar">
      <i class="ti ti-menu-2"></i>
    </button>
    <h1 class="h4 mb-0 fw-bold heading-custom">@yield('header_title', 'Admin Dashboard')</h1>
  </div>

  <div class="d-flex align-items-center gap-3">
    <!-- Theme Toggle Button -->
    <button type="button" class="theme-toggle-btn" id="theme-toggle" aria-label="Toggle Theme">
      <i class="ti ti-moon fs-4"></i>
    </button>

    <!-- User Dropdown -->
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="avatar avatar-sm bg-primary text-white">
          {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 2)) }}
        </div>
        <span class="d-none d-md-inline fw-medium heading-custom">{{ Auth::user()->name ?? 'User' }}</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
        <li>
          <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="ti ti-user me-2"></i> Profile
          </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item text-danger w-100 text-start border-0 bg-transparent">
              <i class="ti ti-logout me-2"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</header>
