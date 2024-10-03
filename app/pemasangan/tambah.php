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
            <?php 
                    $id = 1;
                    //cari data terakhir dari pelanggan
                    // $terahir_pelanggan = "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC ";
                    $terahir_pemasangan = QueryOnedata("SELECT * FROM pemasangan ORDER BY id_pemasangan DESC ");                  
                    if($terahir_pemasangan->num_rows > 0 ){
                        $id = Rplc("PS", $terahir_pemasangan->fetch_assoc()['id_pemasangan']) + $id;
                    }
                ?>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>ID PEMASANANGN</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputid_pemasangan' name='id_pemasangan' value="PS00<?= $id ?>" required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan</label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pelanggan' id='inputid_pelanggan'>
                            <?php
                            $pelanggan = QueryManyData('SELECT * FROM pelanggan WHERE id_user = "'.$_SESSION['id_user'].'" ');
                            foreach ($pelanggan as  $row) {
                            ?>
                                <option value='<?= $row['id_pelanggan'] ?>' ><?= $row['id_pelanggan'] ?> <?= $row['nm_pelanggan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row d-none'>
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
                        <input type='date' class='form-control' id='inputtgl_permintaan_pemasangan' name='tgl_permintaan_pemasangan' value="<?= date('Y-m-d') ?>" >
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputtgl_realisasi_pekerjaan' class='col-sm-2 col-form-label'>Tgl Realisasi Pekerjaan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_realisasi_pekerjaan' name='tgl_realisasi_pekerjaan'  >
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputtgl_tagihan' class='col-sm-2 col-form-label'>Tgl Tagihan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputtgl_tagihan' value="<?= date('j') ?>" name='tgl_tagihan' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputbiaya' class='col-sm-2 col-form-label'>Biaya</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' value="<?= date('j') ?>" readonly>
                        <input type='number' class='form-control d-none' id='inputbiaya' name='biaya' value="<?= date('j') ?>" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputstatus_pemasangan" class="col-sm-2 col-form-label">Status Pemasangan
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status_pemasangan" id="inputstatus_pemasangan">
                            <?php
                            $status_pemasangan = ['Pengajuan'];
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