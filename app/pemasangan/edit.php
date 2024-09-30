<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php


$pemasangan = QueryOnedata('SELECT * FROM pemasangan WHERE id_pemasangan = "' . $_GET['id_pemasangan'] . '"')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pemasangan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Pemasangan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pemasangan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row' >
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Id Pemasangan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputid_pemasangan' name='id_pemasangan' value='<?= $pemasangan['id_pemasangan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_pelanggan' id='inputid_pelanggan'>
                            <?php
                            $pelanggans = QueryManyData('SELECT * FROM pelanggan');
                            foreach ($pelanggans  as  $row) {
                                if ($pemasangan['id_pelanggan'] ==  $row['id_pelanggan']) { ?>
                                    <option value='<?= $row['id_pelanggan'] ?>' selected><?= $row['id_pelanggan'] ?> <?= $row['nm_pelanggan'] ?></option>
                                <?php } else {
                                ?><option value='<?= $row['id_pelanggan'] ?>'><?= $row['id_pelanggan'] ?> <?= $row['nm_pelanggan'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_user' class='col-sm-2 col-form-label'>User
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $users = QueryManyData('SELECT * FROM user where level = "petugas lapangan" ');
                            foreach ($users  as  $row) {
                                if ($pemasangan['id_user'] ==  $row['id_user']) { ?>
                                    <option value='<?= $row['id_user'] ?>' selected><?= $row['nm_pengguna'] ?></option>
                                <?php } else { ?>
                                    <option value='<?= $row['id_user'] ?>'><?= $row['nm_pengguna'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_permintaan_pemasangan' class='col-sm-2 col-form-label'>Tgl Permintaan Pemasangan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_permintaan_pemasangan' name='tgl_permintaan_pemasangan' value='<?= $pemasangan['tgl_permintaan_pemasangan']; ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_realisasi_pekerjaan' class='col-sm-2 col-form-label'>Tgl Realisasi Pekerjaan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_realisasi_pekerjaan' name='tgl_realisasi_pekerjaan' value='<?= $pemasangan['tgl_realisasi_pekerjaan']; ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_tagihan' class='col-sm-2 col-form-label'>Tgl Tagihan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_tagihan' name='tgl_tagihan' value='<?= $pemasangan['tgl_tagihan']; ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputbiaya' class='col-sm-2 col-form-label'>Biaya</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputbiaya' name='biaya' value='<?= $pemasangan['biaya']; ?>' required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputstatus_pemasangan" class="col-sm-2 col-form-label">Status Pemasangan
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status_pemasangan" id="inputstatus_pemasangan">
                            <?php
                            $status_pemasangan = ['Pengajuan', 'Proses', 'Realisasi'];
                            foreach ($status_pemasangan  as $val) {
                                if ($pemasangan['status_pemasangan'] ==  $val) { ?>
                                    <option value="<?= $val ?>" selected><?= $val ?></option>
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
                        <a href='<?= $url ?>/app/pemasangan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updatepemasangan' value='updatepemasangan' class='btn btn-success btn-user btn-block'>
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