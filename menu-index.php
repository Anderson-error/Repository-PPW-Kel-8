<?php include 'template/header.php'; ?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="m-0">
                    Manajemen Menu
                </h3>
            </div>
            <?php if ($_SESSION['user']['role'] !== "STAFF") { ?>
            <div class="col-4 d-flex justify-content-end">
                <a href="menu-create.php" class="btn btn-primary">Tambah Data</a>
            </div>
            <?php } ?>
        </div>

        <div class="row">
            <div class="col-12">
                <nav class="<?= count(KATEGORI_MENU) == 1 ? 'd-none' : '' ?>">
                    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                        <?php foreach (KATEGORI_MENU as $index => $kategori) { ?>
                            <button 
                                class="nav-link <?= ($index == 0) ? 'active' : null ?>" 
                                id="nav-<?= $kategori ?>-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#nav-<?= $kategori ?>-tab-content" 
                                type="button" 
                                role="tab" 
                                aria-controls="nav-menu" 
                                aria-selected="true"><?= $kategori; ?></button>
                        <?php } ?>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <?php 
                    
                    foreach (KATEGORI_MENU as $index => $kategori) {

                    $menus = getData("SELECT * FROM tb_menu WHERE kategori = '$kategori' ORDER BY best_seller DESC");
                        
                    ?>
                    <div class="tab-pane fade <?= ($index == 0) ? 'show active' : null ?>" id="nav-<?= $kategori ?>-tab-content" role="tabpanel" aria-labelledby="nav-<?= $kategori ?>-tab" tabindex="0">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col" width="15%">Foto</th>
                                    <th scope="col" width="30%">Nama Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($menus as $index => $menu) { ?>
                                <tr>
                                    <th><?= $index + 1 ?></th>
                                    <td>
                                        <img 
                                            src="assets/upload/menu/<?= $menu['foto'] ?>" 
                                            class="rounded object-fit-cover" 
                                            alt="Foto Menu"
                                            width="100px"
                                            height="100px">
                                    </td>
                                    <td>
                                        <p class="m-0">
                                            <?= $menu['nama_menu'] ?>
                                            <hr>
                                            <?= truncateText($menu['deskripsi'], 100) ?>
                                        </p>
                                    </td>
                                    <td><?= rupiah($menu['harga']) ?></td>
                                    <td><?= $menu['stok'] ?></td>
                                    <td>
                                        <a href="menu-edit.php?id=<?= $menu['id'] ?>" class="btn btn-success me-2">Edit</a>
                                        <?php if ($_SESSION['user']['role'] !== "STAFF") { ?>
                                        <button type="button" class="btn btn-danger" onclick="deleteData('menu-index', 'tb_menu', <?= $menu['id'] ?>)">Hapus</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  </section>


</main>

<?php include 'template/footer.php'; ?>