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
                        <p>Masukkan pesan yang akan di kirim ke pelanggan !</p>
                        <textarea class="form-control" name="broadcast" id="" cols="30" rows="10"></textarea>
                        <div class="my-2"></div>
                        <button type="submit" value="BTN_POST_BROADCAST" name="BTN_POST_BROADCAST" class="btn btn-sm btn-primary btn-icon-split btn-lg">
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
                        <div class="row">
                            <div class="col-md-3">
                                Kirim Ke 
                            </div>
                            <div class="col-md-9">
                                <select class='form-control js-example-basic-single' name='no_pelanggan' id='inputno_pelanggan'>
                                    <?php
                                    $pemasangan = QueryManyData('SELECT * FROM pelanggan');
                                    foreach ($pemasangan as  $row) {
                                    ?>
                                        <option value='<?= $row['no_pelanggan'] ?>'><?= $row['nm_pelanggan'] ?> [+62<?= $row['no_pelanggan'] ?>]</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  

                        <p>Masukkan pesan yang akan di kirim ke pelanggan !</p>
                        <textarea class="form-control" name="broadcast" id="" cols="30" rows="9"></textarea>
                        <div class="my-2"></div>
                        <button type="submit" value="BTN_POST_BROADCAST" name="BTN_POST_BROADCAST" class="btn btn-sm btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                            <span class="text">KIRIM </span>
                        </button>
                    </form>     
                </div>
            </div>
        </div>
  
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>