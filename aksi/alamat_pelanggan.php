<?php
include '../config/config.php';
session_start();
if (isset($_POST['simpanalamat_pelanggan'])) {
    $data = ['id_alamat' => $_POST['id_alamat'], 'id_pelanggan' => $_POST['id_pelanggan'], 'ket_alamat' => $_POST['ket_alamat'], 'lat_alamat' => $_POST['lat_alamat'], 'long_alamat' => $_POST['long_alamat'],];
    // Insert satu data
    $process = InsertOnedata('alamat_pelanggan', $data);
    $_SESSION['message'] = 'Data Alamat Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/alamat_pelanggan/index.php');
    exit();
} elseif (isset($_POST['updatealamat_pelanggan'])) {
    // Data yang ingin Execution
    $data = ['id_alamat' => $_POST['id_alamat'], 'id_pelanggan' => $_POST['id_pelanggan'], 'ket_alamat' => $_POST['ket_alamat'], 'lat_alamat' => $_POST['lat_alamat'], 'long_alamat' => $_POST['long_alamat'],];
    // Update data berdasarkan
    $process = UpdateOneData('alamat_pelanggan', $data, ' WHERE id_alamat =' . $_POST['id_alamat'] . '');
    $_SESSION['message'] = 'Data Alamat Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/alamat_pelanggan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('alamat_pelanggan', 'WHERE id_alamat = ' . $_GET['id_alamat'] . '');
    $_SESSION['message'] = 'Data Alamat Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/alamat_pelanggan/index.php');
    exit();
}
