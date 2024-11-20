<?php 
include_once '../template/header.php'; 
include_once '../template/sidebar.php'; 
include_once '../template/navbar.php'; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Broadcast Page</h1>
    <?php if (isset($_SESSION['message'])) { ?>
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success !</strong> <?= $_SESSION['message'] ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    <?php  unset($_SESSION['message']); } ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Broadcast Pesan ke Semua Pelanggan</h6>
                </div>
                <div class="card-body">    
                    <form action="<?= $url ?>/aksi/broadcast.php" method="POST" enctype="multipart/form-data" >       
                        <p>Masukkan pesan yang akan di kirim ke semua pelanggan !</p>
                        <p> <input type="checkbox" name="telat" id=""> Masukkan pesan yang akan di kirim hanya ke  pelanggan yang telat bayar !</p>
                        <textarea class="form-control" name="broadcast" id="" cols="30" rows="10"></textarea>
                        <div class="my-2"></div>
                        <button type="submit" value="BTN_POST_BROADCAST" name="BTN_POST_BROADCAST" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                            <span class="text">KIRIM </span>
                        </button>
                    </form>     
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Broadcast Pesan ke Pelanggan</h6>
                </div>
                <div class="card-body">    
                    <form action="<?= $url ?>/aksi/broadcast.php" method="POST" enctype="multipart/form-data" >       
                        <p>Masukkan pesan yang akan di kirim ke pelanggan !</p>
                        <div class='mb-3 row' >
                            <label for='inputno_pelanggan' class='col-sm-4 col-form-label'>Kirim ke Pelanggan</label>
                            <div class='col-sm-8'>
                                <select class='form-control js-example-basic-single' name='no_pelanggan' id='inputno_pelanggan'>
                                    <?php
                                    $pelanggan = QueryManyData('SELECT * FROM pelanggan  ');
                                    foreach ($pelanggan as  $row) {
                                    ?>
                                        <option value='<?= $row['no_pelanggan'] ?>' > <?= $row['id_pelanggan'] ?> <?= $row['nm_pelanggan'] ?> [+62 <?= $row['no_pelanggan'] ?>]</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <textarea class="form-control" name="broadcast" id="" cols="30" rows="8"></textarea>
                        <div class="my-2"></div>
                        <button type="submit" value="BTN_POST_ONE" name="BTN_POST_ONE" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                            <span class="text">KIRIM </span>
                        </button>
                    </form>     
                </div>
            </div>
        </div>
        <?php /*
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <a href="<?= $url ?>/app/user.php">Data User</a>
                                        </div>
                                    <?php
                                    $user = QueryOnedata("SELECT COUNT(*) as jumlah FROM user ")->fetch_assoc();
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user['jumlah'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
        */ ?>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>