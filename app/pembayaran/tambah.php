<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php 
$jenis_pembayaran = "";
$expl = ["", ""];
if(isset($_GET['jenis_pembayaran'])){
    $expl = explode(":;", $_GET['jenis_pembayaran']);
}

?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pembayaran page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pembayaran <?= $expl[0] ?> Tanggal <?= $expl[1] ?>
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pembayaran.php' method='post' enctype='multipart/form-data'>
                <?php
                $id = 1;
                $terahir_pembayaran = QueryOnedata("SELECT * FROM pembayaran ORDER BY CAST(SUBSTRING(id_pembayaran, 3) AS UNSIGNED) DESC ");
                if ($terahir_pembayaran->num_rows > 0) {
                    $id = Rplc("BY", $terahir_pembayaran->fetch_assoc()['id_pembayaran']) + $id;
                }
                ?>
                <div class='mb-3 row'>
                    <label for='inputid_pembayaran' class='col-sm-2 col-form-label'>ID PEMASANANGN</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' value="BY00<?= $id ?>" readonly>
                        <input type='hidden' class='form-control' id='inputid_pembayaran' name='id_pembayaran' value="BY00<?= $id ?>" required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            // menampilkan data pencatatan bulan ini
                            $pasang = 'SELECT * FROM pemasangan';
                            if($_SESSION['level'] == 'pelanggan'){                               
                                $pasang = 'SELECT * FROM pemasangan 
                                    LEFT JOIN  pelanggan ON pelanggan.id_pelanggan = pemasangan.id_pelanggan 
                                    WHERE pelanggan.id_user = "'.$_SESSION['id_user'].'" ';
                            }
                            $pemasangan = QueryManyData($pasang);
                            foreach ($pemasangan as  $row) {
                                $pepe = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan  where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
                            ?>
                                <option value='<?= $row['id_pemasangan'] ?>'> <?= $row['id_pemasangan'] ?> [<?= $pepe['nm_pelanggan'] ?> <?= $pepe['tgl_permintaan_pemasangan'] ?> ]</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_bayar' class='col-sm-2 col-form-label'>Tanggal Bayar</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_bayar' name='tgl_bayar' value="<?=date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnominal' class='col-sm-2 col-form-label'>Nominal</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputnominal' name='nominal' value="<?= intval($expl[2]) ?>" required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputjenis_pembayaran' class='col-sm-2 col-form-label'>Jenis Pembayaran</label>
                    <input type="hidden" class='form-control' id='inputjenis_pembayaran' name='jenis_pembayaran' value="<?= $expl[0].":;".$expl[1].":;" ?>" required>
                    <div class='col-sm-4'>
                        <input type="text" class='form-control' value="<?= $expl[0] ?>" readonly>
                    </div>
                    <label for='inputjenis_pembayaran' class='col-sm-2 col-form-label text-right'>Tanggal <?= $expl[0] == 'pencatatan_penggunaan' ? 'Pencatatan' : 'Pemasangan' ?> </label>
                    <div class='col-sm-4'>
                        <input type="text" class='form-control' value="<?= $expl[1] ?>" readonly>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_pembayaran' class='col-sm-2 col-form-label'>Keterangan Pembayaran</label>
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
                            $status = ['upload'];
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