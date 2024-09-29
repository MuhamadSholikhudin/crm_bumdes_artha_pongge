<?php
include '../config/config.php';
session_start();
$lokasi_foto = 'C:/xampp/htdocs/crm_bumdes_artha_pongge/foto/foto_stand_meter/';
$YMDhis = date('YMDhis');
if (isset($_POST['simpanpencatatan_penggunaan'])) {


    $ekstensi_diperbolehkan = array('png', 'jpg');
    $nama_file = $_FILES['foto_stand_meter']['name'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));
    $ukuran   = $_FILES['foto_stand_meter']['size'];
    $file_tmp = $_FILES['foto_stand_meter']['tmp_name'];


    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            $nama_file = $YMDhis. $_FILES['foto_stand_meter']['name'];
            $upload_guru = move_uploaded_file($file_tmp, $lokasi_foto . $nama_file);          
            if ($upload_guru) {
                $data = ['id_pemasangan' => $_POST['id_pemasangan'], 'nomor_pasang' => $_POST['nomor_pasang'], 'nilai_stand_meter' => $_POST['nilai_stand_meter'], 'foto_stand_meter' => $nama_file];
                // Insert satu data
                $process = InsertOnedata('pencatatan_penggunaan', $data);
            } else {
                $process['message'] = 'UPLOAD FOTO TIDAK BERHASIL';
            }
        } else {
            $process['message'] = 'UKURAN FILE TERLALU BESAR';
        }
    } else {
        $process['message'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }  
    
    $_SESSION['message'] = 'Data Pencatatan Penggunaan ' . $process['message'];
    header('Location: ' . $url . '/app/pencatatan_penggunaan/index.php');
    exit();
} elseif (isset($_POST['updatepencatatan_penggunaan'])) {


    $nama_file = $_POST['foto_stand_meter_old'];
    if (isset($_FILES['foto_stand_meter'])) {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $nama_file = $_FILES['foto_stand_meter']['name'];
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['foto_stand_meter']['size'];
        $file_tmp = $_FILES['foto_stand_meter']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                $nama_file = $YMDhis. $_FILES['foto_stand_meter']['name'];
                unlink($lokasi_foto .  $_POST['foto_stand_meter_old']);
                $upload_guru =  move_uploaded_file($file_tmp, $lokasi_foto . $nama_file);
            } else {
                $nama_file = $_POST['foto_stand_meter_old'];
            }
        } else {
            $nama_file = $_POST['foto_stand_meter_old'];
        }
    }

    // Data yang ingin Execution
    $data = ['id_pemasangan' => $_POST['id_pemasangan'], 'nomor_pasang' => $_POST['nomor_pasang'], 'nilai_stand_meter' => $_POST['nilai_stand_meter'], 'foto_stand_meter' => $nama_file,];
    // Update data berdasarkan
    $process = UpdateOneData('pencatatan_penggunaan', $data, ' WHERE id_pencatatan =' . $_POST['id_pencatatan'] . '');
    $_SESSION['message'] = 'Data Pencatatan_Penggunaan' . $process['message'];
    header('Location: ' . $url . '/app/pencatatan_penggunaan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('pencatatan_penggunaan', 'WHERE id_pencatatan = ' . $_GET['id_pencatatan'] . '');
    $_SESSION['message'] = 'Data Pencatatan_Penggunaan ' . $process['message'];
    header('Location: ' . $url . '/app/pencatatan_penggunaan/index.php');
    exit();
}
