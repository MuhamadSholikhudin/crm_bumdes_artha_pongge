<?php include_once '../template/header.php'; ?>
<?php include_once '../template/sidebar.php'; ?>
<?php include_once '../template/navbar.php'; ?>
<?php
$alamat_pelanggan = QueryOnedata(
    'SELECT * FROM alamat_pelanggan WHERE id_pelanggan = "' .$_GET['id_pelanggan'] .'"')->fetch_assoc();
if ($alamat_pelanggan == null) {
    $alamat_pelanggan = [
        'id_alamat' => null,
        'ket_alamat' => null,
        'lat_alamat' => null,
        'long_alamat' => null,
    ];
}
?>
<!-- Begin Page Content -->
<div class='container-fluid'>
    <!-- Page Heading -->
    <h1 class='h3 mb-4 text-gray-800'>Alamat Pelanggan page</h1>
    <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h5 class='m-0 font-weight-bold text-primary text-center'>
                Form Edit Data Alamat Pelanggan
            </h5>
        </div>
        <div class='card-body'>
            <form action='<?= $url ?>/aksi/data_pelanggan.php' method='post' enctype='multipart/form-data'>
                <div class='mb-3 row d-none'>
                    <label for='inputid_pelanggan' class='col-sm-2 col-form-label'>Id_pengguna</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='inputid_pelanggan' name='id_pelanggan' value='<?= $_GET['id_pelanggan'] ?>' required>
                        <input type='text' class='form-control' id='inputid_alamat' name='id_alamat' value='<?= $alamat_pelanggan['id_alamat'] ?>'>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputket_alamat' class='col-sm-2 col-form-label'>Keterangan Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputket_alamat' name='ket_alamat' required><?= $alamat_pelanggan['ket_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlat_alamat' class='col-sm-2 col-form-label'>Latitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlat_alamat' name='lat_alamat' required><?= $alamat_pelanggan['lat_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>Longtitude Alamat</label>
                    <div class='col-sm-10'>
                        <textarea class='form-control' id='inputlong_alamat' name='long_alamat' required><?= $alamat_pelanggan['long_alamat'] ?></textarea>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <label for='inputlong_alamat' class='col-sm-2 col-form-label'>
                    </label>
                    <div class='col-sm-10' >
                        <div id="map"></div>
                        <!-- Leaflet JS -->
                        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                        <script>
                            // Inisialisasi peta dengan koordinat awal
                            <?php if ($alamat_pelanggan['lat_alamat'] == null) { ?>
                                var map = L.map('map').setView([-6.807797, 110.841735], 13); // Koordinat Jakarta
                            <?php } else{ ?>
                                    var map = L.map('map').setView([<?= $alamat_pelanggan['lat_alamat'] ?>, <?= $alamat_pelanggan['long_alamat'] ?>], 13); // Koordinat Database
                            <?php } ?>       

                            // Tambahkan tile layer dari OpenStreetMap
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            <?php if ($alamat_pelanggan['lat_alamat'] == null) { ?>
                                // Menambahkan marker yang bisa di-drag
                                var marker = L.marker([-6.807797, 110.841735], {
                                    draggable: true // Aktifkan draggable
                                }).addTo(map)
                                    .bindPopup('Seret marker untuk memindahkan lokasi')
                                    .openPopup();
                            <?php } else{ ?>
                                // Menambahkan marker yang bisa di-drag
                                var marker = L.marker([<?= $alamat_pelanggan['lat_alamat'] ?>, <?= $alamat_pelanggan['long_alamat'] ?>], {
                                    draggable: true // Aktifkan draggable
                                }).addTo(map)
                                    .bindPopup('Seret marker untuk memindahkan lokasi')
                                    .openPopup();

                            <?php } ?>

                            // Update elemen HTML dengan latitude dan longitude baru
                            function updateLatLng(lat, lng) {
                                // document.getElementById('lat').textContent = lat.toFixed(6);s
                                // document.getElementById('lng').textContent = lng.toFixed(6);
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

                        <?php /*
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                // Initialize the map at a default location
                                var myLatLng = {
                                    lat: <?= $alamat_pelanggan['lat_alamat'] ?>,
                                    lng: <?= $alamat_pelanggan['long_alamat'] ?>
                                }; // Jakarta example

                                var map = new google.maps.Map(document.getElementById("map"), {
                                    zoom: 10,
                                    center: myLatLng,
                                });

                                // Add a draggable marker
                                var marker = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    draggable: true,
                                    title: "Drag me!",
                                });

                                // Listen for dragend event and get new coordinates
                                marker.addListener("dragend", function(event) {
                                    var lat = event.latLng.lat();
                                    var lng = event.latLng.lng();

                                    // Update coordinates on UI or send to server
                                    console.log("New Latitude: " + lat + ", New Longitude: " + lng);
                                    document.getElementById("inputlat_alamat").value = lat;
                                    document.getElementById("inputlong_alamat").value = lng;

                                    // AJAX request to update lat/lng in the database
                                    // updateCoordinates(lat, lng);
                                });
                            }
                            // Load the map when the page loads
                            window.onload = initMap;
                        </script>
                     */ ?>
                    </div>
                </div>
                <div class='mb-3 row'>
                    <div class='col-sm-2'>
                        <a href='<?= $url ?>/app/data_pelanggan/index.php' class='btn btn-info btn-sm '>
                            <i class='fas fa-arrow-left'></i> kembali
                        </a>
                    </div>
                    <div class='col-sm-10'>
                        <button type='submit' name='updatealamat_pelanggan' value='updatealamat_pelanggan' class='btn btn-success btn-user btn-block'>
                            <i class='fas fa-save'></i> UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /*
<script>
    //  getLocation();  
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        document.getElementById("inputlat_alamat").value = lat;
        document.getElementById("inputlong_alamat").value = lng;
        document.getElementById("showmap").innerHTML = '<iframe src="https://www.google.com/maps?q=' + lat + ',' + lng + '&hl=es;z=14&output=embed" frameborder="0" style="width:100%;"></iframe>';
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }
</script>
<!-- /.container-fluid -->
*/ ?>
<?php include_once '../template/footer.php'; ?>