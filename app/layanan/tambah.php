<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Layanan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Layanan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/layanan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputnm_layanan' class='col-sm-2 col-form-label'>Nama Layanan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputnm_layanan' name='nm_layanan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_layanan' class='col-sm-2 col-form-label'>Keterangan Layanan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputket_layanan' name='ket_layanan' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputharga layanan' class='col-sm-2 col-form-label'>Harga Layanan</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputharga layanan' name='harga_layanan' required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputjenis layanan" class="col-sm-2 col-form-label">Jenis Layanan
                    </label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jenis_layanan" id="inputjenis_layanan">
                            <?php
                            $jenis_layanan = ['Pemasangan Baru', 'Biaya Pemakaian', 'Perawatan'];
                            foreach ($jenis_layanan    as $val) { ?>
                                <option value="<?= $val ?>"><?= $val ?></option>
                            <?php
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
                        <button type='submit' name='simpanlayanan' value='simpanlayanan' class='btn btn-primary btn-user btn-block'>
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