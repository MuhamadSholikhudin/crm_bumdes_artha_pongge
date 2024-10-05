<?php
include '../config/config.php';
session_start();
if (isset($_POST['simpanpelanggan'])) {
    $data = ['id_pelanggan' => $_POST['id_pelanggan'], 'id_user' => $_POST['id_user'], 'nm_pelanggan' => $_POST['nm_pelanggan'], 'no_pelanggan' => $_POST['no_pelanggan'],];
    // Insert satu data
    $process = InsertOnedata('pelanggan', $data);
    $_SESSION['message'] = 'Data Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/pelanggan/index.php');
    exit();
} elseif (isset($_POST['updatepelanggan'])) {

    // Data yang ingin Execution
    $data = ['id_user' => $_POST['id_user'], 'nm_pelanggan' => $_POST['nm_pelanggan'], 'no_pelanggan' => $_POST['no_pelanggan'],];
    $data_user = ['nm_pengguna' => $_POST['nm_pelanggan'], 'password' => $_POST['password'],];
    // Update data berdasarkan
    $process = UpdateOneData('pelanggan', $data, ' WHERE id_pelanggan ="' . $_POST['id_pelanggan'] . '"');
    $process = UpdateOneData('user', $data_user, ' WHERE id_user ="' . $_POST['id_user'] . '"');
    $_SESSION['message'] = 'Data Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/data_pelanggan/index.php');
    exit();
} elseif (isset($_POST['updatealamat_pelanggan'])) {

    if ($_POST['id_alamat'] == NULL) {
        $id = 1;
        $terahir_alamat_pelanggan = QueryOnedata("SELECT * FROM alamat_pelanggan ORDER BY CAST(SUBSTRING(id_alamat, 3) AS UNSIGNED) DESC ");                  
        if($terahir_alamat_pelanggan->num_rows > 0 ){
            $id = Rplc("AL", $terahir_alamat_pelanggan->fetch_assoc()['id_alamat'])+$id;
        }
        $data = [
            'id_alamat' => "AL00".$id, 
        'id_pelanggan' => $_POST['id_pelanggan'], 'ket_alamat' => $_POST['ket_alamat'], 'lat_alamat' => $_POST['lat_alamat'], 'long_alamat' => $_POST['long_alamat'],];
        // Insert satu data
        $process = InsertOnedata('alamat_pelanggan', $data);
        $_SESSION['message'] = 'Data Alamat Pelanggan ' . $process['message'];
    } else {
        $data = ['id_alamat' => $_POST['id_alamat'], 'id_pelanggan' => $_POST['id_pelanggan'], 'ket_alamat' => $_POST['ket_alamat'], 'lat_alamat' => $_POST['lat_alamat'], 'long_alamat' => $_POST['long_alamat'],];
        // Update data berdasarkan
        $process = UpdateOneData('alamat_pelanggan', $data, ' WHERE id_alamat ="' . $_POST['id_alamat'] . '"');
    }
    $_SESSION['message'] = 'Data Alamat Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/data_pelanggan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('pelanggan', 'WHERE id_pelanggan = "' . $_GET['id_pelanggan'] . '"');
    $_SESSION['message'] = 'Data Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/pelanggan/index.php');
    exit();
}
