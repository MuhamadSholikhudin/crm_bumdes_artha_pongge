<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pengaduan page</h1>
    <?php if (isset($_SESSION['message'])) { ?>
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Success !</strong> <?= $_SESSION['message'] ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    <?php unset($_SESSION['message']);
    } ?>
    <?php if ($_SESSION['level'] == 'pelanggan') { ?>
        <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <a href='<?= $url ?>/app/pengaduan/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data pengaduan</a>
        </div>
    <?php  } ?>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Data Pengaduan Saya
            </h5>
        </div>
        <div class='card-body table-responsive'>
            <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                <thead>
                    <tr class='text-center'>
                        <th>PEMASANGAN</th>
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
                        LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan 
                        LEFT JOIN user ON pelanggan.id_user = user.id_user 
                        WHERE user.id_user = "' . $_SESSION['id_user'] . '"';
                    }
                    foreach (QueryManyData($pengaduan) as $row) {
                        $pemasangan = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
                        $user = QueryOnedata('SELECT * FROM user where id_user = "' . $row['id_user'] . '"')->fetch_assoc();
                    ?>
                        <tr>
                            <?php if ($_SESSION['level'] == "petugas lapangan") { ?>
                                <td> <a href="<?= $url ?>/app/pengaduan/lihat_alamat.php?id_pelanggan=<?= $pemasangan['id_pelanggan'] ?>"><?= $pemasangan['nm_pelanggan'] ?></a> </td>
                            <?php } else { ?>
                                <td><?= $pemasangan['nm_pelanggan'] ?></td>
                            <?php } ?>
                            <td><?= DateNUll($row['tgl_pengaduan']) ?></td>
                            <td><?= DateNUll($row['tgl_perbaikan']) ?></td>
                            <td><?= $row['ket_kendala'] ?></td>
                            <td>
                                <img src="<?= $url . "/foto/foto_kendala/" . $row['foto_kendala'] ?>" alt="" width="50" height="50">
                            </td>
                            <td><?= $row['status_pengaduan'] ?></td>
                            <td>
                                <?php if ($_SESSION['level'] == 'pelanggan') {
                                    if ($row['status_pengaduan'] == 'Pengaduan') {
                                ?>
                                        <a href='<?= $url ?>/app/pengaduan/edit.php?id_pengaduan=<?= $row['id_pengaduan'] ?>' pengaduan class='btn btn-success btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-edit'></i>
                                            </span>
                                            <span class='text'>edit</span>
                                        </a>
                                        <button onclick="ConfirmDelete('<?= $row['id_pengaduan'] ?>')" class='btn btn-danger btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-trash'></i>
                                            </span>
                                            <span class='text'>hapus</span>
                                        </button>
                                    <?php }
                                } elseif ($_SESSION['level'] == 'petugas lapangan') { ?>
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
    <?php if ($_SESSION['level'] == 'pelanggan') { ?>
        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
                <h5 class='m-0 font-weight-bold text-primary text-center'>
                    Data Pengaduan Orang Lain
                </h5>
            </div>
            <div class='card-body table-responsive'>
                <table id='example' class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>
                    <thead>
                        <tr class='text-center'>
                            <th>PEMASANGAN</th>
                            <th>TGL PENGADUAN</th>
                            <th>TGL PERBAIKAN</th>
                            <th>KET KENDALA</th>
                            <th>FOTO KENDALA</th>
                            <th>STATUS PENGADUAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $pengaduan_x = 'SELECT * FROM pengaduan
                        LEFT JOIN pemasangan ON pengaduan.id_pemasangan = pemasangan.id_pemasangan 
                        LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan 
                        LEFT JOIN user ON pelanggan.id_user = user.id_user 
                        WHERE user.id_user != "' . $_SESSION['id_user'] . '"';
                        foreach (QueryManyData($pengaduan_x) as $row) {
                            $pemasangan = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
                            $user = QueryOnedata('SELECT * FROM user where id_user = "' . $row['id_user'] . '"')->fetch_assoc();
                        ?>
                            <tr>
                                <?php if ($_SESSION['level'] == "petugas lapangan") { ?>
                                    <td> <a href="<?= $url ?>/app/pengaduan/lihat_alamat.php?id_pelanggan=<?= $pemasangan['id_pelanggan'] ?>"><?= $pemasangan['nm_pelanggan'] ?></a> </td>
                                <?php } else { ?>
                                    <td><?= $pemasangan['nm_pelanggan'] ?></td>
                                <?php } ?>
                                <td><?= DateNUll($row['tgl_pengaduan']) ?></td>
                                <td><?= DateNUll($row['tgl_perbaikan']) ?></td>
                                <td><?= $row['ket_kendala'] ?></td>
                                <td>
                                    <img src="<?= $url . "/foto/foto_kendala/" . $row['foto_kendala'] ?>" alt="" width="50" height="50">
                                </td>
                                <td><?= $row['status_pengaduan'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
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