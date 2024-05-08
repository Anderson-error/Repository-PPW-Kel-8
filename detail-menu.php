<?php include 'template/header.php'; ?>

<?php 

$id = $_GET['id'];

if ($id === NULL) {
    echo "<script>window.location.href='menu.php'</script>";
}

$menu = getData("SELECT * FROM tb_menu WHERE id = $id", true);

if (empty($menu)) {
    echo "<script>window.location.href='menu.php'</script>";
}

?>

<main id="main" style="min-height: 100vh">

    <section id="menu">
        <div class="container">
            <div class="row">

                <div class="col-12 mb-3">
                    <a href="menu.php" style="color: var(--color-primary);font-weight: 500;">
                        <i class="bi bi-chevron-left"></i> Kembali
                    </a>
                </div>

                <div class="col-md-6">
                    <img 
                        src="assets/upload/menu/<?= $menu['foto'] ?>" 
                        class="img-fluid rounded" 
                        alt="<?= $menu['nama_menu'] ?>"
                        style="width:100%;height:400px;object-fit:cover;">
                </div>

                <div class="col-md-6">
                    <h2><?= $menu['nama_menu'] ?></h2>
                    <h4><?= rupiah($menu['harga']) ?></h4>
                    <p><?= $menu['deskripsi'] ?></p>
                    <div>
                    <button type="button" class="btn btn-sm btn-primary">
                        <span class="badge" style="background-color: var(--color-kuning);color: var(--color-primary);padding:4px;"><?= rand(10, 99) ?></span> Orang Menyukai
                    </button>
                    </div>
                </div>
            </div>

            <h5 class="mt-4">Menu Lainnya</h5>
            <div class="row d-flex flex-row flex-nowrap w-100 overflow-x-auto" style="margin-left:.18rem;">
                
                <?php 
                $order_by = ((rand(10, 100) % 2) == 0) ? 'ASC' : 'DESC';

                $other_menus = getData("SELECT * FROM tb_menu WHERE kategori = '". $menu['kategori'] ."' ORDER BY id $order_by LIMIT 10");

                foreach ($other_menus as $index => $other_menu) { 
                    
                ?>
                <div class="col-2 <?= ($index == 0) ? 'ps-0' : '' ?>">
                    <div class="card" onclick="openDetailMenu(<?= $other_menu['id'] ?>)">
                        <img 
                            src="assets/upload/menu/<?= $other_menu['foto'] ?>" 
                            class="card-img-top" 
                            alt="<?= $other_menu['nama_menu'] ?>"
                            style="width: 100%;height: 150px;object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title text-center">
                                <?= $other_menu['nama_menu'] ?>
                            </h6>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>

</main>

<?php include 'template/footer.php'; ?>