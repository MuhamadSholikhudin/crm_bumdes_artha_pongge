<?php 
include '../config/config.php';
session_start();

if(isset($_POST)){
        $query = "SELECT * FROM user WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'  ";
        $login = QueryOnedata($query);
        if($login->num_rows > 0 ){
                $row = $login-> fetch_assoc();               
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['nm_pengguna'] = $row['nm_pengguna'];
                $_SESSION['level'] = $row['level'];
                header("Location: ".$url."/app/dashboard/dashboard.php");
                exit(); 
        }else{
                $_SESSION['unvalid_username'] = $_POST['username'];                
                header("Location: ".$url."/app/auth/login.php");
                exit(); 
        }
}else{
        header("Location: ".$url."/app/dashboard/dashboard.php");
        exit(); 
}
