@include('layouts.be.header')

<div class="app-wrapper">

  <!-- Sidebar Navigation -->
  @include('layouts.be.sidebar')

  <!-- Main Section -->
  <div class="app-main">

    <!-- Navbar Header -->
    @include('layouts.be.navbar')

    <!-- Main Content Container -->
    <main class="app-content">
      @yield('content')
    </main>

    <!-- Footer Bar -->
    @include('layouts.be.footer')
