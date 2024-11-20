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
    <?php if ($_SESSION['level'] == "petugas lapangan") { ?>
        <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <a href='<?= $url ?>/app/pencatatan_penggunaan/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data pencatatan penggunaan</a>
        </div>
    <?php } ?>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pencatatan Penggunaan
            </h5>
        </div>
        <div class='card-body'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>PEMASANGAN</th>
                        <th>NOMOR PASANG</th>
                        <th>NILAI STAND METER (A)</th>
                        <th>NILAI STAND METER (BULAN SEBELUMNYA) (B)</th>
                        <th>PENGGUNAAN = (A) - (B)</th>
                        <th>TANGGAL PENCATATAN</th>
                        <th>FOTO STAND METER</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pencatat = 'SELECT  pemasangan.id_pelanggan, pencatatan_penggunaan.nomor_pasang, pencatatan_penggunaan.nilai_stand_meter, pencatatan_penggunaan.tanggal, pencatatan_penggunaan.foto_stand_meter, pencatatan_penggunaan.id_pencatatan FROM pencatatan_penggunaan 
                    LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan ORDER BY pemasangan.id_pemasangan DESC';
                    if ($_SESSION['level'] == "pelanggan") {
                        $pel = QueryOnedata('SELECT * FROM pelanggan where id_user = "' . $_SESSION['id_user'] . '"')->fetch_assoc();
                        $pencatat = 'SELECT  pemasangan.id_pelanggan, pencatatan_penggunaan.nomor_pasang, pencatatan_penggunaan.nilai_stand_meter, pencatatan_penggunaan.tanggal, pencatatan_penggunaan.foto_stand_meter, pencatatan_penggunaan.id_pencatatan FROM
                         pencatatan_penggunaan LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan WHERE pemasangan.id_pelanggan = "' . $pel['id_pelanggan'] . '" ORDER BY pemasangan.id_pemasangan DESC';
                    }
                    foreach (QueryManyData($pencatat) as $row) {
                        $pel = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = "' . $row['id_pelanggan'] . '"')->fetch_assoc();
                    ?>
                        <tr>
                            <td><?= $pel['nm_pelanggan'] ?></td>
                            <td><?= $row['nomor_pasang'] ?></td>
                            <td><?= $row['nilai_stand_meter'] ?></td>
                            <td>
                                <?php
                                $query_nilai_stand_meter_sebelumnya = 'SELECT * FROM pencatatan_penggunaan WHERE id_pemasangan = "' . $row['nomor_pasang'] . '" AND tanggal < "' . $row['tanggal'] . '" ORDER BY id_pencatatan DESC LIMIT 1';
                                $nilai_stand_meter_sebelumnya = QueryOnedata($query_nilai_stand_meter_sebelumnya);
                                $stand_bulan_lalu = 0;
                                if ($nilai_stand_meter_sebelumnya->num_rows > 0) {
                                    $stand_bulan_lalu = $nilai_stand_meter_sebelumnya->fetch_assoc()['nilai_stand_meter'];
                                }
                                ?>
                                <?= $stand_bulan_lalu ?>
                            </td>
                            <td><?= ($row['nilai_stand_meter'] - $stand_bulan_lalu) ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td>
                                <img src="<?= $url . "/foto/foto_stand_meter/" . $row['foto_stand_meter'] ?> ?>" alt="" width="50" height="50">
                            </td>
                            <td>
                                <a href='<?= $url ?>/app/pencatatan_penggunaan/lihat.php?id_pencatatan=<?= $row['id_pencatatan'] ?>' class='btn btn-info btn-icon-split btn-sm'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-eye'></i>
                                    </span>
                                    <span class='text'>lihat</span>
                                </a>
                                <?php if ($_SESSION['level'] == "petugas lapangan") { ?>
                                    <a href='<?= $url ?>/app/pencatatan_penggunaan/edit.php?id_pencatatan=<?= $row['id_pencatatan'] ?>' class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete('<?= $row['id_pencatatan'] ?>')" class='btn btn-danger btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text'>hapus</span>
                                    </button>
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
                window.location.href = '<?= $url ?>/aksi/pencatatan_penggunaan.php?id_pencatatan=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>