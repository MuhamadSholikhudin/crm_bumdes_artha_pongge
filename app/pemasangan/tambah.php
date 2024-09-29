<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pemasangan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pemasangan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pemasangan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan</label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pelanggan' id='inputid_pelanggan'>
                            <?php
                            $pelanggan = QueryManyData('SELECT * FROM pelanggan');
                            foreach ($pelanggan as  $row) {
                            ?>
                                <option value='<?= $row['id_pelanggan'] ?>'><?= $row['nm_pelanggan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_user' class='col-sm-2 col-form-label'>Petugas Lapangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $user = QueryManyData('SELECT * FROM user where level ="petugas lapangan" ');
                            foreach ($user as  $row) {
                            ?>
                                <option value='<?= $row['id_user'] ?>'><?= $row['nm_pengguna'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_permintaan_pemasangan' class='col-sm-2 col-form-label'>Tgl Permintaan Pemasangan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_permintaan_pemasangan' name='tgl_permintaan_pemasangan' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_realisasi_pekerjaan' class='col-sm-2 col-form-label'>Tgl Realisasi Pekerjaan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_realisasi_pekerjaan' name='tgl_realisasi_pekerjaan' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_tagihan' class='col-sm-2 col-form-label'>Tgl Tagihan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_tagihan' name='tgl_tagihan' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputbiaya' class='col-sm-2 col-form-label'>Biaya</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputbiaya' name='biaya' required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputstatus_pemasangan" class="col-sm-2 col-form-label">Status Pemasangan
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status_pemasangan" id="inputstatus_pemasangan">
                            <?php
                            $status_pemasangan = ['Pengajuan', 'Proses', 'Realisasi'];
                            foreach ($status_pemasangan    as $val) { ?>
                                <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
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
                        <button type='submit' name='simpanpemasangan' value='simpanpemasangan' class='btn btn-primary btn-user btn-block'>
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