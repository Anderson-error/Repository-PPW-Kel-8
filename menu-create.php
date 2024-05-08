<?php include 'template/header.php'; ?>

<?php 

if (isset($_POST['submit'])) {

    $nama_menu   = $_POST['nama_menu'];
    $stok        = intval($_POST['stok']);
    $harga       = intval($_POST['harga']);
    $deskripsi   = $_POST['deskripsi'];
    $kategori    = $_POST['kategori'];
    $foto        = uploadImage($_FILES['foto']);
    $best_seller = (isset($_POST['best_seller'])) ? 1 : 0;

    $query = "INSERT INTO tb_menu VALUES (NULL, '$nama_menu', $harga, '$deskripsi', '$kategori', $stok, $best_seller, '$foto')";

    $proses = setData($query);

    if ($proses == true) {
        echo "<script>alert('Tambah Data Berhasil.');</script>";
        echo "<script>window.location.href='menu-index.php'</script>";
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
                    Manajemen Menu
                </h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="menu-index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Tambah Data
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
                            
                            <div class="col-md-6">
                                <label class="form-label">Nama Menu</label>
                                <input 
                                    type="text" 
                                    name="nama_menu"
                                    class="form-control" 
                                    placeholder="Masukan nama menu..."
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <?php foreach (KATEGORI_MENU as $kategori) { ?>
                                    <option value="<?= $kategori ?>"><?= $kategori ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input 
                                    type="number" 
                                    name="harga"
                                    min="0"
                                    value="0"
                                    class="form-control" 
                                    required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input 
                                    type="number" 
                                    name="stok"
                                    min="0"
                                    value="0"
                                    class="form-control" 
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Foto Menu</label>
                                <input 
                                    type="file" 
                                    name="foto"
                                    class="form-control" 
                                    accept="image/png, image/jpeg"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" cols="10" rows="3" class="form-control" placeholder="Masukan deskripsi..."></textarea>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="best_seller" type="checkbox" value="1" id="best-seller-input">
                                    <label class="form-check-label" for="best-seller-input">
                                        Tandai sebagai Best Seller
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
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