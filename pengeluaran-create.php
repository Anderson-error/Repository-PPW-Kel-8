<?php include 'template/header.php'; ?>

<?php 

if (isset($_POST['submit'])) {

    $id_penguna = $_SESSION['user']['id'];
    $keperluan  = $_POST['keperluan'];
    $nominal    = intval($_POST['nominal']);
    $tanggal    = date('Y-m-d');

    $saldo_toko = intval($toko['saldo']);

    if ($saldo_toko < $nominal) {
        echo "<script>alert('Saldo toko tidak mencukupi nominal pengeluaran !');</script>";
    } else {
        $query = "INSERT INTO tb_pengeluaran VALUES (NULL, $id_penguna, '$keperluan', '$tanggal', $nominal)";
        $proses = setData($query);

        updateSaldo(false, $nominal);

        if ($proses == true) {
            echo "<script>alert('Tambah Data Berhasil.');</script>";
            echo "<script>window.location.href='pengeluaran-index.php'</script>";
        } else {
            echo "<script>alert('Terjadi Kesalahan !');</script>";
        }
    }
}

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
                <a href="pengeluaran-index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Tambah Data
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="">
                            
                            <div class="col-md-12">
                                <label class="form-label">Tanggal</label>
                                <input 
                                    type="text" 
                                    value="<?= tanggalIndo(date('Y-m-d')) ?>"
                                    class="form-control"
                                    disabled>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Keperluan</label>
                                <textarea 
                                    name="keperluan" 
                                    rows="4" 
                                    class="form-control" 
                                    placeholder="Masukan keperluan pengeluaran..." 
                                    required></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Nominal (Rp)</label>
                                <input 
                                    type="number" 
                                    name="nominal"
                                    value="0"
                                    min="0"
                                    class="form-control" 
                                    placeholder="Masukan nominal pengeluaran"
                                    required>
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