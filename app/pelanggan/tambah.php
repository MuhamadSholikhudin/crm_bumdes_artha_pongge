<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pelanggan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_user' class='col-sm-2 col-form-label'>User
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $user = QueryManyData('SELECT * FROM user where level ="pelanggan" ');
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
                    <label for='inputnm_pelanggan' class='col-sm-2 col-form-label'>Nama Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_pelanggan' name='nm_pelanggan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputno_pelanggan' class='col-sm-2 col-form-label'>No Pelanggan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputno_pelanggan' name='no_pelanggan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pelanggan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanpelanggan' value='simpanpelanggan' class='btn btn-primary btn-user btn-block'>
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