<?php include 'template/header.php'; ?>

<?php 

$pengeluaran = getData("SELECT *, tb_pengeluaran.id AS id_pengeluaran FROM tb_pengeluaran INNER JOIN tb_pengguna ON tb_pengeluaran.id_pengguna = tb_pengguna.id ORDER BY tb_pengeluaran.tanggal DESC");

?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="m-0">
                    Manajemen Pengeluaran
                </h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="pengeluaran-create.php" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="20%">Tanggal / Pengguna</th>
                            <th scope="col" width="40%">Keperluan</th>
                            <th scope="col" width="15%">Nominal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pengeluaran as $index => $item) { ?>
                        <tr>
                            <th><?= $index + 1 ?></th>
                            <td><?= tanggalIndo($item['tanggal']) ?> / <?= $item['nama'] ?></td>
                            <td><?= $item['keperluan'] ?></td>
                            <td><?= rupiah($item['nominal']) ?></td>
                            <td>
                                <?php if ($item['id_pengguna'] == $_SESSION['user']['id']) { ?>
                                <a href="pengeluaran-edit.php?id=<?= $item['id_pengeluaran'] ?>" class="btn btn-success me-2">Edit</a>
                                <button 
                                    type="button" 
                                    class="btn btn-danger" 
                                    onclick="deleteData('pengeluaran-index', 'tb_pengeluaran', <?= $item['id_pengeluaran'] ?>)">
                                    Hapus
                                </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </section>


</main>

<?php include 'template/footer.php'; ?>