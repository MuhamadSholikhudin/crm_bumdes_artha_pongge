<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pencatatan Penggunaan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pencatatan Penggunaan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pencatatan_penggunaan.php' method='post' enctype='multipart/form-data'>
                 <?php 
                    $id = 1;
                    $terahir_pencatatan = QueryOnedata("SELECT * FROM pencatatan_penggunaan ORDER BY id_pencatatan DESC ");                  
                    if($terahir_pencatatan->num_rows > 0 ){
                        $id = Rplc("PC", $terahir_pencatatan->fetch_assoc()['id_pencatatan']) + $id;
                    }
                ?>
                <div class='mb-3 row'>
                    <label for='inputid_pencatatan' class='col-sm-2 col-form-label'>ID PEMASANANGN</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' value="PC00<?= $id ?>" readonly>
                        <input type='hidden' class='form-control' id='inputid_pencatatan' name='id_pencatatan' value="PC00<?= $id ?>" required>
                    </div>
                </div> 
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                        <?php
                            $pemasangan = QueryManyData('SELECT * FROM pemasangan');
                            foreach ($pemasangan as  $row) {
                                $pepe = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan  where pemasangan.id_pemasangan = "'.$row['id_pemasangan'].'"')->fetch_assoc();  
                        ?>
                                <option value='<?= $row['id_pemasangan'] ?>'><?= $pepe['id_pelanggan'] ?> // <?= $pepe['nm_pelanggan'] ?> // <?= $pepe['tgl_permintaan_pemasangan'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnomor_pasang' class='col-sm-2 col-form-label'>Nomor Pasang</label>
                    <div class='col-sm-10'>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                        <style>
                            main {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                            #reader {
                                width: 600px;
                            }
                            #result {
                                text-align: center;
                                font-size: 1.5rem;
                            }
                        </style>

                        <main>
                            <div id="reader"></div>
                        </main>
                        <script>
                            const scanner = new Html5QrcodeScanner('reader', {
                                qrbox: {
                                width: 250,
                                height: 250,
                                },
                                fps: 20,
                            });
                            scanner.render(success, error);
                            function success(result) {
                                document.getElementById('inputnomor_pasang').value = result;  // Isi input dengan hasil scan
                                scanner.clear();                            
                            }
                            function error(err) {
                                console.error(err);
                            }
                        </script>   
                       <input type='text' class='form-control' id='inputnomor_pasang' name='nomor_pasang' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputnilai_stand_meter' class='col-sm-2 col-form-label'>Nilai Stand Meter</label>
                    <div class='col-sm-10'>
                        <input type='number' class='form-control' id='inputnilai_stand_meter' name='nilai_stand_meter' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_stand_meter' class='col-sm-2 col-form-label'>Foto Stand Meter</label>
                    <div class='col-sm-10'>
                        <input type='file' class='form-control' id='inputfoto_stand_meter' name='foto_stand_meter' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pencatatan_penggunaan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanpencatatan_penggunaan' value='simpanpencatatan_penggunaan' class='btn btn-primary btn-user btn-block'>
                            <i class='fas fa-save'></i> SIMPAN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>