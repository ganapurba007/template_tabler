<?php
$title = isset($page_title) ? $page_title : 'Admin Dashboard — LMS Template';
$path_prefix = isset($asset_prefix) ? $asset_prefix : '../';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  
  <!-- DataTables Bootstrap 5 CSS CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

  <!-- Tabler Icons Webfont CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

  <!-- Custom Template CSS -->
  <link rel="stylesheet" href="<?= $path_prefix ?>assets/css/custom.css">
</head>
<body>

  <div class="app-wrapper">

    <!-- Sidebar Partial -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <!-- Main Content Section -->
    <div class="app-main">

      <!-- Navbar Header Partial -->
      <?php include __DIR__ . '/navbar.php'; ?>

      <!-- Main Content Container -->
      <main class="app-content">
