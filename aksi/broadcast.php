<?php 
include '../config/config.php';
session_start();
if($_POST){

    /*
    ==========

    $nomor = '085225824321'; //diambil dari no di database

    $userkey = '9b85e05d0de7';
    $passkey = '83f0dd70ecb6c588f2ab2cc3';
    $telepon =  $nomor;

    $message = 'Hai, Ada pemesanan layanan dengan kode ' . $id_pemasangan . '. Segera validasi dan dikerjakan ---PESAN INI HANYA NOTIFIKASI TIDAK PERLU DIBALAS---';

    $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
    $satu = zen($url, $userkey, $passkey, $telepon, $message);

    */
    $_SESSION['message'] = 'Pesan Broadcast berhasil di kirim  ';
    header('Location: ' . $url . '/app/broadcast/index.php');
    exit();

}else{

    header('Location: ' . $url . '/app/broadcast/index.php');
    exit();


}