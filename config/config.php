<?php
function Url_web(){
    $xplode = explode("/", $_SERVER['REQUEST_URI']);
    return $xplode[1];
}
$defaul_uri = Url_web();
$url = "http://".$_SERVER['SERVER_NAME'].":8080/".$defaul_uri;
$lokasi_foto = 'C:/xampp/htdocs/'.Url_web().'/foto';
$YMDhis = date('YMDhis');
function DB(){
    return ["localhost", "root", "password_baru", "danis"];
}

function runQuery($sql) {
    try {
        // Membuka koneksi ke database
        $conn = mysqli_connect(DB()[0], DB()[1], DB()[2], DB()[3]);
        // Menjalankan kueri SQL
        $result = mysqli_query($conn, $sql);
        // Menutup koneksi ke database
        mysqli_close($conn);
        return $result;
    } catch (Exception $e) {
        // Tangani pengecualian
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}

function QueryManyData($sql){
    $conn = new mysqli(DB()[0], DB()[1], DB()[2], DB()[3]);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    // Menutup koneksi database
    $conn->close();
    return $result;
}

function QueryOnedata($sql){
    $conn = new mysqli(DB()[0], DB()[1], DB()[2], DB()[3]);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    // Query SQL untuk mengambil data dari tabel "users"
    $result = $conn->query($sql);
    // Menutup koneksi database
    $conn->close();
    // return $row = $result->fetch_assoc();
    return $result;
}

function InsertOnedata($tabel, $data){
    $conn = new mysqli(DB()[0], DB()[1], DB()[2], DB()[3]);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        return ["code" => 400, "message" => $conn->connect_error];
    }
    // Menggabungkan kunci dan nilai menjadi string untuk digunakan dalam perintah SQL
    $keys = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";
    // Query SQL untuk menambahkan data ke dalam tabel "users"
    $sql = "INSERT INTO $tabel ($keys) VALUES ($values)";
    // var_dump($sql);
    // die();
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil ditambahkan.";
        return ["code" => 200, "message" =>  "Berhasil di Tambahkan"];
    } else {
        return ["code" => 400, "message" =>  $conn->error];
    }
    // Menutup koneksi database
    $conn->close();
}


function UpdateOneData($table, $data, $where){
    $conn = new mysqli(DB()[0], DB()[1], DB()[2], DB()[3]);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        return ["code" => 400, "message" => $conn->connect_error];
    }
    // Membuat string untuk perintah UPDATE
    $updateData = "";
    foreach ($data as $key => $value) {
        $updateData .= "$key='$value', ";
    }
    $updateData = rtrim($updateData, ", "); // Menghapus koma terakhir
    // Query SQL untuk menambahkan data ke dalam tabel "users"
    $sql = "UPDATE $table SET $updateData $where";
    if ($conn->query($sql) === TRUE) {
        return ["code" => 200, "message" =>  "Berhasil di Update"];
    } else {
        return ["code" => 400, "message" =>  $conn->error];
    }
    // Menutup koneksi database
    $conn->close();
}

function DeleteOneData($table, $where){
    $conn = new mysqli(DB()[0], DB()[1], DB()[2], DB()[3]);
    // Memeriksa koneksi
    if ($conn->connect_error) {
        return ["code" => 400, "message" => $conn->connect_error];
    }
    // Query SQL untuk menambahkan data ke dalam tabel "users"
    $sql = "DELETE FROM $table $where";
    if ($conn->query($sql) === TRUE) {
        return ["code" => 200, "message" =>  "Berhasil di Hapus"];
    } else {
        return ["code" => 400, "message" =>  $conn->error];
    }
    // Menutup koneksi database
    $conn->close();
}

function Sub_menu_active($sub_menu){                
    $string = str_replace(Url_web()."/app/", "", $_SERVER['REQUEST_URI']);
    $expl = explode("/", $string);
    $output = "";
    if($expl[0] == $sub_menu){
        $output = "active";
    }
    return $output;
}

function Menu_active($menus){ //$menus array
    $string = str_replace(Url_web()."/app/", "", $_SERVER['REQUEST_URI']);
    $expl = explode("/", $string);
    $result = "";
    for($x = 0 ; $x < count($menus); $x ++){
        if ($expl[0] == $menus[$x]) {
            $result = "show";
        }
    }
    return $result;
}

function intToRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

function DateNUll($tanggal){
    if($tanggal != NULL && $tanggal != '0000-00-00'){
        return $tanggal;        
    }else{
        return '';
    }
}


function zen($url, $userkey, $passkey, $telepon, $message)
{
   $curlHandle = curl_init();
   curl_setopt($curlHandle, CURLOPT_URL, $url);
   curl_setopt($curlHandle, CURLOPT_HEADER, 0);
   curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
   curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
   curl_setopt($curlHandle, CURLOPT_POST, 1);
   curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
      'userkey' => $userkey,
      'passkey' => $passkey,
      'to' => $telepon,
      'message' => $message
   ));
   $results = json_decode(curl_exec($curlHandle), true);
   curl_close($curlHandle);
   return $results;
}

function Rplc($code, $val_id){
    $value = str_replace($code."00","", $val_id);
    return $value;
}


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