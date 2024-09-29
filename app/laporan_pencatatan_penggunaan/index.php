<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pencatatan Penggunaan page</h1>
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
        <a href='<?= $url ?>/app/laporan_pencatatan_penggunaan/export.php' class='d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm'><i class='fas fa-file-export fa-sm text-white-50'></i> Export data pencatatan penggunaan</a>
    </div>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pencatatan Penggunaan
            </h5>
        </div>
        <div class='card-body table-responsive'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>PEMASANGAN</th>
                        <th>NOMOR PASANG</th>
                        <th>NILAI STAND METER</th>
                        <th>FOTO STAND METER</th>    
                    </tr>
                </thead>
                <tbody>
                <?php
                    $pencatat = 'SELECT  pemasangan.id_pelanggan, pencatatan_penggunaan.nomor_pasang, pencatatan_penggunaan.nilai_stand_meter, pencatatan_penggunaan.foto_stand_meter, pencatatan_penggunaan.id_pencatatan FROM pencatatan_penggunaan 
                    LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan ORDER BY pemasangan.id_pemasangan DESC';
                    foreach (QueryManyData($pencatat) as $row) {
                        $pel = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = '.$row['id_pelanggan'].'')->fetch_assoc();  
                    ?>
                        <tr>
                            <td>
                                <?= $pel['nm_pelanggan'] ?>
                            </td>
                            <td><?= $row['nomor_pasang'] ?></td>
                            <td><?= $row['nilai_stand_meter'] ?></td>
                            <td><?= $row['foto_stand_meter'] ?></td>
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