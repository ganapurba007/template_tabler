<?php
$page_title = "Contoh Halaman Include";
$active_page = "blank";
include __DIR__ . '/../includes/header.php';
?>

<!-- ========================================================================== -->
<!-- BUKAAN KONTEN HALAMAN (Cukup isi bagian ini) -->
<!-- ========================================================================== -->

<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <span class="badge badge-soft-primary mb-2">STARTER TEMPLATE</span>
    <h2 class="h3 fw-bold heading-custom mb-1">Contoh Halaman Baru</h2>
    <p class="text-muted-custom mb-0">Halaman ini dibuat cukup dengan memanggil include header.php & footer.php.</p>
  </div>
  <div>
    <a href="#" class="btn btn-primary"><i class="ti ti-plus me-1"></i> Tambah Data</a>
  </div>
</div>

<div class="card card-hover">
  <div class="card-header">
    <h3 class="card-title"><i class="ti ti-box me-2 text-primary"></i> Konten Utama Halaman</h3>
  </div>
  <div class="card-body">
    <p class="mb-0">Halo! Anda dapat dengan mudah mengisi seluruh elemen form, tabel, atau kartu statistik di bagian ini tanpa perlu menuliskan ulang sidebar, navbar, atau script footernya.</p>
  </div>
</div>

<!-- ========================================================================== -->
<!-- PENUTUP KONTEN HALAMAN -->
<!-- ========================================================================== -->

<?php include __DIR__ . '/../includes/footer.php'; ?>
