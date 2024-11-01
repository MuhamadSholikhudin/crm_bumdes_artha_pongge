<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php


$pengaduan = QueryOnedata('SELECT * FROM pengaduan WHERE id_pengaduan = "' . $_GET['id_pengaduan'] . '"')->fetch_assoc();
?>
<!-- Begin Page Content -->
<div class='container-fluid'>

    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Pengaduan page</h1>

    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Pengaduan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/pengaduan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row'>
                    <label for='inputid_pengaduan' class='col-sm-2 col-form-label'>Id Pengaduan</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control'  value='<?= $pengaduan['id_pengaduan']; ?>' readonly>
                        <input type='text' class='form-control d-none' id='inputid_pengaduan' name='id_pengaduan' value='<?= $pengaduan['id_pengaduan']; ?>' required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputid_pemasangan' class='col-sm-2 col-form-label'>Pemasangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_pemasangan' id='inputid_pemasangan'>
                            <?php
                            $pelanggans = QueryManyData('SELECT * FROM pemasangan');
                            foreach ($pelanggans  as  $row) {
                                $pepe = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan  where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
                                if ($pengaduan['id_pemasangan'] ==  $row['id_pemasangan']) { ?>
                                <option value='<?= $row['id_pemasangan'] ?>' selected><?= $pepe['id_pemasangan'] ?> // <?= $pepe['nm_pelanggan'] ?> // <?= $pepe['tgl_permintaan_pemasangan'] ?></option>
                                <?php } else {
                                ?>
                                <option value='<?= $row['id_pemasangan'] ?>'><?= $pepe['id_pemasangan'] ?> // <?= $pepe['nm_pelanggan'] ?> // <?= $pepe['tgl_permintaan_pemasangan'] ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php if($_SESSION['level'] == 'petugas lapangan'){ ?>
                    <div class='mb-3 row'>
                <?php } else{ ?>
                    <div class='mb-3 row d-none'>
                <?php } ?>
                    <label for='inputid_user' class='col-sm-2 col-form-label'>Petugas Lapangan
                    </label>
                    <div class='col-sm-10'>
                        <?php ?>
                        <select class='form-control' name='id_user' id='inputid_user'>
                            <?php
                            $users = QueryManyData('SELECT * FROM user where level = "petugas lapangan" ');
                            foreach ($users  as  $row) {
                                if ($pengaduan['id_user'] ==  $row['id_user']) { ?>
                                    <option value='<?= $row['id_user'] ?>' selected><?= $row['nm_pengguna'] ?></option>
                                <?php } else {
                                ?><option value='<?= $row['id_user'] ?>'><?= $row['nm_pengguna'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_pengaduan' class='col-sm-2 col-form-label'>Tgl Pengaduan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_pengaduan' name='tgl_pengaduan' value='<?= $pengaduan['tgl_pengaduan']; ?>' <?php if($_SESSION['level'] != 'pelanggan'){  ?> readonly  <?php } ?>  required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputtgl_perbaikan' class='col-sm-2 col-form-label'>Tgl Perbaikan</label>
                    <div class='col-sm-10'>
                        <input type='date' class='form-control' id='inputtgl_perbaikan' name='tgl_perbaikan' value='<?= $pengaduan['tgl_perbaikan']; ?>' <?php if($_SESSION['level'] == 'pelanggan'){  ?> readonly  <?php } ?> required>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_kendala' class='col-sm-2 col-form-label'>Ket Kendala</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_kendala' name='ket_kendala' required <?php if($_SESSION['level'] != 'pelanggan'){  ?> readonly  <?php } ?> ><?= $pengaduan['ket_kendala'] ?></textarea>
                    </div>
                </div>

                <div class='mb-3 row '>
                    <label for='inputstatus_pengaduan ' class='col-sm-2 col-form-label '>Status Pengaduan
                    </label>
                    <div class='col-sm-10 '>
                        <select class='form-control' name='status_pengaduan' id='inputstatus_pengaduan' <?php if($_SESSION['level'] == 'pelanggan'){  ?> readonly  <?php } ?>>
                            <?php
                            $status_pengaduan = ['Pengaduan', 'Proses', 'Terselesaikan'];
                            foreach ($status_pengaduan as $val) {
                                if ($val == $pengaduan['status_pengaduan']) {
                            ?>
                                    <option value='<?= $val ?>' selected><?= $val ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value='<?= $val ?>'><?= $val ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputfoto_kendala' class='col-sm-2 col-form-label'>Foto Kendala</label>
                    <div class='col-sm-10'>
                        <img src="<?= $url."/foto/foto_kendala/". $pengaduan['foto_kendala']; ?>" alt="<?= $url."/foto/foto_kendala/". $pengaduan['foto_kendala']; ?>" width="100%">
                        <?php if($_SESSION['level'] == 'pelanggan'){  ?>
                            <input type='file' class='form-control' id='inputfoto_kendala' name='foto_kendala'>
                        <?php } ?>                        
                        <input type='hidden' class='form-control' id='inputfoto_kendala' name='foto_kendala_old' value='<?= $pengaduan['foto_kendala']; ?>'>
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputlat_alamat' class='col-sm-2 col-form-label'>Latitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlat_alamat' name='lat_alamat' required><?= $pengaduan['lat_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row d-none'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Longtitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlong_alamat' name='long_alamat' required><?= $pengaduan['long_alamat'] ?></textarea>
                    </div>
                </div>
                <?php if($_SESSION['level'] == 'pelanggan'){ ?>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Lokasi</label>
                    <div class='col-sm-10' >
                        <div id="map"></div>
                        <!-- Leaflet JS -->
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                        <script>
                            // Inisialisasi peta dengan koordinat awal
                            <?php if ($pengaduan['lat_alamat'] == null) { ?>
                                var map = L.map('map').setView([-6.807797, 110.841735], 13); // Koordinat Jakarta
                            <?php } else{ ?>
                                    var map = L.map('map').setView([<?= $pengaduan['lat_alamat'] ?>, <?= $pengaduan['long_alamat'] ?>], 13); // Koordinat Database
                            <?php } ?>       

                            // Tambahkan tile layer dari OpenStreetMap
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            <?php if ($pengaduan['lat_alamat'] == null) { ?>
                                // Menambahkan marker yang bisa di-drag
                                var marker = L.marker([-6.807797, 110.841735], {
                                    draggable: true // Aktifkan draggable
                                }).addTo(map)
                                    .bindPopup('Seret marker untuk memindahkan lokasi')
                                    .openPopup();
                            <?php } else{ ?>
                                // Menambahkan marker yang bisa di-drag
                                var marker = L.marker([<?= $pengaduan['lat_alamat'] ?>, <?= $pengaduan['long_alamat'] ?>], {
                                    draggable: true // Aktifkan draggable
                                }).addTo(map)
                                    .bindPopup('Seret marker untuk memindahkan lokasi')
                                    .openPopup();
                            <?php } ?>

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
                <?php }else{ ?>
                    <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Lokasi</label>
                    <div class='col-sm-10' >
                        <iframe
                            width="600"
                            height="450"
                            style="border:0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q=<?= $pengaduan['lat_alamat'] ?>,<?= $pengaduan['long_alamat'] ?>&hl=es;z=14&output=embed">
                        </iframe>
                    </div>
                </div>
                <?php } ?>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/pengaduan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updatepengaduan' value='updatepengaduan' class='btn btn-success btn-user btn-block'>
                            <i class='fas fa-save'></i> UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include_once '../template/footer.php'; ?>