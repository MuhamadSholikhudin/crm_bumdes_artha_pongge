<?php
include '../config/config.php';
session_start();
if ($_POST) {
    /*
        ==========
        $nomor = '082327591195'; //diambil dari no di database
        $userkey = '9b85e05d0de7';
        $passkey = '83f0dd70ecb6c588f2ab2cc3';
        $telepon =  $nomor;
        $message = 'Hai, Ada pemesanan layanan dengan kode ' . 909090 . '. Segera validasi dan dikerjakan ---PESAN INI HANYA NOTIFIKASI TIDAK PERLU DIBALAS---';
        $url_wa = 'https://console.zenziva.net/wareguler/api/sendWA/';
        $satu = zen($url_wa, $userkey, $passkey, $telepon, $message);
    */

    $url_wa = 'https://console.zenziva.net/wareguler/api/sendWA/';
    if (isset($_POST['BTN_POST_BROADCAST'])) {
        $pelanggan = QueryManyData('SELECT * FROM pelanggan ');
        foreach ($pelanggan as  $row) {
            $nomor = '0' . $row['no_pelanggan']; //diambil dari no di database
            $userkey = '9b85e05d0de7';
            $passkey = '83f0dd70ecb6c588f2ab2cc3';
            $telepon =  $nomor;
            $message = $_POST['broadcast'];
            $satu = zen($url_wa, $userkey, $passkey, $telepon, $message);
        }
    } else if (isset($_POST['BTN_POST_ONE'])) {
        $nomor = '0' . $_POST['no_pelanggan']; //diambil dari no di database
        $userkey = '9b85e05d0de7';
        $passkey = '83f0dd70ecb6c588f2ab2cc3';
        $telepon =  $nomor;
        $message = $_POST['broadcast'];
        $satu = zen($url_wa, $userkey, $passkey, $telepon, $message);
    }

    $_SESSION['message'] = 'Pesan Broadcast berhasil di kirim  ';
    header('Location: ' . $url . '/app/broadcast/index.php');
    exit();
} else {
    header('Location: ' . $url . '/app/broadcast/index.php');
    exit();
}
