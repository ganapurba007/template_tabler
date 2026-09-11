<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#66A3BF">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="apple-touch-icon" href="{{ asset('tabler/static/logo-small.svg') }}">

        <title>{{ config('app.name', 'LMS Dani') }}</title>

        <!-- Google Fonts: Montserrat & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
                <header class="bg-white shadow-sm border-b" style="border-color: rgba(102, 163, 191, 0.2);">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Edusite Footer Bar -->
            <footer class="edusite-footer mt-5">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="row g-4 mb-4">
                        <div class="col-lg-5">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="rounded-circle text-white flex items-center justify-center p-2" style="background-color: #66A3BF; width: 36px; height: 36px;">
                                    <i class="ti ti-school text-xl"></i>
                                </div>
                                <span class="edusite-brand-title text-white">Edusite LMS</span>
                            </div>
                            <p class="small text-slate-400 pe-lg-4">
                                Platform E-Learning terpadu untuk mengakses materi interaktif, mengumpulkan tugas kelas, dan mengikuti kuis online dengan pengalaman belajar yang menyenangkan.
                            </p>
                        </div>
                        <div class="col-6 col-lg-3">
                            <h5>Navigasi Utama</h5>
                            <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                                <li><a href="{{ route('dashboard') }}"><i class="ti ti-chevron-right me-1"></i> Home / Dashboard</a></li>
                                <li><a href="{{ route('student.materials.index') }}"><i class="ti ti-chevron-right me-1"></i> Courses / Materi</a></li>
                                <li><a href="{{ route('student.assignments.index') }}"><i class="ti ti-chevron-right me-1"></i> Tugas Kelas</a></li>
                                <li><a href="{{ route('student.quizzes.index') }}"><i class="ti ti-chevron-right me-1"></i> Kuis Evaluasi</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-lg-4">
                            <h5>Dukungan & Bantuan</h5>
                            <p class="small text-slate-400 mb-2"><i class="ti ti-map-pin me-2 text-primary"></i> Kampus LMS Dani, Indonesia</p>
                            <p class="small text-slate-400 mb-2"><i class="ti ti-mail me-2 text-primary"></i> support@lmsdani.sch.id</p>
                            <p class="small text-slate-400 mb-0"><i class="ti ti-phone me-2 text-primary"></i> (021) 555-0199</p>
                        </div>
                    </div>
                    <div class="border-top border-slate-700 pt-3 text-center small text-slate-500">
                        &copy; {{ date('Y') }} LMS Dani (Edusite Theme). All rights reserved.
                    </div>
                </div>
            </footer>
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
