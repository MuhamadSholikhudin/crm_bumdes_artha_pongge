<?php 
include '../config/config.php';
session_start();

if(isset($_POST)){

        if($_POST['password'] != $_POST['password_confirm']){
                $_SESSION['unvalid_username'] = 'Data pelanggan '.$_POST['username'].' gagal di buat coba check form passwod yang di isi !';                
                header("Location: ".$url."/app/registration.php");
                exit(); 
        }
        $username_check = QueryOnedata("SELECT * FROM user WHERE username = '".$_POST['username']."' "); 
        if($username_check->num_rows > 0 ){
                $_SESSION['unvalid_username'] = 'Data pelanggan '.$_POST['username'].' sudah ada dalam sistem !';                
                header("Location: ".$url."/app/auth/registration.php");
                exit(); 
        }

        $query = "SELECT * FROM user WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'  ";        
        $login = QueryOnedata($query);
        if($login->num_rows > 0 ){
                $_SESSION['unvalid_username'] = 'Data pelanggan '.$_POST['username'].' sudah ada dalam sistem !';                
                header("Location: ".$url."/app/auth/registration.php");
                exit(); 
        }else{
                $data = ['username' => $_POST['username'], 'password' => $_POST['password'], 'nm_pengguna' => $_POST['nm_pengguna'], 'level' => 'pelanggan' ];
                // Insert satu data
                $process = InsertOnedata('user', $data);
                $user = QueryOnedata('SELECT * FROM user ORDER BY id_user DESC LIMIT 1')->fetch_assoc();

                $data = ['id_user' => $user['id_user'], 'nm_pelanggan' => $_POST['nm_pengguna']];
                // Insert satu data
                $process = InsertOnedata('pelanggan', $data);
                $_SESSION['message'] = 'Data pelanggan '.$_POST['username'].' berhasil di buat !';                

                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['nm_pengguna'] = $_POST['nm_pengguna'];
                $_SESSION['level'] = $_POST['level'];
                header("Location: ".$url."/app/dashboard/dashboard.php");
                exit(); 
        }
}else{
        header("Location: ".$url."/app/dashboard/dashboard.php");
        exit(); 
}