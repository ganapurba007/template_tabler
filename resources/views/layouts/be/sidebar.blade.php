<!-- Sidebar Component Partial -->
<aside class="app-sidebar">
  <div class="sidebar-header">
    <a href="{{ url('/') }}" class="sidebar-brand">
      <div class="sidebar-brand-icon">
        <i class="ti ti-brand-tabler"></i>
      </div>
      <span>{{ config('app.name', 'LMS Template') }}</span>
    </a>
    <button type="button" class="navbar-toggle-btn d-lg-none sidebar-toggle-btn" aria-label="Close sidebar">
      <i class="ti ti-x"></i>
    </button>
  </div>

  <div class="sidebar-content">
    <div class="sidebar-section-label">Main</div>
    <ul class="sidebar-nav">
      <li class="sidebar-nav-item">
        <a href="{{ url('/') }}" class="sidebar-nav-link {{ request()->is('/') ? 'active' : '' }}">
          <i class="ti ti-layout-grid"></i>
          <span>Component Library</span>
        </a>
      </li>
      <li class="sidebar-nav-item">
        <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i class="ti ti-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
    </ul>

    <div class="sidebar-section-label">Management Pages</div>
    <ul class="sidebar-nav">
      <li class="sidebar-nav-item">
        <a href="{{ url('template/be/pages/table-example.html') }}" class="sidebar-nav-link">
          <i class="ti ti-table"></i>
          <span>Data Table</span>
        </a>
      </li>
      <li class="sidebar-nav-item">
        <a href="{{ url('template/be/pages/form-example.html') }}" class="sidebar-nav-link">
          <i class="ti ti-forms"></i>
          <span>Form Elements</span>
        </a>
      </li>
      <li class="sidebar-nav-item">
        <a href="{{ url('template/be/pages/profile.html') }}" class="sidebar-nav-link">
          <i class="ti ti-user"></i>
          <span>Profile Settings</span>
        </a>
      </li>
      <li class="sidebar-nav-item">
        <a href="{{ url('template/be/pages/blank.html') }}" class="sidebar-nav-link">
          <i class="ti ti-file-text"></i>
          <span>Blank Page</span>
        </a>
      </li>
    </ul>

    <div class="sidebar-section-label">Authentication</div>
    <ul class="sidebar-nav">
      <li class="sidebar-nav-item">
        <a href="{{ route('login') }}" class="sidebar-nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
          <i class="ti ti-login"></i>
          <span>Sign In / Login</span>
        </a>
      </li>
      <li class="sidebar-nav-item">
        <a href="{{ route('register') }}" class="sidebar-nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
          <i class="ti ti-user-plus"></i>
          <span>Sign Up / Register</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="sidebar-footer">
    <div class="d-flex align-items-center gap-2">
      <div class="position-relative">
        <div class="avatar avatar-sm bg-primary text-white">
          {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'GP' }}
        </div>
        <span class="status-indicator status-indicator-online position-absolute bottom-0 end-0"></span>
      </div>
      <div class="overflow-hidden">
        <div class="fw-semibold text-truncate small heading-custom">
          {{ Auth::check() ? Auth::user()->name : 'Gana Purba' }}
        </div>
        <div class="text-muted-custom small text-truncate">
          {{ Auth::check() ? Auth::user()->email : 'Administrator' }}
        </div>
      </div>
    </div>
  </div>
</aside>
