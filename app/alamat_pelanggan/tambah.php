<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Alamat_Pelanggan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Alamat_Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/alamat_pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Id_Pelanggan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
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
                    <label for='inputket_alamat' class='col-sm-2 col-form-label'>Ket_Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_alamat' name='ket_alamat' required></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlat_alamat' class='col-sm-2 col-form-label'>Lat_Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlat_alamat' name='lat_alamat' required></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Long_Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlong_alamat' name='long_alamat' required></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/alamat_pelanggan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanalamat_pelanggan' value='simpanalamat_pelanggan' class='btn btn-primary btn-user btn-block'>
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