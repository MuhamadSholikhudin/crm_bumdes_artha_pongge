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
    <?php if ($_SESSION['level'] == "pelanggan") { 
        
        // menampilkan data pencatatan bulan ini
        $pelanggan = QueryOnedata("SELECT * FROM pelanggan WHERE id_user ='".$_SESSION['id_user']."' ");

        $catatan = "SELECT * FROM pencatatan_penggunaan 
            LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan 
            WHERE MONTH(pencatatan_penggunaan.tanggal) = '" . date('m') . "' AND YEAR(pencatatan_penggunaan.tanggal) = '" . date('Y') . "' AND pemasangan.id_pelanggan ='".$pelanggan->fetch_assoc()['id_pelanggan']."'  ";
        
        $catatan_bulan_ini = QueryOnedata($catatan);
        $data = [];
        $metaran_sekarang = 0;
        $metaran_lalu = 0;
        $metaran_tagihan = 0;
        $tagihan = 0;
        
        if ($catatan_bulan_ini->num_rows > 0) { //jika ada catatan bulan ini
            array_push($data, $catatan_bulan_ini->fetch_assoc());
            $metaran_sekarang = intval($data[0]['nilai_stand_meter']);
            $metaran_tagihan = $metaran_sekarang;
            $catatan_bulan_lalu = QueryOnedata("SELECT * FROM pencatatan_penggunaan WHERE tanggal < '" . $data[0]['tanggal'] . "' ORDER BY tanggal DESC");
            
            if ($catatan_bulan_lalu->num_rows > 0) { // Jika Bulan lalu juga ada catatan
                array_push($data, $catatan_bulan_lalu->fetch_assoc());
                $metaran_lalu = intval($data[1]['nilai_stand_meter']);
                $metaran_tagihan = $metaran_tagihan - $metaran_lalu;
            }
        }
        
        ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>INFO !</strong> 
                Perhitungan penggunaan pembayaran seprti berikut = ( [Nilai Meteran bulan bulan sekarang] - [Nilai Meteran bulan bulan sebelumnya] ) * 800/m3 + 5000[biaya operasional].
                <br>
                Pembayaran bisa di transfer ke Rekening Bank BNI : <span id="textToCopy" onclick="copyText()" > <i class="fa fa-copy" style="color:azure;"></i> 88888888</span>
                <?php if($metaran_tagihan > 0){ ?>
                    <br>
                    Nilai Meteran bulan sebelumnya : <?= $metaran_lalu ?>,
                    Nilai Meteran bulan sekarang : <?= $metaran_sekarang ?>,
                    Tagihan anda : 
                <?php echo $tagihan = ($metaran_tagihan * 800 + 5000); } ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            function copyText() {
                // Ambil teks dari elemen span
                var textToCopy = document.getElementById("textToCopy").innerText;
                // Gunakan navigator.clipboard untuk menyalin teks
                navigator.clipboard.writeText(textToCopy).then(function() {
                    // Tampilkan pesan berhasil
                    alert("Teks berhasil disalin : 88888888");
                }, function(err) {
                    // Tampilkan pesan jika gagal
                    alert("Gagal menyalin teks.");
                });
            }
        </script>

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
                        <th>PEMASANGAN</th>
                        <th>TGL BAYAR</th>
                        <th>NOMINAL</th>
                        <th>KETERANGAN PEMBAYARAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
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
                            WHERE pelanggan.id_user = "' . $_SESSION['id_user'] . '"   ORDER BY pembayaran.id_pembayaran DESC';
                    }
                    foreach (QueryManyData($pembayaran) as $row) {
                    ?>
                        <tr>
                            <td><?= $row['id_pembayaran'] ?></td>
                            <td>
                                <?= $row['id_pemasangan'] . ' // ' .$row['nm_pelanggan'] . ' // ' . $row['tgl_realisasi_pekerjaan'] ?>
                            </td>
                            <td><?= $row['tgl_bayar'] ?></td>
                            <td><?= intToRupiah($row['nominal']) ?></td>
                            <td><?= $row['ket_pembayaran'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <?php if ($_SESSION['level'] == "pelanggan" && $row['status'] == 'upload') { ?>
                                    <a href='<?= $url ?>/app/pembayaran/edit.php?id_pembayaran=<?= $row['id_pembayaran'] ?>' pembayaran class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <button onclick="ConfirmDelete('<?= $row['id_pembayaran'] ?>')" class='btn btn-danger btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text'>hapus</span>
                                    </button>
                                <?php } else if ($_SESSION['level'] == "petugas bumdes") { ?>
                                <?php  if ($row['status'] == 'upload') { ?>
                                    <a href='<?= $url ?>/aksi/pembayaran.php?id_pembayaran=<?= $row['id_pembayaran'] ?>&status=tervalidasi' pembayaran class='btn btn-primary btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check-double'></i>
                                        </span>
                                        <span class='text'>Konfirmasi</span>
                                    </a>
                                <?php } ?>
                                    <a href='<?= $url ?>/app/pembayaran/edit.php?id_pembayaran=<?= $row['id_pembayaran'] ?>' pembayaran class='btn btn-success btn-icon-split btn-sm'>
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
                window.location.href = '<?= $url ?>/aksi/pembayaran.php?id_pembayaran=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>