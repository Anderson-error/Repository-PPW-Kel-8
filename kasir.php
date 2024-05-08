<?php include 'template/header.php'; ?>

<?php 

if (isset($_POST['submit'])) {

    if (!array_key_exists("orders", $_POST)) {
        echo "<script>window.location.href='kasir.php'</script>";
    }

    $orders    = $_POST['orders'];
    $pelanggan = $_POST['pelanggan'];
    $petugas   = $_SESSION['user']['nama'];
    $tanggal   = date('Y-m-d');
    $total     = 0;

    $array_pesanan = [];

    foreach ($orders as $id_menu => $qty) {
        $menu = getData("SELECT * FROM tb_menu WHERE id = " . $id_menu, true);

        $subtotal = intval($menu['harga']) * intval($qty);

        $array_pesanan[] = [
            'nama_menu' => $menu['nama_menu'],
            'harga'     => intval($menu['harga']),
            'qty'       => $qty,
            'subtotal'  => $subtotal
        ];

        $total += $subtotal;

        $stok_menu_terkini  = intval($menu['stok']) - intval($qty);
        $query_update_stok  = "UPDATE tb_menu SET stok = $stok_menu_terkini WHERE id = $id_menu";
        $proses_update_stok = setData($query_update_stok);
    }

    $json_pesanan = json_encode($array_pesanan);

    $query = "INSERT INTO tb_pesanan VALUES (NULL, '$pelanggan', '$tanggal', '$json_pesanan', $total, '$petugas')";

    $proses = setData($query);

    updateSaldo(true, $total);

    if ($proses == true) {
        echo "<script>alert('Pesanan berhasil disimpan.');</script>";
        echo "<script>window.location.href='kasir.php'</script>";
    } else {
        echo "<script>alert('Terjadi Kesalahan !');</script>";
    }
}

?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="m-0">
                    Kasir
                </h3>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
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
                            <div class="col-lg-3">
                                <div class="card">
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
                                    <div class="card-footer">
                                        <div class="input-group mb-3">
                                            <button 
                                                class="btn btn-primary px-3" 
                                                type="button"
                                                onclick="handleMenuItem('-', <?= $menu['id'] ?>)" <?= intval($menu['stok']) == 0 ? 'disabled' : null ?>>
                                                <i class="bi-dash-lg"></i>
                                            </button>
                                            <input 
                                                type="text" 
                                                class="form-control text-center" 
                                                value="0"
                                                id="menu-<?= $menu['id'] ?>-qty"
                                                data-menu-nama="<?= $menu['nama_menu'] ?>"
                                                data-menu-harga="<?= $menu['harga'] ?>"
                                                readonly
                                                aria-label="qty" 
                                                aria-describedby="qty-aria">
                                            <button 
                                                class="btn btn-primary px-3" 
                                                type="button"
                                                onclick="handleMenuItem('+', <?= $menu['id'] ?>)" <?= intval($menu['stok']) == 0 ? 'disabled' : null ?>>
                                                <i class="bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Form Pesanan
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="text" name="tanggal" value="<?= tanggalIndo(date('Y-m-d')) ?>" disabled class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" name="pelanggan" placeholder="Masukan nama pelanggan" class="form-control" required>
                            </div>
                            <div id="list-pesanan" style="display: none;">
                                <hr/>

                                <h6>Daftar Pesanan</h6>
    
                                <table class="table table-hover">
                                    <tbody id="tbody-list-pesanan">
                                    </tbody>
                                    <tfoot>
                                        <tr class="fs-5 fw-semibold">
                                            <td>
                                                Total
                                            </td>
                                            <td colspan="3" class="text-end">
                                                <span id="total-list-pesanan">Rp 0</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="mb-3">
                                    <div class="d-grid gap-2">
                                        <input type="submit" name="submit" value="Checkout" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>


</main>

<?php include 'template/footer.php'; ?>