<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php


$pelanggan = QueryOnedata('SELECT * FROM pelanggan WHERE id_pelanggan = "' . $_GET['id_pelanggan'] . '"')->fetch_assoc();

$user = QueryOnedata('SELECT * FROM user WHERE id_user = "' . $pelanggan['id_user'] . '"')->fetch_assoc();

?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pelanggan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/data_pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row' style="display: none;">
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='hidden' class='form-control' id='inputid_pelanggan' name='id_pelanggan' value='<?= $pelanggan['id_pelanggan']; ?>' required>
                        <input type='hidden' class='form-control' id='inputid_user' name='id_user' value='<?= $pelanggan['id_user']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputpassword' class='col-sm-2 col-form-label'>Password</label>
                    <div class='col-sm-10'>
                        <input type='password' class='form-control' id='inputpassword' name='password' value='<?= $user['password']; ?>' required>
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
                        <input type='text' class='form-control' id='inputno_pelanggan' name='no_pelanggan' value='<?= $pelanggan['no_pelanggan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/data_pelanggan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updatepelanggan' value='updatepelanggan' class='btn btn-success btn-user btn-block'>
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