<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pemasangan page</h1>
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
        <a href='<?= $url ?>/app/laporan_pemasangan/export.php' class='d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm'><i class='fas fa-file-export fa-sm text-white-50'></i> Export data pemasangan</a>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pemasangan
            </h5>
        </div>
        <div class='card-body table-responsive'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>PELANGGAN</th>
                        <th>PETUGAS LAPANGAN</th>
                        <th>TGL PERMINTAAN PEMASANGAN</th>
                        <th>TGL REALISASI PEKERJAAN</th>
                        <th>TGL TAGIHAN</th>
                        <th>BIAYA</th>
                        <th>STATUS PEMASANGAN</th>    
                    </tr>
                </thead>
                <tbody>
                <?php
                    $pema = 'SELECT * FROM pemasangan ORDER BY id_pemasangan DESC';

                    foreach (QueryManyData($pema) as $row) {
                        $pelanggan = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = '.$row['id_pelanggan'].'')->fetch_assoc();  
                        $user = QueryOnedata('SELECT * FROM user where id_user = '.$row['id_user'].'')->fetch_assoc();  
                    ?>
                        <tr>
                            <td><?= $pelanggan['nm_pelanggan'] ?></td>
                            <td><?= $user['nm_pengguna'] ?></td>
                            <td><?= DateNUll($row['tgl_permintaan_pemasangan']) ?></td>
                            <td><?= DateNUll($row['tgl_realisasi_pekerjaan']) ?></td>
                            <td><?= DateNUll($row['tgl_tagihan']) ?></td>
                            <td><?= intToRupiah($row['biaya']) ?></td>
                            <td><?= $row['status_pemasangan'] ?></td>

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