<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pengaduan page</h1>
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
        <a href='<?= $url ?>/app/laporan_pengaduan/export.php' class='d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm'><i class='fas fa-file-export fa-sm text-white-50'></i> Export data pengaduan</a>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pengaduan
            </h5>
        </div>
        <div class='card-body table-responsive'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>ID PEMASANGAN</th>
                        <th>ID USER</th>
                        <th>TGL PENGADUAN</th>
                        <th>TGL PERBAIKAN</th>
                        <th>KET KENDALA</th>
                        <th>FOTO KENDALA</th>
                        <th>STATUS PENGADUAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pengaduan = 'SELECT * FROM pengaduan 
                        LEFT JOIN pemasangan ON pengaduan.id_pemasangan = pemasangan.id_pemasangan 
                        LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan';
                    if ($_SESSION['level'] == 'pelanggan') {
                        $pengaduan = 'SELECT * FROM pengaduan
                        LEFT JOIN pemasangan ON pengaduan.id_pemasangan = pemasangan.id_pemasangan 
                        LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan';
                    }
                    foreach (QueryManyData($pengaduan) as $row) {
                        $pemasangan = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
                        $user = QueryOnedata('SELECT * FROM user where id_user = "' . $row['id_user'] . '"')->fetch_assoc();
                    ?>
                        <tr>
                            <td><?= $pemasangan['nm_pelanggan'] ?></td>
                            <td><?= $user['nm_pengguna'] ?></td>
                            <td><?= DateNUll($row['tgl_pengaduan']) ?></td>
                            <td><?= DateNUll($row['tgl_perbaikan']) ?></td>
                            <td><?= $row['ket_kendala'] ?></td>
                            <td><?= $row['foto_kendala'] ?></td>
                            <td><?= $row['status_pengaduan'] ?></td>
                            <td>
                                <?php if ($_SESSION['level'] == 'pelanggan') {
                                    if($row['status_pengaduan'] == 'Pengaduan'){
                                    ?>
                                    <a href='<?= $url ?>/app/pengaduan/edit.php?id_pengaduan=<?= $row['id_pengaduan'] ?>' pengaduan class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete(<?= $row['id_pengaduan'] ?>)" class='btn btn-danger btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text'>hapus</span>
                                    </button>
                                <?php }
                             }elseif ($_SESSION['level'] == 'petugas lapangan') { ?>
                                    <a href='<?= $url ?>/app/pengaduan/edit.php?id_pengaduan=<?= $row['id_pengaduan'] ?>' pengaduan class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                <?php } ?>

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
                window.location.href = '<?= $url ?>/aksi/pengaduan.php?id_pengaduan=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>