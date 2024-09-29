<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pengaduan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pengaduan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pengaduan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Id Pemasangan
                    </label>
                    <div class='col-sm-10'>
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
                    <label for='inputid_user' class='col-sm-2 col-form-label'>Id User
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $user = QueryManyData('SELECT * FROM user');
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
                    <label for='inputtgl_pengaduan' class='col-sm-2 col-form-label'>Tgl Pengaduan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_pengaduan' name='tgl_pengaduan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_perbaikan' class='col-sm-2 col-form-label'>Tgl Perbaikan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_perbaikan' name='tgl_perbaikan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_kendala' class='col-sm-2 col-form-label'>Ket Kendala</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_kendala' name='ket_kendala' required></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_kendala' class='col-sm-2 col-form-label'>Foto Kendala</label>
                    <div class='col-sm-10'>
                        <input type='file' class='form-control' id='inputfoto_kendala' name='foto_kendala' required>
                    </div>
                </div>
                <div class='mb-3 row '>
                    <label for='inputstatus_pengaduan ' class='col-sm-2 col-form-label '>Status Pengaduan
                    </label>
                    <div class='col-sm-10 '>
                        <select class='form-control' name='status_pengaduan' id='inputstatus_pengaduan'>
                            <?php
                            $status_pengaduan = ['Pengaduan', 'Proses', 'Terselesaikan'];
                            foreach ($status_pengaduan    as $val) { ?>
                                <option value='<?= $val ?>'><?= $val ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pengaduan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanpengaduan' value='simpanpengaduan' class='btn btn-primary btn-user btn-block'>
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