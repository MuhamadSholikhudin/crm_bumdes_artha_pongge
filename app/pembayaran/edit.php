<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$pembayaran = QueryOnedata('SELECT * FROM pembayaran WHERE id_pembayaran = "' . $_GET['id_pembayaran'] . '"')->fetch_assoc();

$jenis_pembayaran = "";
$expl = ["", ""];
if(isset($pembayaran['ket_pembayaran'])){
    $expl = explode(":;", $pembayaran['ket_pembayaran']);
}
?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pembayaran page</h1>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Pembayaran <?= $expl[0] ?> Tanggal <?= $expl[1] ?>
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pembayaran.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pembayaran' class='col-sm-2 col-form-label'>ID Pembayaran</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' value='<?= $pembayaran['id_pembayaran']; ?>' readonly>
                        <input type='text' class='form-control d-none' id='inputid_pembayaran' name='id_pembayaran' value='<?= $pembayaran['id_pembayaran']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            $pasang = 'SELECT * FROM pemasangan';
                            if ($_SESSION['level'] == 'pelanggan') {
                                $pasang = 'SELECT * FROM pemasangan 
                                    LEFT JOIN  pelanggan ON pelanggan.id_pelanggan = pemasangan.id_pelanggan 
                                    WHERE pelanggan.id_user = "' . $_SESSION['id_user'] . '" ';
                            }
                            $pemasangans = QueryManyData($pasang);
                            foreach ($pemasangans  as  $row) {
                                $pel = QueryOnedata('SELECT * FROM pelanggan WHERE id_pelanggan ="' . $row['id_pelanggan'] . '"')->fetch_assoc();
                                if ($pencatatan_penggunaan['id_pemasangan'] ==  $row['id_pemasangan']) {
                            ?>
                                    <option value='<?= $row['id_pemasangan'] ?>' selected><?= $row['id_pemasangan'] ?> [ <?= $pel['nm_pelanggan'] ?> | <?= $row['tgl_realisasi_pekerjaan'] ?>]</option>
                                <?php } else {
                                ?><option value='<?= $row['id_pemasangan'] ?>'> <?= $row['id_pemasangan'] ?> [ <?= $pel['nm_pelanggan'] ?> <?= $row['tgl_realisasi_pekerjaan'] ?>]</option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_bayar' class='col-sm-2 col-form-label'>Tanggal Bayar</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_bayar' name='tgl_bayar' value='<?= $pembayaran['tgl_bayar']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnominal' class='col-sm-2 col-form-label'>Nominal</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputnominal' name='nominal' value='<?= $pembayaran['nominal']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputjenis_pembayaran' class='col-sm-2 col-form-label'>Jenis Pembayaran</label>
                    <input type="hidden" class='form-control' id='inputjenis_pembayaran' name='jenis_pembayaran' value="<?= $expl[0].":;".$expl[1].":;" ?>" required>
                    <div class='col-sm-4'>
                        <input type="text" class='form-control' value="<?= $expl[0] ?>" readonly>
                    </div>
                    <label for='inputjenis_pembayaran' class='col-sm-3 col-form-label text-right'>Tanggal <?= $expl[0] == 'pencatatan_penggunaan' ? 'Pencatatan' : 'Pemasangan' ?> </label>
                    <div class='col-sm-3'>
                        <input type="text" class='form-control' value="<?= $expl[1] ?>" readonly>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_pembayaran' class='col-sm-2 col-form-label'>Keterangan Pembayaran</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_pembayaran' name='ket_pembayaran' required><?= $expl[2] ?></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputstatus" class="col-sm-2 col-form-label">Status
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status" id="inputstatus">
                            <?php
                            if ($_SESSION['level'] == "pelanggan") {
                                $status = ['upload'];
                            } else {
                                $status = ['upload', 'tervalidasi'];
                            }
                            foreach ($status  as $val) { 
                                if ($val == $pembayaran['status']) { 
                            ?>
                                <option value='<?= $val ?>' selected><?= $val ?></option>
                            <?php } else { ?> 
                                <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
                                }
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
                        <button type='submit' name='updatepembayaran' value='updatepembayaran' class='btn btn-success btn-user btn-block'>
                            <i class='fas fa-save'></i> UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include_once '../template/footer.php'; ?>