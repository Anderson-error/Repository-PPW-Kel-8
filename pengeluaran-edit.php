<?php include 'template/header.php'; ?>

<?php 

$id = $_GET['id'];

if ($id === NULL) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

$data = getData("SELECT * FROM tb_pengeluaran WHERE id = $id", true);

if (empty($data) || $data['id_pengguna'] != $_SESSION['user']['id']) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

if (isset($_POST['submit'])) {

    $keperluan  = $_POST['keperluan'];
    $nominal    = intval($_POST['nominal']);

    $saldo_toko = intval($toko['saldo']); // 100000
    
    $nominal_pengeluaran_awal  = intval($data['nominal']); // 50000
    $nominal_pengeluaran_akhir = $nominal; // 20000
    
    $is_nominal_pengeluaran_bertambah = ($nominal_pengeluaran_akhir > $nominal_pengeluaran_awal);

    if ($is_nominal_pengeluaran_bertambah && ($saldo_toko < ($nominal_pengeluaran_akhir - $nominal_pengeluaran_awal))) {
        echo "<script>alert('Saldo toko tidak mencukupi nominal pengeluaran !');</script>";
    } else {
        if ($is_nominal_pengeluaran_bertambah) {
            updateSaldo(false, ($nominal_pengeluaran_akhir - $nominal_pengeluaran_awal));
        } else {
            updateSaldo(true, ($nominal_pengeluaran_awal - $nominal_pengeluaran_akhir));
        }
    
        $query = "UPDATE tb_pengeluaran SET keperluan = '$keperluan', nominal = $nominal WHERE id = " . $id;
        $proses = setData($query);
    
        if ($proses == true) {
            echo "<script>alert('Edit Data Berhasil.');</script>";
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
                        Edit Data
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="">
                            
                            <div class="col-md-12">
                                <label class="form-label">Tanggal</label>
                                <input 
                                    type="text" 
                                    value="<?= tanggalIndo($data['tanggal']) ?>"
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
                                    required><?= $data['keperluan'] ?></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Nominal (Rp)</label>
                                <input 
                                    type="number" 
                                    name="nominal"
                                    value="<?= $data['nominal'] ?>"
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