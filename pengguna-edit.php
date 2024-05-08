<?php include 'template/header.php'; ?>

<?php 

$id = $_GET['id'];

if ($id === NULL) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

$data = getData("SELECT * FROM tb_pengguna WHERE id = $id", true);

if (empty($data) || $data['role'] === "SUPERADMIN") {
    echo "<script>window.location.href='dashboard.php'</script>";
}

if (isset($_POST['submit'])) {

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $role     = $_POST['role'];

    $query = "UPDATE tb_pengguna SET nama = '$nama', email = '$email', role = '$role' WHERE id = $id";

    $proses = setData($query);

    if ($proses == true) {
        echo "<script>alert('Edit Data Berhasil.');</script>";
        echo "<script>window.location.href='pengguna-index.php'</script>";
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
                    Manajemen Pengguna
                </h3>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="pengguna-index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Edit Data
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
                                    required>
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
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <?php foreach (ROLES as $role) { ?>
                                    <option value="<?= $role ?>" <?= ($data['role'] === $role) ? 'selected' : null ?>>
                                        <?= $role ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <small>Catatan : Password default pengguna baru adalah <strong>12345678</strong></small>
                           
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