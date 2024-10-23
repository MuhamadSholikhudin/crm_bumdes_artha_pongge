<?php
include '../config/config.php';
session_start();

$lokasi_foto = 'C:/xampp/htdocs/crm_bumdes_artha_pongge/foto/foto_berkas/';
$YMDhis = date('YMDhis');

if (isset($_POST['simpanpemasangan'])) {
    $data = [
        'id_pemasangan' => $_POST['id_pemasangan'],
        'id_pelanggan' => $_POST['id_pelanggan'],
        'id_user' => $_POST['id_user'],
        'tgl_permintaan_pemasangan' => $_POST['tgl_permintaan_pemasangan'],
        'tgl_realisasi_pekerjaan' => $_POST['tgl_realisasi_pekerjaan'],
        'tgl_tagihan' => $_POST['tgl_tagihan'],
        'biaya' => $_POST['biaya'],
        'status_pemasangan' => $_POST['status_pemasangan'],
    ];
    // Insert satu data
    $process = InsertOnedata('pemasangan', $data);
    $_SESSION['message'] = 'Data Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/pemasangan/index.php');
    exit();
} elseif (isset($_POST['updatepemasangan'])) {
    // Data yang ingin Execution
    $data = [
        'id_pelanggan' => $_POST['id_pelanggan'],
        'id_user' => $_POST['id_user'],
        'tgl_permintaan_pemasangan' => $_POST['tgl_permintaan_pemasangan'],
        'tgl_realisasi_pekerjaan' => $_POST['tgl_realisasi_pekerjaan'],
        'tgl_tagihan' => $_POST['tgl_tagihan'],
        'biaya' => $_POST['biaya'],
        'status_pemasangan' => $_POST['status_pemasangan'],
    ];
    // Update data berdasarkan
    $process = UpdateOneData(
        'pemasangan',
        $data,
        ' WHERE id_pemasangan ="' . $_POST['id_pemasangan'] . '"'
    );
    $_SESSION['message'] = 'Data Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/pemasangan/index.php');
    exit();
} elseif (isset($_POST['uploadberkas_pemasangan'])) {
    // Query check data pemasangan
    $check_berkas = QueryOnedata(
        'SELECT * FROM berkas_pemasangan WHERE id_berkas_pemasangan = "' .
            $_POST['id_berkas_pemasangan'] .
            '" '
    );

    //jika belum ada berkas pemasangan maka insert data
    if ($check_berkas->num_rows < 1) {
        $ekstensi_diperbolehkan = ['png', 'jpg'];
        $nama_file = $_FILES['foto_berkas']['name'];
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto_berkas']['size'];
        $file_tmp = $_FILES['foto_berkas']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                $nama_file = $YMDhis . $_FILES['foto_berkas']['name'];
                $upload_guru = move_uploaded_file(
                    $file_tmp,
                    $lokasi_foto . $nama_file
                );
                if ($upload_guru) {
                    // Data yang ingin Execution
                    $data = [
                        'id_pemasangan' => $_POST['id_pemasangan'],
                        'id_berkas_pemasangan' =>
                            $_POST['id_berkas_pemasangan'],
                        'nm_berkas' => $_POST['nm_berkas'],
                        'foto_berkas' => $nama_file,
                    ];
                    // Insert satu data
                    $process = InsertOnedata('berkas_pemasangan', $data);
                } else {
                    $process['message'] = 'UPLOAD FOTO TIDAK BERHASIL';
                }
            } else {
                $process['message'] = 'UKURAN FILE TERLALU BESAR';
            }
        } else {
            $process['message'] =
                'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }

        // jika sudah ada berkas pemasangan maka di update
    } else {
        $nama_file = $_POST['foto_berkas_old'];
        if (isset($_FILES['foto_berkas'])) {
            $ekstensi_diperbolehkan = ['png', 'jpg', 'jpeg'];
            $nama_file = $_FILES['foto_berkas']['name'];
            $x = explode('.', $nama_file);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['foto_berkas']['size'];
            $file_tmp = $_FILES['foto_berkas']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 1044070) {
                    $nama_file = $YMDhis . $_FILES['foto_berkas']['name'];
                    unlink($lokasi_foto . $_POST['foto_berkas_old']);
                    $upload_guru = move_uploaded_file(
                        $file_tmp,
                        $lokasi_foto . $nama_file
                    );
                } else {
                    $nama_file = $_POST['foto_berkas_old'];
                }
            } else {
                $nama_file = $_POST['foto_berkas_old'];
            }
        }
        // Data yang ingin Execution
        $data = [
            'id_pemasangan' => $_POST['id_pemasangan'],
            'nm_berkas' => $_POST['nm_berkas'],
            'foto_berkas' => $nama_file,
        ];
        // Update data berdasarkan
        $process = UpdateOneData(
            'berkas_pemasangan',
            $data,
            ' WHERE id_berkas_pemasangan ="' .
                $_POST['id_berkas_pemasangan'] .
                '"'
        );
    }

    $_SESSION['message'] = 'Data Berkas Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/pemasangan/index.php');
    exit();
} elseif ($_GET['notif'] == 'true') {
    $pemasangan = QueryOnedata('SELECT * FROM pemasangan LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan WHERE pemasangan.id_pemasangan = "'.$_GET['id_pemasangan'].'" ')->fetch_assoc();
    $lay1 = QueryOnedata('SELECT * FROM layanan WHERE jenis_layanan ="Biaya Pemakaian" ')->fetch_assoc();
    $lay2 = QueryOnedata('SELECT * FROM layanan WHERE jenis_layanan ="Perawatan" ')->fetch_assoc();
    $m = "Pelanggan ".$pemasangan['nm_pelanggan']."
    Berikut Tagihan anda pada bulan ini :
    1. ".$lay1['nm_layanan']." : ".intToRupiah($lay1['harga_layanan'])."
    2. ".$lay2['nm_layanan']." : ".intToRupiah($lay2['harga_layanan'])."
    Total : ".intToRupiah(($lay1['harga_layanan']+$lay2['harga_layanan']))." 
    \n
    Agar anda dapat menggunakan layanan kami dimohon untuk membayar tagihan anda. 
    ";

    $url_wa = 'https://console.zenziva.net/wareguler/api/sendWA/';
    $nomor = '0'.$pemasangan['no_pelanggan']; //diambil dari no di database
    $userkey = '9b85e05d0de7';
    $passkey = '83f0dd70ecb6c588f2ab2cc3';
    $telepon =  $nomor;    
    $message = $m;
    $satu = zen($url_wa, $userkey, $passkey, $telepon, $message);

    $_SESSION['message'] = 'Kirim Notifikasi ke pelanggan berhasil di proses ';
    header('Location: ' . $url . '/app/pemasangan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData(
        'pemasangan',
        'WHERE id_pemasangan ="' . $_GET['id_pemasangan'] . '"'
    );
    $_SESSION['message'] = 'Data Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/pemasangan/index.php');
    exit();
}
