<?php include 'template/header.php'; ?>

<main id="main" style="min-height: 100vh">

    <section id="menu">
        <div class="container">
            <div class="row">
                <!-- Menu -->
                <div class="col-lg-12">

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
                            <div class="row mt-4 g-3">
                                <?php foreach ($menus as $index => $menu) { ?>
                                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                                    <div class="card" onclick="openDetailMenu(<?= $menu['id'] ?>)">
                                        <img 
                                            src="assets/upload/menu/<?= $menu['foto'] ?>" 
                                            class="card-img-top" 
                                            alt="<?= $menu['nama_menu'] ?>"
                                            style="width: 100%;height: 150px;object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title text-center fs-6">
                                                <?= $menu['nama_menu'] ?>
                                            </h5>
                                            <p class="card-text text-center fs-6">
                                                <?= rupiah($menu['harga']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>    
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'template/footer.php'; ?>