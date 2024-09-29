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
    $data = ['id_pelanggan' => $_POST['id_pelanggan'], 'id_user' => $_POST['id_user'], 'nm_pelanggan' => $_POST['nm_pelanggan'], 'no_pelanggan' => $_POST['no_pelanggan'],];
    // Update data berdasarkan
    $process = UpdateOneData('pelanggan', $data, ' WHERE id_pelanggan =' . $_POST['id_pelanggan'] . '');
    $_SESSION['message'] = 'Data Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/pelanggan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData('pelanggan', 'WHERE id_pelanggan = ' . $_GET['id_pelanggan'] . '');
    $_SESSION['message'] = 'Data Pelanggan ' . $process['message'];
    header('Location: ' . $url . '/app/pelanggan/index.php');
    exit();
}
