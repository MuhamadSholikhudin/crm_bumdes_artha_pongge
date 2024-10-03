<?php
include '../config/config.php';
session_start();

$lokasi_foto = 'C:/xampp/htdocs/crm_bumdes_artha_pongge/foto/foto_berkas/';
$YMDhis = date('YMDhis');

if (isset($_POST['simpanberkas_pemasangan'])) {

    $ekstensi_diperbolehkan = array('png', 'jpg');
    $nama_file = $_FILES['foto_berkas']['name'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));
    $ukuran   = $_FILES['foto_berkas']['size'];
    $file_tmp = $_FILES['foto_berkas']['tmp_name'];


    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            $nama_file = $YMDhis. $_FILES['foto_berkas']['name'];
            $upload_guru = move_uploaded_file($file_tmp, $lokasi_foto . $nama_file);          
            if ($upload_guru) {
                // Data yang ingin Execution
                $data = [
                    'id_pemasangan' => $_POST['id_pemasangan'],
                    'nm_berkas' => $_POST['nm_berkas'],
                    'foto_berkas' => $nama_file
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
        $process['message'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }

    $_SESSION['message'] = 'Data Berkas Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/berkas_pemasangan/index.php');
    exit();
} elseif (isset($_POST['updateberkas_pemasangan'])) {

    $nama_file = $_POST['foto_berkas_old'];
    if (isset($_FILES['foto_berkas'])) {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $nama_file = $_FILES['foto_berkas']['name'];
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['foto_berkas']['size'];
        $file_tmp = $_FILES['foto_berkas']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                $nama_file = $YMDhis. $_FILES['foto_berkas']['name'];
                unlink($lokasi_foto .  $_POST['foto_berkas_old']);
                $upload_guru =  move_uploaded_file($file_tmp, $lokasi_foto . $nama_file);
            } else {
                $nama_file = $_POST['foto_berkas_old'];
            }
        } else {
            $nama_file = $_POST['foto_berkas_old'];
        }
    }

    // Data yang ingin Execution
    $data = [
        'id_berkas_pemasangan' => $_POST['id_berkas_pemasangan'],
        'id_pemasangan' => $_POST['id_pemasangan'],
        'nm_berkas' => $_POST['nm_berkas'], 'foto_berkas' => $nama_file];
    // Update data berdasarkan
    $process = UpdateOneData('berkas_pemasangan', $data, ' WHERE id_berkas_pemasangan ="' . $_POST['id_berkas_pemasangan'] . '"');
    $_SESSION['message'] = 'Data Berkas Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/berkas_pemasangan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('berkas_pemasangan', 'WHERE id_berkas_pemasangan = "' . $_GET['id_berkas_pemasangan'] . '"');
    $_SESSION['message'] = 'Data Berkas Pemasangan ' . $process['message'];
    header('Location: ' . $url . '/app/berkas_pemasangan/index.php');
    exit();
}
