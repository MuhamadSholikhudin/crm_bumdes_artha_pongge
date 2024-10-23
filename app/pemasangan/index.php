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
    <?php 
        $pema = 'SELECT * FROM pemasangan ORDER BY id_pemasangan DESC';
        if($_SESSION['level'] == "pelanggan"){
            $pel = QueryOnedata('SELECT * FROM pelanggan where id_user = "'.$_SESSION['id_user'].'"')->fetch_assoc();  
            $pema = 'SELECT * FROM pemasangan where id_pelanggan = "'.$pel['id_pelanggan'].'" ORDER BY id_pemasangan DESC';
        }elseif($_SESSION['level'] == "petugas lapangan"){
            $pema = 'SELECT * FROM pemasangan where status_pemasangan = "Proses" OR  status_pemasangan = "Realisasi"   ORDER BY id_pemasangan DESC';
        }
    ?>
    <div class='d-sm-flex align-items-center justify-content-between mb-4'>    
    <?php if ($_SESSION['level'] == "pelanggan" && QueryOnedata($pema)->num_rows < 1) { ?>
        <a href='<?= $url ?>/app/pemasangan/tambah.php' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-plus fa-sm text-white-50'></i> Tambah data pemasangan</a>
    <?php } ?>
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
                        <th>ID PEMASANGAN</th>
                        <th>PELANGGAN</th>
                        <th>PETUGAS LAPANGAN</th>
                        <th>TGL PERMINTAAN PEMASANGAN</th>
                        <th>TGL REALISASI PEKERJAAN</th>
                        <th>TGL TAGIHAN</th>
                        <th>BIAYA</th>
                        <th>STATUS PEMASANGAN</th>                        
                        <th>FOTO</th>                        
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (QueryManyData($pema) as $row) {
                        $pelanggan = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = "'.$row['id_pelanggan'].'"')->fetch_assoc();  
                        $user['nm_pengguna'] = '';
                        if($row['id_user'] != NULL && $row['id_user'] == 0){
                            $user = QueryOnedata('SELECT * FROM user where id_user = "'.$row['id_user'].'"')->fetch_assoc();  
                        }
                        $berkas_pemasangan['foto_berkas'] = '';
                        $berkas = QueryOnedata('SELECT * FROM berkas_pemasangan WHERE id_pemasangan = "'.$row['id_pemasangan'].'" ');
                        if($berkas->num_rows > 0){
                            $berkas_pemasangan['foto_berkas'] = $berkas->fetch_assoc()['foto_berkas'];                            
                        }
                    ?>
                        <tr>
                            <td><?= $row['id_pemasangan'] ?> --> <a href="<?= $url. "/app/pemasangan/barcode.php?id_pemasangan=" . $row['id_pemasangan'] ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-qrcode"></i>qrcode</a> </td>
                            <?php if($_SESSION['level'] == "petugas lapangan"){ ?> 
                                <td>  <a href="<?= $url ?>/app/pemasangan/lihat_alamat.php?id_pelanggan=<?= $row['id_pelanggan'] ?>"><?= $pelanggan['nm_pelanggan'] ?></a>  </td>
                            <?php }else{ ?>
                                <td><?= $pelanggan['nm_pelanggan'] ?></td>
                            <?php } ?>
                            <td><?= $user['nm_pengguna'] ?></td>
                            <td><?= DateNUll($row['tgl_permintaan_pemasangan']) ?></td>
                            <td><?= DateNUll($row['tgl_realisasi_pekerjaan']) ?></td>
                            <td>
                                <?= $row['tgl_tagihan'] != NULL && $row['tgl_tagihan'] != 0 ? $row['tgl_tagihan'] : '' ?>
                                <?php if ($_SESSION['level'] == "petugas bumdes") { ?>        
                                    <?php if ($row['tgl_tagihan'] == date('j')) { ?>        
                                        <a href='<?= $url ?>/aksi/pemasangan.php?id_pemasangan=<?= $row['id_pemasangan'] ?>&notif=true' class='btn btn-primary btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fa fa-paper-plane'></i>
                                            </span>
                                            <span class='text'>Send</span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td><?=  intToRupiah($row['biaya']) ?></td>
                            <td><?= $row['status_pemasangan'] ?></td>
                            <td>
                                <img src="<?= $url."/foto/foto_berkas/". $berkas_pemasangan['foto_berkas'] ?>" alt="" width="50" height="50">
                            </td>
                            <td>                                
                                <?php if ($_SESSION['level'] == "petugas bumdes") { ?>        
                                    <?php if ($row['status_pemasangan'] == "Pengajuan" || $row['status_pemasangan'] == "Proses") { ?> 
                                        <a href='<?= $url ?>/app/pemasangan/edit.php?id_pemasangan=<?= $row['id_pemasangan'] ?>' class='btn btn-success btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-edit'></i>
                                            </span>
                                            <span class='text'>edit</span>
                                        </a>
                                    <?php  } ?>
                                <?php }elseif($_SESSION['level'] == "petugas lapangan") {  ?>
                                    <a href='<?= $url ?>/app/pemasangan/edit.php?id_pemasangan=<?= $row['id_pemasangan'] ?>' class='btn btn-success btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-edit'></i>
                                        </span>
                                        <span class='text'>edit</span>
                                    </a>
                                    <a href='<?= $url ?>/app/pemasangan/upload.php?id_pemasangan=<?= $row['id_pemasangan'] ?>'  class='btn btn-primary btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-upload'></i>
                                        </span>
                                        <span class='text'>Upload Bukti</span>
                                    </a>
                                <?php }elseif($_SESSION['level'] == "pelanggan") {  ?>                                    
                                    <?php if($row['status_pemasangan'] == 'Pengajuan') {  ?>
                                        <a href='<?= $url ?>/app/pemasangan/edit.php?id_pemasangan=<?= $row['id_pemasangan'] ?>' class='btn btn-success btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-edit'></i>
                                            </span>
                                            <span class='text'>edit</span>
                                        </a>
                                        <button onclick="ConfirmDelete('<?= $row['id_pemasangan'] ?>')" class='btn btn-danger btn-icon-split btn-sm'>
                                            <span class='icon text-white-50'>
                                                <i class='fas fa-trash'></i>
                                            </span>
                                            <span class='text'>hapus</span>
                                        </button>
                                    <?php } ?>
                                <?php } 
                                if($berkas->num_rows > 0){ ?>
                                    <a href='<?= $url ?>/app/pemasangan/lihat_upload.php?id_pemasangan=<?= $row['id_pemasangan'] ?>'  class='btn btn-warning btn-icon-split btn-sm'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-eye'></i>
                                        </span>
                                        <span class='text'>foto</span>
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
                window.location.href = '<?= $url ?>/aksi/pemasangan.php?id_pemasangan=' + id + '&action=delete'
            }
        }
    </script>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>