<?php
include '../config/config.php';
session_start();
if (isset($_POST['simpanlayanan'])) {
    $data = ['nm_layanan' => $_POST['nm_layanan'], 'ket_layanan' => $_POST['ket_layanan'], 'harga_layanan' => $_POST['harga_layanan'], 'jenis_layanan' => $_POST['jenis_layanan'],];
    // Insert satu data
    $process = InsertOnedata('layanan', $data);
    $_SESSION['message'] = 'Data Layanan ' . $process['message'];
    header('Location: ' . $url . '/app/layanan/index.php');
    exit();
} elseif (isset($_POST['updatelayanan'])) {
    // Data yang ingin Execution
    $data = ['nm_layanan' => $_POST['nm_layanan'], 'ket_layanan' => $_POST['ket_layanan'], 'harga_layanan' => $_POST['harga_layanan'], 'jenis_layanan' => $_POST['jenis_layanan'],];
    // Update data berdasarkan
    $process = UpdateOneData('layanan', $data, ' WHERE id_layanan =' . $_POST['id_layanan'] . '');
    $_SESSION['message'] = 'Data Layanan' . $process['message'];
    header('Location: ' . $url . '/app/layanan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('layanan', 'WHERE id_layanan = ' . $_GET['id_layanan'] . '');
    $_SESSION['message'] = 'Data Layanan ' . $process['message'];
    header('Location: ' . $url . '/app/layanan/index.php');
    exit();
}
