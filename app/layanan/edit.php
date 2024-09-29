<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php


$layanan = QueryOnedata('SELECT * FROM layanan WHERE id_layanan = ' . $_GET['id_layanan'] . '')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Layanan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Layanan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/layanan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_layanan' class='col-sm-2 col-form-label'>Id_Layanan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputid_layanan' name='id_layanan' value='<?= $layanan['id_layanan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnm_layanan' class='col-sm-2 col-form-label'>Nm_Layanan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_layanan' name='nm_layanan' value='<?= $layanan['nm_layanan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_layanan' class='col-sm-2 col-form-label'>Ket_Layanan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputket_layanan' name='ket_layanan' value='<?= $layanan['ket_layanan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputharga_layanan' class='col-sm-2 col-form-label'>Harga Layanan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputharga_layanan' name='harga_layanan' value='<?= $layanan['harga_layanan']; ?>' required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputjenis_layanan" class="col-sm-2 col-form-label">Jenis Layanan
                    </label>
                    <div class="col-sm-10">

                        <select class="form-control" name="jenis_layanan" id="inputjenis_layanan">
                            <?php
                            $jenis_layanan = ['Pemasangan Baru', 'Biaya Pemakaian', 'Perawatan'];
                            foreach ($jenis_layanan    as $val) { ?> <?php
                                        if ($val == $layanan['jenis_layanan']) { ?>
                                    <option value='<?= $val ?>' selected><?= $val ?></option>
                                <?php } else { ?> as $val) {
                                    ?>
                                    <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
                                        }
                                    }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/layanan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updatelayanan' value='updatelayanan' class='btn btn-success btn-user btn-block'>
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