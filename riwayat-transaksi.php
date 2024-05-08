<?php include 'template/header.php'; ?>

<main id="main">

  <section>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="m-0">
                    Riwayat Transaksi
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">

                        <button 
                            class="nav-link active" 
                            id="nav-pemasukan-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#nav-pemasukan-tab-content" 
                            type="button" 
                            role="tab" 
                            aria-controls="nav-menu" 
                            aria-selected="true">
                            Pemasukan
                        </button>
                        
                        <button 
                            class="nav-link" 
                            id="nav-pengeluaran-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#nav-pengeluaran-tab-content" 
                            type="button" 
                            role="tab" 
                            aria-controls="nav-menu" 
                            aria-selected="true">
                            Pengeluaran
                        </button>

                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-pemasukan-tab-content" role="tabpanel" aria-labelledby="nav-pemasukan-tab" tabindex="0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col" width="12%">Tanggal</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Pembelian</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $orders = getData("SELECT * FROM tb_pesanan ORDER BY tanggal DESC");
                            
                            foreach ($orders as $index => $order) {

                                $items = json_decode($order['pesanan'], true);
                                
                            ?>
                                <tr>
                                    <th><?= $index + 1 ?></th>
                                    <td>
                                        <?= tanggalIndo($order['tanggal']) ?>
                                    </td>
                                    <td>
                                        <?= $order['pelanggan'] ?>
                                    </td>
                                    <td>
                                        
                                        <details>
                                            <summary>Lihat Rincian</summary>
                                            <table class="table">
                                                <tbody>
                                                    <?php foreach ($items as $item) { ?>
                                                    <tr>
                                                        <td width="60%"><?= $item['nama_menu'] ?> <small>(<?= rupiah($item['harga']) ?>)</small></td>
                                                        <td>x<?= $item['qty'] ?></td>
                                                        <td class="text-end"><?= rupiah($item['subtotal']) ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </details>

                                    </td>
                                    <td>
                                        <?= rupiah($order['total']) ?>
                                    </td>
                                    <td>
                                        <?= $order['petugas_kasir'] ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteData('riwayat-transaksi', 'tb_pesanan', <?= $order['id'] ?>)">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="tab-pane fade" id="nav-pengeluaran-tab-content" role="tabpanel" aria-labelledby="nav-pengeluaran-tab" tabindex="0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col" width="23%">Tanggal / Pengguna</th>
                                    <th scope="col" width="40%">Keperluan</th>
                                    <th scope="col" width="15%">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $pengeluaran = getData("SELECT *, tb_pengeluaran.id AS id_pengeluaran FROM tb_pengeluaran INNER JOIN tb_pengguna ON tb_pengeluaran.id_pengguna = tb_pengguna.id ORDER BY tb_pengeluaran.tanggal DESC");

                            foreach ($pengeluaran as $index => $item) {
                                
                            ?>
                                <tr>
                                    <th><?= $index + 1 ?></th>
                                    <td><?= tanggalIndo($item['tanggal']) ?> / <?= $item['nama'] ?></td>
                                    <td><?= $item['keperluan'] ?></td>
                                    <td><?= rupiah($item['nominal']) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </section>


</main>

<?php include 'template/footer.php'; ?>