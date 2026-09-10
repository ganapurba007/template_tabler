@include('layouts.be.header')

<div class="app-wrapper">

  <!-- Sidebar Component -->
  @include('layouts.be.sidebar')

  <!-- Main Section -->
  <div class="app-main">

    <!-- Navbar Component -->
    @include('layouts.be.navbar')

    <!-- Main Content Container -->
    <main class="app-content">
      @yield('content')
    </main>

@include('layouts.be.footer')
