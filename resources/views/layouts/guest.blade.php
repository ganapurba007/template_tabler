<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <!-- Tabler Icons Webfont CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <!-- Custom Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/be/assets/css/custom.css') }}">
</head>
<body>

    <div class="error-page-wrapper">
        <div class="auth-card-container" style="max-width: 440px; width: 100%;">
            
            <!-- Brand Logo -->
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none">
                    <div class="sidebar-brand-icon">
                        <i class="ti ti-brand-tabler"></i>
                    </div>
                    <span class="fs-4 fw-bold heading-custom">{{ config('app.name', 'LMS Template') }}</span>
                </a>
            </div>

            <!-- Auth Card Slot Content -->
            {{ $slot }}

            <!-- Theme Toggle Switch -->
            <div class="text-center mt-3">
                <button type="button" class="theme-toggle-btn mx-auto" id="theme-toggle" aria-label="Toggle Theme">
                    <i class="ti ti-moon fs-5"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Custom Scripts -->
    <script src="{{ asset('template/be/assets/js/theme-toggle.js') }}"></script>
</body>
</html>
