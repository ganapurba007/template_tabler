<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>500 Server Error — {{ config('app.name', 'Laravel') }}</title>

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
    <div class="error-card">
      <div class="error-title-code error-title-code-danger">500</div>
      <h1 class="h3 fw-bold heading-custom mb-2">Terjadi Kesalahan Server</h1>
      <p class="text-muted-custom mb-4">
        Sistem mengalami kendala internal. Tim kami sedang berusaha memperbaiki masalah ini. Silakan coba beberapa saat lagi.
      </p>
      <div class="d-flex align-items-center justify-content-center gap-2">
        <a href="{{ url('/') }}" class="btn btn-primary"><i class="ti ti-home me-1"></i> Kembali ke Beranda</a>
        <button type="button" class="btn btn-outline-secondary" onclick="window.location.reload()"><i class="ti ti-refresh me-1"></i> Muat Ulang</button>
      </div>
    </div>
  </div>

  <!-- Custom Scripts -->
  <script src="{{ asset('template/be/assets/js/theme-toggle.js') }}"></script>
</body>
</html>
