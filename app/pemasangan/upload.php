<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$pemasangan = QueryOnedata('SELECT * FROM berkas_pemasangan WHERE id_pemasangan = "' . $_GET['id_pemasangan'] . '"')->fetch_assoc();
$berkas_pemasangan = QueryOnedata('SELECT * FROM berkas_pemasangan WHERE id_pemasangan = "' . $_GET['id_pemasangan'] . '"')->fetch_assoc();
if ($berkas_pemasangan == NULL) {
    $berkas_pemasangan = [
        'id_berkas_pemasangan' => NULL,
        'nm_berkas' => NULL,
        'foto_berkas' => NULL,
    ];

    // BP00
    $id = 1;
    $terahir_berkas_pemasangan = QueryOnedata("SELECT * FROM berkas_pemasangan ORDER BY id_berkas_pemasangan DESC ");                  
    if($terahir_berkas_pemasangan->num_rows > 0 ){
        $id = Rplc("BP", $terahir_berkas_pemasangan->fetch_assoc()['id_berkas_pemasangan']) + $id;
    }
    $berkas_pemasangan['id_berkas_pemasangan'] = 'BP00'.$id;
}
?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Berkas Pemasangan page</h1>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Berkas Pemasangan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pemasangan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Id Pemasangan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' value='<?= $_GET['id_pemasangan']; ?>' readonly>
                        <input type='hidden' class='form-control' id='inputid_pemasangan' name='id_pemasangan' value='<?= $_GET['id_pemasangan']; ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputberkas_pemasangan' class='col-sm-2 col-form-label'>Id Berkas Pemasangan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputberkas_pemasangan' name='id_berkas_pemasangan' value='<?= $berkas_pemasangan['id_berkas_pemasangan'] ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnm_berkas' class='col-sm-2 col-form-label'>Nama Berkas</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_berkas' name='nm_berkas' value='<?= $berkas_pemasangan['nm_berkas']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_berkas' class='col-sm-2 col-form-label'>Foto Berkas</label>
                    <div class='col-sm-10'>
                        <img src="<?= $url ?>/foto/foto_berkas/<?= $berkas_pemasangan['foto_berkas']; ?>" alt="" width="100%" accept="image/png, image/jpg, image/jpeg">
                        <input type='file' class='form-control' id='inputfoto_berkas' name='foto_berkas'>
                        <input type='hidden' class='form-control' id='inputfoto_berkas' name='foto_berkas_old' value='<?= $berkas_pemasangan['foto_berkas']; ?>' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pemasangan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                    <?php if ($_SESSION['level'] != "pelanggan") { ?>
                        <button type='submit' name='uploadberkas_pemasangan' value='uploadberkas_pemasangan' class='btn btn-success btn-user btn-block'>
                            <i class='fas fa-save'></i> UPDATE
                        </button>
                    <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>