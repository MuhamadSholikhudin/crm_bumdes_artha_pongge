<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pembayaran page</h1>
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
    <?php if ($_SESSION['level'] == "petugas bumdes") { ?>
        <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <a href='<?= $url ?>/app/pembayaran/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data pembayaran</a>
        </div>
    <?php } ?>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pembayaran
            </h5>
        </div>
        <div class='card-body'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>ID PEMBAYARAN</th>
                        <th>ID PEMASANGAN</th>
                        <th>TGL BAYAR</th>
                        <th>NOMINAL</th>
                        <th>KET_PEMBAYARAN</th>
                        <th>STATUS</th>
                        <?php if ($_SESSION['level'] == "petugas bumdes") { ?>
                            <th>AKSI</th>
                        <?php } ?>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pembayaran = 'SELECT pembayaran.id_pembayaran , pembayaran.id_pemasangan , pembayaran.nominal, pembayaran.ket_pembayaran, pembayaran.tgl_bayar, pembayaran.status, pemasangan.tgl_realisasi_pekerjaan, pelanggan.nm_pelanggan  FROM pembayaran 
                        LEFT JOIN pemasangan ON pembayaran.id_pemasangan = pemasangan.id_pemasangan 
                        LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan 
                        ORDER BY pembayaran.id_pembayaran DESC                        
                        ';
                    if ($_SESSION['level'] == 'pelanggan') {
                        $pembayaran = 'SELECT pembayaran.id_pembayaran , pembayaran.id_pemasangan , pembayaran.nominal, pembayaran.ket_pembayaran, pembayaran.tgl_bayar, pembayaran.status, pemasangan.tgl_realisasi_pekerjaan, pelanggan.nm_pelanggan  FROM pembayaran 
                            LEFT JOIN pemasangan ON pembayaran.id_pemasangan = pemasangan.id_pemasangan 
                            LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan 
                            WHERE pelanggan.id_user = "' . $_SESSION['id_user'] . '"   ORDER BY pembayaran.id_pembayaran DESC                            ';
                    }
                    foreach (QueryManyData($pembayaran) as $row) {
                    ?>
                        <tr>
                            <td><?= $row['id_pembayaran'] ?></td>

                            <td>
                                <?= $row['nm_pelanggan'] . ' // ' . $row['tgl_realisasi_pekerjaan'] ?>
                            </td>
                            <td><?= $row['tgl_bayar'] ?></td>
                            <td><?= intToRupiah($row['nominal']) ?></td>
                            <td><?= $row['ket_pembayaran'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <?php if ($_SESSION['level'] == "petugas bumdes") { ?>
                                <td><a href='<?= $url ?>/app/pembayaran/edit.php?id_pembayaran=<?= $row['id_pembayaran'] ?>' pembayaran class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete(<?= $row['id_pembayaran'] ?>)" class='btn btn-danger btn-icon-split btn-sm'>
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
                window.location.href = '<?= $url ?>/aksi/pembayaran.php?id_pembayaran=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>