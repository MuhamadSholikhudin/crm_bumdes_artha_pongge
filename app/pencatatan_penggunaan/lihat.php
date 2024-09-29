<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$pencatatan_penggunaan = QueryOnedata('SELECT * FROM pencatatan_penggunaan WHERE id_pencatatan = ' . $_GET['id_pencatatan'] . '')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pencatatan Penggunaan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Pencatatan_Penggunaan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pencatatan_penggunaan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row' style="display: none;">
                    <label for='inputid_pencatatan' class='col-sm-2 col-form-label'>Id_Pencatatan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputid_pencatatan' name='id_pencatatan' value='<?= $pencatatan_penggunaan['id_pencatatan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Id_Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan' readonly>
                            <?php
                            $pem = 'SELECT pemasangan.id_pemasangan, pemasangan.tgl_permintaan_pemasangan, pemasangan.id_pemasangan, pelanggan.nm_pelanggan FROM pemasangan LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan';
                            $pemasangans = QueryManyData($pem);
                            foreach ($pemasangans  as  $row) {
                                if ($pencatatan_penggunaan['id_pemasangan'] ==  $row['id_pemasangan']) { ?>
                                    <option value='<?= $row['id_pemasangan'] ?>' selected><?= $row['nm_pelanggan'] ?> // <?= $row['tgl_permintaan_pemasangan'] ?></option>
                                <?php } else {
                                ?><option value='<?= $row['id_pemasangan'] ?>'><?= $row['nm_pelanggan'] ?> // <?= $row['tgl_permintaan_pemasangan'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnomor_pasang' class='col-sm-2 col-form-label'>Nomor Pasang</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnomor_pasang' name='nomor_pasang' value='<?= $pencatatan_penggunaan['nomor_pasang']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnilai_stand_meter' class='col-sm-2 col-form-label'>Nilai Stand Meter</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputnilai_stand_meter' name='nilai_stand_meter' value='<?= $pencatatan_penggunaan['nilai_stand_meter']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_stand_meter' class='col-sm-2 col-form-label'>Foto Stand Meter</label>
                    <div class='col-sm-10'>
                        <img src="<?= $url."/foto/foto_stand_meter/". $pencatatan_penggunaan['foto_stand_meter']; ?>" alt="<?= $url."/foto/foto_stand_meter/". $pencatatan_penggunaan['foto_stand_meter']; ?>" width="100%">
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        
                    </div>
                    <div class='col-sm-10'>
                    <a href='<?= $url ?>/app/pencatatan_penggunaan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>