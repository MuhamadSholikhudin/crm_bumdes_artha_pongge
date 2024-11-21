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
    $userkey = '9b85e05d0de7';
    $passkey = '83f0dd70ecb6c588f2ab2cc3';
    
    if (isset($_POST['BTN_POST_BROADCAST'])) { 
        if (isset($_POST['telat'])) { // hanya ke pelanggan yang telat saja
            $pelanggan_id = [];
            foreach(QueryManyData("SELECT * FROM pemasangan") as $row){
                $query_check_pemb = "SELECT * FROM pembayaran 
                    LEFT JOIN pencatatan_penggunaan ON pembayaran.id_pemasangan = pencatatan_penggunaan.id_pemasangan 
                    WHERE pembayaran.id_pemasangan = '".$row['id_pemasangan']."' 
                    AND pembayaran.ket_pembayaran LIKE '%pencatatan_penggunaan%' 
                    AND YEAR(pembayaran.tgl_bayar) = '".date('Y')."' 
                    AND YEAR(pembayaran.tgl_bayar) = '".date('Y')."' 
    
                    AND MONTH(pencatatan_penggunaan.tanggal) = '".date('m')."' 
                    AND YEAR(pencatatan_penggunaan.tanggal) = '".date('Y')."' 
                    
                    ";
                $chek_pemb =  QueryOnedata($query_check_pemb);
                if($chek_pemb->num_rows < 1){
                    $chek_penc =  QueryOnedata("SELECT * FROM pencatatan_penggunaan WHERE id_pemasangan = '".$row['id_pemasangan']."' AND MONTH(pencatatan_penggunaan.tanggal) = '".date('m')."' 
                    AND YEAR(pencatatan_penggunaan.tanggal) = '".date('Y')."' ");
                    if($chek_penc->num_rows > 0){
                        array_push($pelanggan_id, $row['id_pelanggan']);
                    }
                }            
            }
           
            // var_dump($pelanggan_id); 
            for($rt = 0 ; $rt < count($pelanggan_id); $rt++){
                echo "<br>".$pelanggan_id[0];
                $message = $_POST['broadcast'];
                $pela = QueryOnedata("SELECT * FROM pelanggan WHERE id_pelanggan = '".$pelanggan_id[0]."' ")->fetch_assoc();
                $satu = zen($url_wa, $userkey, $passkey, "0".$pela['no_pelanggan'], $message);
            }
        }else{ // Ke semua pelanggan
            $pelanggan = QueryManyData('SELECT * FROM pelanggan ');
            foreach ($pelanggan as  $row) {
                $nomor = '0' . $row['no_pelanggan']; //diambil dari no di database
                $telepon =  $nomor;
                $message = $_POST['broadcast'];
                $satu = zen($url_wa, $userkey, $passkey, $telepon, $message);
            }
        }


    } else if (isset($_POST['BTN_POST_ONE'])) {
        $nomor = '0' . $_POST['no_pelanggan']; //diambil dari no di database
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
