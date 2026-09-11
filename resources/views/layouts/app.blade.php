<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="theme-color" content="#66A3BF">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="apple-touch-icon" href="{{ asset('tabler/static/logo-small.svg') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tabler Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

        <!-- Custom Theme CSS -->
        <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen pb-16 lg:pb-0" style="background-color: var(--color-warm-light, #F2EFE7);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow-sm border-b" style="border-color: rgba(102, 163, 191, 0.2);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Mobile Bottom Nav Bar (Mobile-First PWA) -->
        <nav class="mobile-bottom-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="ti ti-smart-home fs-4"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('student.materials.index') }}" class="{{ request()->routeIs('student.materials.*') ? 'active' : '' }}">
                <i class="ti ti-book fs-4"></i>
                <span>Materi</span>
            </a>
            <a href="{{ route('student.assignments.index') }}" class="{{ request()->routeIs('student.assignments.*') ? 'active' : '' }}">
                <i class="ti ti-clipboard-list fs-4"></i>
                <span>Tugas</span>
            </a>
            <a href="{{ route('student.quizzes.index') }}" class="{{ request()->routeIs('student.quizzes.*') ? 'active' : '' }}">
                <i class="ti ti-help-hexagon fs-4"></i>
                <span>Kuis</span>
            </a>
        </nav>

        <!-- Service Worker Registration -->
        <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(reg) {
                    console.log('PWA ServiceWorker registered');
                });
            });
        }
        </script>
    </body>
</html>
