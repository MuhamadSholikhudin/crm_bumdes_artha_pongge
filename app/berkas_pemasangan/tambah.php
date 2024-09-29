<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Berkas Pemasangan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Berkas Pemasangan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/berkas_pemasangan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Id Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            $pemasangan = QueryManyData('SELECT * FROM pemasangan');
                            foreach ($pemasangan as  $row) {
                                $pepe = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan  where pemasangan.id_pemasangan = '.$row['id_pemasangan'].'')->fetch_assoc();  
                            ?>
                                <option value='<?= $row['id_pemasangan'] ?>'><?= $pepe['nm_pelanggan'] ?> // <?= $pepe['tgl_permintaan_pemasangan'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnm_berkas' class='col-sm-2 col-form-label'>Nm Berkas</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_berkas' name='nm_berkas' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_berkas' class='col-sm-2 col-form-label'>Foto Berkas</label>
                    <div class='col-sm-10'>
                        <input type='file' class='form-control' id='inputfoto_berkas' name='foto_berkas' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/berkas_pemasangan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanberkas_pemasangan' value='simpanberkas_pemasangan' class='btn btn-primary btn-user btn-block'>
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