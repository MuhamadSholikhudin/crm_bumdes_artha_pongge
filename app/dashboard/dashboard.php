<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Page</h1>
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
    <div class="row">
        <?php if ($_SESSION['level'] == 'pelanggan') {
            // menampilkan data pencatatan bulan ini
            $pelanggan = QueryOnedata("SELECT * FROM pelanggan WHERE id_user ='".$_SESSION['id_user']."' ");

            $catatan = "SELECT * FROM pencatatan_penggunaan 
            LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan 
            WHERE MONTH(pencatatan_penggunaan.tanggal) = '" . date('m') . "' AND YEAR(pencatatan_penggunaan.tanggal) = '" . date('Y') . "' AND pemasangan.id_pelanggan ='".$pelanggan->fetch_assoc()['id_pelanggan']."'  ";
            
            $catatan_bulan_ini = QueryOnedata($catatan);
            $data = [];
            $metaran_tagihan = 0;
            
            if ($catatan_bulan_ini->num_rows > 0) { //jika ada catatan bulan ini
                array_push($data, $catatan_bulan_ini->fetch_assoc());
                $metaran_tagihan = intval($data[0]['nilai_stand_meter']);
                $catatan_bulan_lalu = QueryOnedata("SELECT * FROM pencatatan_penggunaan WHERE tanggal < '" . $data[0]['tanggal'] . "' ORDER BY tanggal DESC");
                
                if ($catatan_bulan_lalu->num_rows > 0) { // Jika Bulan lalu juga ada catatan
                    array_push($data, $catatan_bulan_lalu->fetch_assoc());
                    $metaran_tagihan = $metaran_tagihan - intval($data[1]['nilai_stand_meter']);
                }
            }
            
            if ($metaran_tagihan > 0) {
        ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <!-- <a href="<?= $url ?>/app/user.php">Tagihan</a> -->
                                        Tagihan
                                    </div>
                                    
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= (($metaran_tagihan * 800 + 5000)) ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        <?php } ?>

        <?php

        /*
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