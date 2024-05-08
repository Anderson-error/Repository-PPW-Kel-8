<?php

require 'controller/function.php';

$toko = getDataToko();

if (isset($_POST['form_delete_id'])) {
  $table_name = $_POST['form_delete_table_name'];
  $id = $_POST['form_delete_id'];
  $file_index = $_POST['form_delete_file_index'] . ".php";

  if ($table_name === "tb_pengeluaran") {
    $item_pengeluaran = getData("SELECT * FROM tb_pengeluaran WHERE id = $id", true);
  
    updateSaldo(true, $item_pengeluaran['nominal']);
  } else if ($table_name === "tb_pesanan") {
    $item_pesanan = getData("SELECT * FROM tb_pesanan WHERE id = $id", true);
  
    updateSaldo(false, $item_pesanan['total']);
  }

  $query = "DELETE FROM $table_name WHERE id = $id";

  $proses_hapus = setData($query);

  if ($proses_hapus == true) {
      echo "<script>alert('Hapus Data Berhasil.');</script>";
      echo "<script>window.location.href='$file_index'</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $toko['nama_toko'] ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center">
        <img src="assets/img/icon-umkm.JPG" alt="" class="rounded">
        <h1 class="fs-5 mb-0"><?= $toko['nama_toko'] ?></h1>
      </a>

      <nav id="navbar" class="navbar" style="margin-left:-120px;">
        <?php if (isset($_SESSION['is_login'])) { ?>
          <ul>
            <li><a href="dashboard.php" style="padding-left: 0;">Dashboard</a></li>
            <li><a href="menu-index.php">Menu</a></li>
            <li><a href="riwayat-transaksi.php">Riwayat Transaksi</a></li>

            <?php if ($_SESSION['user']['role'] === "STAFF") { ?>
            <li class="dropdown">
              <a href="#"><span>Transaksi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a class="text-black" href="kasir.php">Catat Pemasukan</a></li>
                <li><a class="text-black" href="pengeluaran-index.php">Catat Pengeluaran</a></li>
              </ul>
            </li>
            <?php } ?>

            <?php if ($_SESSION['user']['role'] !== "STAFF") { ?>
              <li><a href="pengguna-index.php">Pengguna</a></li>
            <?php } ?>
            <li><a href="akun.php">Akun</a></li>
          </ul>

        <?php } else { ?>
          <ul>
            <li><a href="index.php" style="padding-left: 0;">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="about.php">About</a></li>
          </ul>
        <?php } ?>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <?php if (isset($_SESSION['is_login'])) { ?>
          <a href="logout.php" class="mx-2 text-white" title="Logout"><span class="bi-box-arrow-right"></span></a>
        <?php } else { ?>
          <!-- <a href="" target="_blank" class="mx-2 color-white"><span class="bi-facebook"></span></a>
          <a href="" target="_blank" class="mx-2 color-white"><span class="bi-twitter"></span></a> -->
          <a href="https://www.instagram.com/tteokbeokki.smd?igsh=MWo3NmVjcm14ODFtMw==" target="_blank" class="mx-2 color-white"><span class="bi-instagram"></span></a>
        <?php } ?>


        <a href="#" class="mx-2 js-search-open d-none"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <form id="form-delete-data" action="" style="display: none;" method="POST">
    <input type="hidden" id="form-delete-id" name="form_delete_id" value="">
    <input type="hidden" id="form-delete-table-name" name="form_delete_table_name" value="">
    <input type="hidden" id="form-delete-file-index" name="form_delete_file_index" value="">
  </form>