<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#66A3BF">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="apple-touch-icon" href="{{ asset('tabler/static/logo-small.svg') }}">

        <title>{{ config('app.name', 'RuangTera') }}</title>

        <!-- Google Fonts: Montserrat & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tabler Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

        <!-- AOS (Animate On Scroll) -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Custom Theme CSS -->
        <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen pb-16 lg:pb-0" style="background-color: var(--color-warm-light, #F2EFE7);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if(isset($header) && trim($header) !== '')
                <header class="shadow-sm border-b" style="background-color: #F2EFE7; border-color: rgba(102, 163, 191, 0.2);">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Arsha Premium Modern Footer Bar -->
            <footer class="arsha-footer" style="background-color: #0b1727; color: #94a3b8; padding: 4rem 0 2rem 0; border-top: 4px solid #66A3BF;">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="row g-4 mb-5">
                        <!-- Col 1: Brand & Social Media -->
                        <div class="col-lg-5">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="rounded-circle text-white flex items-center justify-center p-2.5 shadow-sm" style="background: linear-gradient(135deg, #3368A0 0%, #66A3BF 100%); width: 42px; height: 42px;">
                                    <i class="ti ti-school text-xl"></i>
                                </div>
                                <span class="arsha-sitename text-white" style="font-size: 1.5rem; letter-spacing: 1px;">Ruang<span style="color: #66A3BF;">Tera</span></span>
                            </div>
                            <p class="small text-slate-400 pe-lg-4 mb-3">
                                Platform E-Learning SMA terpadu untuk mengakses modul materi interaktif, mengumpulkan tugas kelas, dan mengikuti kuis online dengan pengalaman belajar yang menyenangkan.
                            </p>

                            <!-- Tidy & Beautiful Social Media Badges -->
                            <div class="d-flex align-items-center gap-2.5 mt-3">
                                <a href="#" class="social-icon-btn instagram" title="Instagram">
                                    <i class="ti ti-brand-instagram"></i>
                                </a>
                                <a href="#" class="social-icon-btn youtube" title="YouTube">
                                    <i class="ti ti-brand-youtube"></i>
                                </a>
                                <a href="#" class="social-icon-btn discord" title="Discord">
                                    <i class="ti ti-brand-discord"></i>
                                </a>
                                <a href="#" class="social-icon-btn whatsapp" title="WhatsApp">
                                    <i class="ti ti-brand-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Col 2: Navigasi Utama -->
                        <div class="col-6 col-lg-3">
                            <h5 class="text-white font-bold mb-3" style="font-family: 'Jost', sans-serif;">Navigasi Utama</h5>
                            <ul class="list-unstyled small d-flex flex-column gap-2.5 mb-0">
                                <li><a href="{{ route('dashboard') }}" class="text-slate-400 text-decoration-none hover-text-white transition d-inline-flex align-items-center"><i class="ti ti-chevron-right me-1 text-primary"></i> Home / Dashboard</a></li>
                                <li><a href="{{ route('student.materials.index') }}" class="text-slate-400 text-decoration-none hover-text-white transition d-inline-flex align-items-center"><i class="ti ti-chevron-right me-1 text-primary"></i> Courses / Materi</a></li>
                                <li><a href="{{ route('student.assignments.index') }}" class="text-slate-400 text-decoration-none hover-text-white transition d-inline-flex align-items-center"><i class="ti ti-chevron-right me-1 text-primary"></i> Tugas Kelas</a></li>
                                <li><a href="{{ route('student.quizzes.index') }}" class="text-slate-400 text-decoration-none hover-text-white transition d-inline-flex align-items-center"><i class="ti ti-chevron-right me-1 text-primary"></i> Kuis Online</a></li>
                                <li><a href="{{ route('student.report.index') }}" class="text-slate-400 text-decoration-none hover-text-white transition d-inline-flex align-items-center"><i class="ti ti-chevron-right me-1 text-primary"></i> Laporan Diri</a></li>
                            </ul>
                        </div>


                        <!-- Col 4: Dukungan & Bantuan -->
                        <div class="col-lg-4">
                            <h5 class="text-white font-bold mb-3" style="font-family: 'Jost', sans-serif;">Bantuan & Kontak</h5>
                            <div class="d-flex flex-column gap-2 small text-slate-400 mb-3">
                                <div><i class="ti ti-map-pin me-2 text-primary fs-6"></i> Kampus RuangTera, Indonesia</div>
                                <div><i class="ti ti-mail me-2 text-primary fs-6"></i> support@ruangtera.sch.id</div>
                                <div><i class="ti ti-phone me-2 text-primary fs-6"></i> (021) 555-0199</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Copyright Bar & Scroll Top -->
                    <div class="border-top border-slate-800 pt-4 d-flex flex-wrap align-items-center justify-content-between text-center text-md-start small text-slate-500 gap-3">
                        <div>
                            &copy; {{ date('Y') }} <strong>RuangTera</strong>. All rights reserved.
                        </div>
                        <div class="d-flex align-items-center gap-3 mx-auto mx-md-0">
                            <a href="#" onclick="window.scrollTo({top:0, behavior:'smooth'}); return false;" class="btn btn-sm btn-outline-secondary rounded-pill text-white px-3 py-1 text-decoration-none">
                                <i class="ti ti-arrow-up me-1"></i> Kembali ke Atas
                            </a>
                        </div>
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

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 800,
                        once: true,
                        easing: 'ease-in-out'
                    });
                }
            });
        </script>

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
