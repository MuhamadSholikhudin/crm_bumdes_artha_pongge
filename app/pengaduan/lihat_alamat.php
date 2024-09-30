<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$pelanggan = QueryOnedata('SELECT * FROM pelanggan WHERE id_pelanggan = "' .$_GET['id_pelanggan'] .'"')->fetch_assoc();
$alamat_pelanggan = QueryOnedata('SELECT * FROM alamat_pelanggan WHERE id_pelanggan = "' .$_GET['id_pelanggan'] .'"')->fetch_assoc();
if ($alamat_pelanggan == null) {
    $alamat_pelanggan = [
        'ket_alamat' => null,
        'lat_alamat' => null,
        'long_alamat' => null,
    ];
}
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Alamat Pelanggan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Alamat Pelanggan
            </h5>
        </div>
        <div class='card-body'>
                <div class='mb-3 row'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Pelanggan </label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputid_pelanggan' name='id_pelanggan' value='<?= $pelanggan['nm_pelanggan'] ?>' readonly>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_alamat' class='col-sm-2 col-form-label'>Keterangan Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_alamat' name='ket_alamat' readonly><?= $alamat_pelanggan['ket_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'></label>
                    <div class='col-sm-10' id="showmap" >
                        <iframe src="https://www.google.com/maps?q=<?= $alamat_pelanggan['lat_alamat'] ?>,<?= $alamat_pelanggan['long_alamat'] ?>&hl=es;z=14&output=embed" frameborder="0" style='width:100%;'></iframe>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pengaduan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        
                    </div>
                </div>
        </div>
    </div>
</div>

<?php include_once '../template/footer.php'; ?>
