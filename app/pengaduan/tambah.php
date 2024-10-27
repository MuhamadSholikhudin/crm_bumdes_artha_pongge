<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>

<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pengaduan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Tambah Data Pengaduan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pengaduan.php' method='post' enctype='multipart/form-data'>
                <?php 
                    $id = 1;
                    $terahir_pengaduan = QueryOnedata("SELECT * FROM pengaduan ORDER BY CAST(SUBSTRING(id_pengaduan, 3) AS UNSIGNED) DESC  ");                  
                    if($terahir_pengaduan->num_rows > 0 ){
                        $id = Rplc("PD", $terahir_pengaduan->fetch_assoc()['id_pengaduan']) + $id;
                    }
                ?>
                <div class='mb-3 row'>
                    <label for='inputid_pengaduan' class='col-sm-2 col-form-label'>ID Pengaduan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control'  value="PD00<?= $id ?>" readonly>
                        <input type='hidden' class='form-control' id='inputid_pengaduan' name='id_pengaduan' value="PD00<?= $id ?>" required>
                    </div>
                </div> 
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            // Cari Data Pelanggan
                            $pel = QueryOnedata('SELECT * FROM pelanggan WHERE id_user = "'.$_SESSION['id_user'].'" ');
                            //Menampilkan data pemasangan dari pelanggan yang login
                            $pemas  = 'SELECT * FROM pemasangan 
                            LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pemasangan.id_pelanggan 
                            WHERE pelanggan.id_pelanggan = "'.$pel->fetch_assoc()['id_pelanggan'].'" ' ;
                            $pemasangan = QueryManyData($pemas);
                            foreach ($pemasangan as  $row) {
                            ?>
                                <option value='<?= $row['id_pemasangan'] ?>'> <?= $row['id_pemasangan'] ?> [<?= $row['nm_pelanggan'] ?> || <?= $row['tgl_permintaan_pemasangan'] ?> ]</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row' style="display: none;">
                    <label for='inputid_user' class='col-sm-2 col-form-label'>Id User
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $user = QueryManyData('SELECT * FROM user where level = "petugas lapangan" ');
                            foreach ($user as  $row) {
                            ?>
                                <option value='<?= $row['id_user'] ?>'><?= $row['nm_pengguna'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_pengaduan' class='col-sm-2 col-form-label'>Tanggal Pengaduan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_pengaduan' name='tgl_pengaduan' value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class='mb-3 row' style="display:none;">
                    <label for='inputtgl_perbaikan' class='col-sm-2 col-form-label'>Tgl Perbaikan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_perbaikan' name='tgl_perbaikan' >
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_kendala' class='col-sm-2 col-form-label'>Keterangan Kendala</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_kendala' name='ket_kendala' required></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_kendala' class='col-sm-2 col-form-label'>Foto Kendala</label>
                    <div class='col-sm-10'>
                        <input type='file' class='form-control' id='inputfoto_kendala' name='foto_kendala' accept="image/png, image/jpg, image/jpeg" required>
                    </div>
                </div>
                <div class='mb-3 row ' style="display: none;">
                    <label for='inputstatus_pengaduan ' class='col-sm-2 col-form-label '>Status Pengaduan
                    </label>
                    <div class='col-sm-10 '>
                        <select class='form-control' name='status_pengaduan' id='inputstatus_pengaduan'>
                            <?php
                            $status_pengaduan = ['Pengaduan'];
                            foreach ($status_pengaduan    as $val) { ?>
                                <option value='<?= $val ?>'><?= $val ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputlat_alamat' class='col-sm-2 col-form-label'>Latitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlat_alamat' name='lat_alamat' required>-6.807797</textarea>
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Longtitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlong_alamat' name='long_alamat' required>110.841735</textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Lokasi</label>
                    <div class='col-sm-10' >
                        <div id="map"></div>
                        <!-- Leaflet JS -->
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                        <script>
                            // Inisialisasi peta dengan koordinat awal
                            var map = L.map('map').setView([-6.807797, 110.841735], 13); // Koordinat Jakarta

                            // Tambahkan tile layer dari OpenStreetMap
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);
                            
                                // Menambahkan marker yang bisa di-drag
                                var marker = L.marker([-6.807797, 110.841735], {
                                    draggable: true // Aktifkan draggable
                                }).addTo(map)
                                    .bindPopup('Seret marker untuk memindahkan lokasi')
                                    .openPopup();
                  

                            // Update elemen HTML dengan latitude dan longitude baru
                            function updateLatLng(lat, lng) {
                                document.getElementById("inputlat_alamat").value = lat.toFixed(6);
                                document.getElementById("inputlong_alamat").value = lng.toFixed(6);
                            }

                            // Fungsi untuk mengirim data latitude dan longitude ke PHP
                            function sendLatLngToServer(lat, lng) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "update_location.php", true);
                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        console.log("Data successfully sent to the server.");
                                        console.log(xhr.responseText); // Cek respons dari PHP
                                    }
                                };
                                xhr.send("latitude=" + lat + "&longitude=" + lng);
                            }

                            // Fungsi untuk menangkap event saat marker di-drag
                            marker.on('dragend', function (e) {
                                var lat = marker.getLatLng().lat;
                                var lng = marker.getLatLng().lng;
                                updateLatLng(lat, lng); // Update tampilan koordinat
                                sendLatLngToServer(lat, lng); // Kirim koordinat ke server PHP
                            });

                            // Mengaktifkan geolocation
                            map.locate({setView: true, maxZoom: 13});
                        </script>

                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pengaduan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='simpanpengaduan' value='simpanpengaduan' class='btn btn-primary btn-user btn-block'>
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