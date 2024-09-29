<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Berkas Pemasangan page</h1>
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
        <a href='<?= $url ?>/app/berkas_pemasangan/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data berkas pemasangan</a>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Berkas Pemasangan
            </h5>
        </div>
        <div class='card-body'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>ID_PEMASANGAN</th>
                        <th>NM_BERKAS</th>
                        <th>FOTO_BERKAS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (QueryManyData('SELECT * FROM berkas_pemasangan') as $row) {
                        $pemasangan = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan where pemasangan.id_pemasangan = ' . $row['id_pemasangan'] . '')->fetch_assoc();
                    ?>
                        <tr>
                            <td><?= $pemasangan['nm_pelanggan'] ?></td>
                            <td><?= $row['nm_berkas'] ?></td>
                            <td><?= $row['foto_berkas'] ?></td>
                            <td>

                                <?php if ($_SESSION['level'] == "petugas lapangan") { ?>
                                    <a href='<?= $url ?>/app/berkas_pemasangan/edit.php?id_berkas_pemasangan=<?= $row['id_berkas_pemasangan'] ?>' berkas_pemasangan class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete(<?= $row['id_berkas_pemasangan'] ?>)" class='btn btn-danger btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text'>hapus</span>
                                    </button>
                                <?php } elseif ($_SESSION['level'] == "pelanggan") {  ?>
                                    <a href='<?= $url ?>/app/pemasangan/upload.php?id_pemasangan=<?= $row['id_pemasangan'] ?>' class='btn btn-warning btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-eye'></i>
                                        </span>
                                        <span class='text'>foto</span>
                                    </a>
                                <?php  } ?>
                            </td>
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
                window.location.href = '<?= $url ?>/aksi/berkas_pemasangan.php?id_berkas_pemasangan=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>