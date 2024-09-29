<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pembayaran page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pembayaran
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pembayaran.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            $pemasangan = QueryManyData('SELECT * FROM pemasangan');
                            foreach ($pemasangan as  $row) {
                                $pepe = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan  where pemasangan.id_pemasangan = ' . $row['id_pemasangan'] . '')->fetch_assoc();
                            ?>
                                <option value='<?= $row['id_pemasangan'] ?>'><?= $pepe['nm_pelanggan'] ?> // <?= $pepe['tgl_permintaan_pemasangan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_bayar' class='col-sm-2 col-form-label'>Tgl Bayar</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_bayar' name='tgl_bayar' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnominal' class='col-sm-2 col-form-label'>Nominal</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputnominal' name='nominal' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_pembayaran' class='col-sm-2 col-form-label'>Ket Pembayaran</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_pembayaran' name='ket_pembayaran' required></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputstatus" class="col-sm-2 col-form-label">Status
                    </label>
                    <div class="col-sm-10">

                        <select class="form-control" name="status" id="inputstatus">
                            <?php
                            $status = ['upload', 'tervalidasi'];
                            foreach ($status    as $val) { ?>
                                <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pembayaran/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanpembayaran' value='simpanpembayaran' class='btn btn-primary btn-user btn-block'>
                            <i class='fas fa-save'></i> SIMPAN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>