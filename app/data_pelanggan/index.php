<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$pelanggan = QueryOnedata('SELECT * FROM pelanggan WHERE id_user = "' . $_SESSION['id_user'] . '"')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pelanggan page</h1>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success !</strong> <?= $_SESSION['message'] ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row' style="display: none;">
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='texts' class='form-control' id='inputid_pelanggan' name='id_pelanggan' value='<?= $pelanggan['id_pelanggan']; ?>' required>
                    </div>
                </div>

                <div class='mb-3 row'>
                    <label for='inputnm_pelanggan' class='col-sm-2 col-form-label'>Nama Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_pelanggan' name='nm_pelanggan' value='<?= $pelanggan['nm_pelanggan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputno_pelanggan' class='col-sm-2 col-form-label'>No Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputno_pelanggan' name='no_pelanggan' value='<?= $pelanggan['no_pelanggan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>

                    </div>
                    <div class='col-sm-10'>
                        <a href='<?= $url ?>/app/data_pelanggan/edit.php?id_pelanggan=<?= $pelanggan['id_pelanggan']; ?>' class='btn btn-success btn-sm '>
                            <i class='fas fa-share-square'></i> Edit
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    $alamat_pelanggan = QueryOnedata('SELECT * FROM alamat_pelanggan WHERE id_pelanggan = "' . $pelanggan['id_pelanggan'] . '"')->fetch_assoc();
    if ($alamat_pelanggan == NULL) {
        $alamat_pelanggan = [
            'ket_alamat' => NULL,
            'lat_alamat' => NULL,
            'long_alamat' => NULL,
        ];
    }
    ?>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Alamat Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/alamat_pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputket_alamat' class='col-sm-2 col-form-label'>Keterangan Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_alamat' name='ket_alamat' required><?= $alamat_pelanggan['ket_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlat_alamat' class='col-sm-2 col-form-label'>Latitud Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlat_alamat' name='lat_alamat' required><?= $alamat_pelanggan['lat_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Longtitude    Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlong_alamat' name='long_alamat' required><?= $alamat_pelanggan['long_alamat'] ?></textarea>
                    </div>
                </div>
                 <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Maps Alamat</label>
                    <div class='col-sm-10'>
                        <iframe src="https://www.google.com/maps?q=<?= $alamat_pelanggan['lat_alamat'] ?>,<?= $alamat_pelanggan['long_alamat'] ?>&hl=es;z=14&output=embed" frameborder="0" style='width:100%;'></iframe>
                    </div> 
                </div> 
                <div class='mb-3 row'>
                    <div class='col-sm-2'>

                    </div>
                    <div class='col-sm-10'>
                        <a href='<?= $url ?>/app/data_pelanggan/edit_alamat.php?id_pelanggan=<?= $pelanggan['id_pelanggan'] ?>' class='btn btn-success btn-sm '>
                            <i class='fas fa-share-square'></i> edit
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>