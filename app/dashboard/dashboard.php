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
        <?php
        function Extrade($string)
        {
            $expl = explode(":;", $string);
            return $expl;
        }
        if ($_SESSION['level'] == "pelanggan") {

            $data_pelanggan = [];
            $pelanggan = QueryOnedata("SELECT * FROM pelanggan WHERE id_user ='" . $_SESSION['id_user'] . "' ");
            array_push($data_pelanggan, $pelanggan->fetch_assoc());
    
            //================ TAGIHAN BIAYA PEMASANGAN ================
            // Cari Data Pembayaran Pemasangan yang sudah di pasang pada pelanggan
            $pemasangan = [];
            $pembayaran_pemasangan = [];
            $biaya_pemasangan = 0;
            $query_check_pemasangan = "SELECT * FROM pemasangan WHERE id_pelanggan = '" . $data_pelanggan[0]['id_pelanggan'] . "'  AND status_pemasangan = 'Realisasi'";
            $check_pemasangan = QueryOnedata($query_check_pemasangan); // Check Data Pemasangan pada pelanggan
            if ($check_pemasangan->num_rows > 0) { // Jika ada pemasangan
                array_push($pemasangan, $check_pemasangan->fetch_assoc());
    
                $biaya_pemasangan = 1700000;
                //Check data pembayaran pada pelanggan
                $query_check_pembayaran = "SELECT * FROM pembayaran WHERE status = 'tervalidasi' AND id_pemasangan = '" . $pemasangan[0]['id_pemasangan'] . "' AND ket_pembayaran LIKE '%pemasangan%' ";
                $check_pembayaran_pemasangan = QueryOnedata($query_check_pembayaran); // Check Data Pembayaran pemasangan pada pelanggan
                if ($check_pembayaran_pemasangan->num_rows > 0) {
                    $biaya_pemasangan = 0;
                    array_push($pembayaran_pemasangan, $check_pembayaran_pemasangan->fetch_assoc());
                }
            }
            //================ TAGIHAN BIAYA PEMASANGAN ================
    
            //================ PERHITUNGAN BIAYA BULANAN ================
            $data = [];
            $metaran_sekarang = 0;
            $metaran_lalu = 0;
            $metaran_tagihan = 0;
            $tagihan = 0;
    
            //Cari pembayaran bulan ini
            $bay = "SELECT * FROM pembayaran 
                LEFT JOIN pemasangan ON pembayaran.id_pemasangan = pemasangan.id_pemasangan 
                WHERE MONTH(pembayaran.tgl_bayar) = '" . date('m') . "' 
                AND YEAR(pembayaran.tgl_bayar) = '" . date('Y') . "' 
                AND pemasangan.id_pelanggan ='" . $data_pelanggan[0]['id_pelanggan'] . "'  
                AND pembayaran.ket_pembayaran LIKE '%pencatatan_penggunaan%'
                AND pembayaran.status = 'tervalidasi'
                ";
    
            // echo $metaran_tagihan;
            $bayar = QueryOnedata($bay);
            if ($bayar->num_rows < 1) { //jika tidak ada pembayaran bulan ini
    
                $catatan = "SELECT * FROM pencatatan_penggunaan 
                    LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan 
                    WHERE MONTH(pencatatan_penggunaan.tanggal) = '" . date('m') . "' 
                    AND YEAR(pencatatan_penggunaan.tanggal) = '" . date('Y') . "' 
                    AND pemasangan.id_pelanggan ='" . $data_pelanggan[0]['id_pelanggan'] . "' 
                     ";
                $catatan_bulan_ini = QueryOnedata($catatan);
    
                if ($catatan_bulan_ini->num_rows > 0) { //jika ada catatan bulan ini
                    array_push($data, $catatan_bulan_ini->fetch_assoc());
                    $metaran_sekarang = intval($data[0]['nilai_stand_meter']);
                    $metaran_tagihan = $metaran_sekarang;
                    $catatan_bulan_lalu = QueryOnedata("SELECT * FROM pencatatan_penggunaan WHERE tanggal < '" . $data[0]['tanggal'] . "' AND id_pemasangan = '" . $data[0]['id_pemasangan'] . "' ORDER BY tanggal DESC");
    
                    if ($catatan_bulan_lalu->num_rows > 0) { // Jika Bulan lalu juga ada catatan
                        array_push($data, $catatan_bulan_lalu->fetch_assoc());
                        $metaran_lalu = intval($data[1]['nilai_stand_meter']);
                        $metaran_tagihan = $metaran_tagihan - $metaran_lalu;
                    }
                }
            }
            //================ PERHITUNGAN BIAYA BULANAN ================     
        ?>
        <?php
        if ($biaya_pemasangan > 0) {
        ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php
                                    $query_check_upload = QueryOnedata("SELECT * FROM pembayaran WHERE status = 'upload' AND id_pemasangan = '" . $pemasangan[0]['id_pemasangan'] . "' AND ket_pembayaran LIKE '%pemasangan%' ");
                                    if ($query_check_upload->num_rows > 0) { ?>
                                        Pembayaran Pemasangan Alat <br> <span style="color: black;"> ( dalam prosess Validasi ) </span>
                                    <?php } else { ?>
                                        <a href="<?= $url ?>/app/pembayaran/tambah.php?jenis_pembayaran=pemasangan:;<?= $pemasangan[0]['tgl_realisasi_pekerjaan'] ?>:;<?= ($biaya_pemasangan) ?>">
                                            Tagihan Pemasangan Alat
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= intToRupiah(($biaya_pemasangan)) ?></div>
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
        <?php
        if ($metaran_tagihan > 0) {
        ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php
                                    $ghyj = "SELECT * FROM pembayaran WHERE  status = 'upload' AND id_pemasangan = '" . $pemasangan[0]['id_pemasangan'] . "' AND MONTH(tgl_bayar) = '" . date('m') . "' AND ket_pembayaran LIKE '%pencatatan_penggunaan%'  ";
                                    $check_pemb_status = QueryOnedata($ghyj);
                                    if ($check_pemb_status->num_rows > 0) { ?>
                                        Pembayaran Tagihan (dalam proses validasi)
                                    <?php } else { ?>
                                        <a href="<?= $url ?>/app/pembayaran/tambah.php?jenis_pembayaran=pencatatan_penggunaan:;<?= $data[0]['tanggal'] ?>:;<?= (($metaran_tagihan * 800) + 5000) ?>">
                                        Tagihan Penggunaan
                                    </a>
                                    <?php } ?>
                                    
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= intToRupiah((($metaran_tagihan * 800) + 5000)) ?></div>
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
        <?php
        }
        ?>

    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>