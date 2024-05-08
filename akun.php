<?php include 'template/header.php'; ?>

<?php 

$id = $_SESSION['user']['id'];

$data = getData("SELECT * FROM tb_pengguna WHERE id = $id", true);

if (isset($_POST['submit_akun'])) {

    $nama  = $_POST['nama'];
    $email = $_POST['email'];

    $query = "UPDATE tb_pengguna SET nama = '$nama', email = '$email'";

    if (isset($_POST['password']) && trim($_POST['password']) !== "") {
        $new_password = md5($_POST['password']);
        $query .= ", password = '$new_password'";
    }

    $query .= " WHERE id = $id";

    $proses = setData($query);

    echo "<script>alert('Data akun berhasil diperbarui.');</script>";
    echo "<script>window.location.href='akun.php'</script>";
}

if (isset($_POST['submit_toko'])) {

    $nama_toko = $_POST['nama_toko'];
    $telpon    = $_POST['telpon'];
    $alamat    = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];
    $saldo     = intval($_POST['saldo']);

    $query = "UPDATE tb_toko SET nama_toko = '$nama_toko', telpon = '$telpon', alamat = '$alamat', deskripsi = '$deskripsi', saldo = $saldo WHERE id = " . $toko['id'];

    $proses = setData($query);

    echo "<script>alert('Data toko berhasil diperbarui.');</script>";
    echo "<script>window.location.href='akun.php'</script>";
}

?>

<main id="main">

  <section>
    <div class="container">

        <div class="row">
            <div class="col-6">
                <h3 class="mb-3">
                    Akun
                </h3>
                <div class="card">
                    <div class="card-header">
                        Edit Data Akun
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="">
                            
                            <div class="col-md-12">
                                <label class="form-label">Nama Pengguna</label>
                                <input 
                                    type="text" 
                                    name="nama"
                                    value="<?= $data['nama'] ?>"
                                    class="form-control" 
                                    placeholder="Masukan nama"
                                    required <?= ($_SESSION['user']['role'] === "STAFF") ? 'readonly' : '' ?>>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Alamat Email</label>
                                <input 
                                    type="email" 
                                    name="email"
                                    value="<?= $data['email'] ?>"
                                    class="form-control" 
                                    placeholder="Masukan alamat email"
                                    required>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Ubah Password</label>
                                <input 
                                    type="password" 
                                    name="password"
                                    class="form-control" 
                                    placeholder="Isi jika ingin mengubah password">
                            </div>
                           
                            <div class="col-md-12 mt-4">
                                <input type="submit" name="submit_akun" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-6 <?= ($_SESSION['user']['role'] === "STAFF") ? 'd-none' : '' ?>">
                <h3 class="mb-3">
                    Toko
                </h3>
                <div class="card">
                    <div class="card-header">
                        Edit Data Toko
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="">
                            
                            <div class="col-md-12">
                                <label class="form-label">Nama Toko</label>
                                <input 
                                    type="text" 
                                    name="nama_toko"
                                    value="<?= $toko['nama_toko'] ?>"
                                    class="form-control" 
                                    placeholder="Masukan nama toko"
                                    required>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Nomor Telpon</label>
                                <input 
                                    type="text" 
                                    name="telpon"
                                    value="<?= $toko['telpon'] ?>"
                                    class="form-control" 
                                    placeholder="Masukan nomor telpon"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea 
                                    name="alamat"
                                    class="form-control" 
                                    placeholder="Masukan alamat"
                                    required><?= $toko['alamat'] ?></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea 
                                    name="deskripsi"
                                    class="form-control" 
                                    rows="4"
                                    placeholder="Masukan deskripsi"
                                    required><?= $toko['deskripsi'] ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Saldo Toko (Rp)</label>
                                <input 
                                    type="number" 
                                    name="saldo"
                                    value="<?= $toko['saldo'] ?>"
                                    min="0"
                                    class="form-control" 
                                    placeholder="Masukan saldo"
                                    required>
                            </div>
                           
                            <div class="col-md-12 mt-4">
                                <input type="submit" name="submit_toko" value="Submit" class="btn btn-primary">
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