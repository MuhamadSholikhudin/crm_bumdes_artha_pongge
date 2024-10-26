<?php
include '../config/config.php';
session_start();
if (isset($_POST['simpanpembayaran'])) {
    $data = [
        'id_pembayaran' => $_POST['id_pembayaran'],
        'id_pemasangan' => $_POST['id_pemasangan'],
        'tgl_bayar' => $_POST['tgl_bayar'],
        'nominal' => $_POST['nominal'],
        'ket_pembayaran' => $_POST['ket_pembayaran'],
        'status' => $_POST['status'],
    ];
    // Insert satu data
    $process = InsertOnedata('pembayaran', $data);
    $_SESSION['message'] = 'Data Pembayaran ' . $process['message'];
    header('Location: ' . $url . '/app/pembayaran/index.php');
    exit();
} elseif (isset($_POST['updatepembayaran'])) {
    // Data yang ingin Execution
    $data = [
        'id_pemasangan' => $_POST['id_pemasangan'],
        'tgl_bayar' => $_POST['tgl_bayar'],
        'nominal' => $_POST['nominal'],
        'ket_pembayaran' => $_POST['ket_pembayaran'],
        'status' => $_POST['status'],
    ];
    // Update data berdasarkan
    $process = UpdateOneData(
        'pembayaran',
        $data,
        ' WHERE id_pembayaran ="' . $_POST['id_pembayaran'] . '"'
    );
    $_SESSION['message'] = 'Data Pembayaran ' . $process['message'];
    header('Location: ' . $url . '/app/pembayaran/index.php');
    exit();
} elseif ($_GET['status'] == 'tervalidasi') {
    $data = [
        'status' => $_GET['status'],
    ];

    $process = UpdateOneData(
        'pembayaran',
        $data,
        ' WHERE id_pembayaran ="' . $_GET['id_pembayaran'] . '"'
    );
    $_SESSION['message'] = 'Data Pembayaran Berhasil di konfirmasi';
    header('Location: ' . $url . '/app/pembayaran/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData(
        'pembayaran',
        'WHERE id_pembayaran = "' . $_GET['id_pembayaran'] . '"'
    );
    $_SESSION['message'] = 'Data Pembayaran ' . $process['message'];
    header('Location: ' . $url . '/app/pembayaran/index.php');
    exit();
}
