<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Layanan page</h1>
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
    <div class='d-sm-flex align-items-center justify-content-between mb-4'>
    <?php if ($_SESSION['level'] == "ketua unit air") { ?>
        <a href='<?= $url ?>/app/layanan/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data layanan</a>
    <?php } ?>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Layanan
            </h5>
        </div>
        <div class='card-body'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>NAMA LAYANAN</th>
                        <th>KETERANGAN LAYANAN</th>
                        <th>HARGA LAYANAN</th>
                        <th>JENIS LAYANAN</th>
                        <?php if ($_SESSION['level'] == "ketua unit air") { ?>
                            <th>AKSI</th>
                        <?php } ?>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (QueryManyData('SELECT * FROM layanan') as $row) {
                    ?>
                        <tr>
                            <td><?= $row['nm_layanan'] ?></td>
                            <td><?= $row['ket_layanan'] ?></td>
                            <td><?= intToRupiah($row['harga_layanan']) ?></td>
                            <td><?= $row['jenis_layanan'] ?></td>
                            <?php if ($_SESSION['level'] == "ketua unit air") { ?>
                            <td>
                                <a href='<?= $url ?>/app/layanan/edit.php?id_layanan=<?= $row['id_layanan'] ?>' layanan class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete(<?= $row['id_layanan'] ?>)" class='btn btn-danger btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text'>hapus</span>
                                    </button>
                                </td>
                            <?php } ?>


                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function ConfirmDelete(id) {
            let text = 'Apakah Anda Yakin Ingin Menghapus data!\n OK or Cancel.';
            if (confirm(text) == true) {
                text = 'You pressed OK!';
                window.location.href = '<?= $url ?>/aksi/layanan.php?id_layanan=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>