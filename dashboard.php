<?php include 'template/header.php'; ?>

<?php

$tanggal_hari_ini = date('Y-m-d');

$statistik = [
    'menu' => getData("SELECT COUNT(id) AS jumlah_menu FROM tb_menu", true)['jumlah_menu'],
    'pengguna' => getData("SELECT COUNT(id) AS jumlah_pengguna FROM tb_pengguna", true)['jumlah_pengguna'],
    'pengeluaran' => getData("SELECT SUM(nominal) AS pengeluaran_hari_ini FROM tb_pengeluaran WHERE tanggal = '$tanggal_hari_ini'", true)['pengeluaran_hari_ini'],
    'pemasukan' => getData("SELECT SUM(total) AS pemasukan_hari_ini FROM tb_pesanan WHERE tanggal = '$tanggal_hari_ini'", true)['pemasukan_hari_ini']
];

var_dump($statistik);

?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-center g-4">
            
            <div class="col-6 col-md-4 col-lg-2 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= rupiah($toko['saldo']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">Saldo Terkini</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= rupiah($statistik['pemasukan']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">Pemasukan Hari Ini</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= rupiah($statistik['pengeluaran']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">Pengeluaran Hari Ini</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $statistik['menu'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">Menu</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $statistik['pengguna'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary text-center">Pengguna</h6>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
  </section>


</main>

<?php include 'template/footer.php'; ?>