<?php include 'template/header.php'; ?>

<?php 

$users = getData("SELECT * FROM tb_pengguna ORDER BY role DESC");

?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="m-0">
                    Manajemen Pengguna
                </h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="pengguna-create.php" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Alamat Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $index => $user) { ?>
                        <tr>
                            <th><?= $index + 1 ?></th>
                            <td><?= $user['nama'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <?php if ($user['role'] !== "SUPERADMIN") { ?>
                                <a href="pengguna-edit.php?id=<?= $user['id'] ?>" class="btn btn-success me-2">Edit</a>
                                <button 
                                    type="button" 
                                    class="btn btn-danger" 
                                    onclick="deleteData('pengguna-index', 'tb_pengguna', <?= $user['id'] ?>)">
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