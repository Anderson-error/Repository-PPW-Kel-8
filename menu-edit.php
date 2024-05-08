<?php include 'template/header.php'; ?>

<?php 

$id = $_GET['id'];

if ($id === NULL) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

$data = getData("SELECT * FROM tb_menu WHERE id = $id", true);

if (empty($data)) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

if (isset($_POST['submit'])) {
    $nama_menu   = $_POST['nama_menu'];
    $stok        = intval($_POST['stok']);
    $harga       = intval($_POST['harga']);
    $deskripsi   = $_POST['deskripsi'];
    $kategori    = $_POST['kategori'];
    $foto        = ($_FILES['foto']['name'] !== "") ? uploadImage($_FILES['foto']) : $data['foto'];
    $best_seller = (isset($_POST['best_seller'])) ? 1 : 0;

    $query = "UPDATE tb_menu SET 
            nama_menu = '$nama_menu',
            harga = $harga,
            deskripsi ='$deskripsi',
            kategori = '$kategori',
            stok = $stok,
            best_seller = $best_seller,
            foto = '$foto'
            WHERE id = $id";

    $proses = setData($query);

    if ($proses == true) {
        echo "<script>alert('Edit Data Berhasil.');</script>";
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
                        Edit Data
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
                            
                            <div class="col-md-6">
                                <label class="form-label">Nama Menu</label>
                                <input 
                                    type="text" 
                                    name="nama_menu"
                                    value="<?= $data['nama_menu'] ?>"
                                    class="form-control" 
                                    placeholder="Masukan nama menu..."
                                    required <?= ($_SESSION['user']['role'] === "STAFF") ? 'readonly' : null ?>>
                            </div>

                            <div class="col-md-6 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <?php foreach (KATEGORI_MENU as $kategori) { ?>
                                    <option value="<?= $kategori ?>" <?= ($data['kategori'] === $kategori) ? 'selected' : null ?>>
                                        <?= $kategori ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-6 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                                <label class="form-label">Harga</label>
                                <input 
                                    type="number" 
                                    name="harga"
                                    min="0"
                                    value="<?= $data['harga'] ?>"
                                    class="form-control" 
                                    required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input 
                                    type="number" 
                                    name="stok"
                                    min="0"
                                    value="<?= $data['stok'] ?>"
                                    class="form-control" 
                                    required>
                            </div>

                            <div class="col-md-12 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                                <label class="form-label">Ubah Foto Menu</label>
                                <input 
                                    type="file" 
                                    name="foto"
                                    class="form-control" 
                                    accept="image/png, image/jpeg">
                            </div>

                            <div class="col-md-12 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" cols="10" rows="3" class="form-control" placeholder="Masukan deskripsi..."><?= $data['deskripsi'] ?></textarea>
                            </div>

                            <div class="col-md-12 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : null ?>">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        name="best_seller" 
                                        type="checkbox" 
                                        value="1" 
                                        id="best-seller-input" <?= (intval($data['best_seller']) == 1) ? 'checked' : null ?>>
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