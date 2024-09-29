<?php 
include '../../config/config.php';
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ".$url."/app/auth/login.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CRM BUMDES</title>
    <!-- Custom fonts for this template-->

    <link rel="apple-touch-icon" sizes="180x180" href="<?= $url ?>/assets/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $url ?>/assets/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $url ?>/assets/img/icons/favicon-16x16.png">


    <link href="<?= $url ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <link href="<?= $url ?>/assets/css/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $url ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= $url ?>/assets/css/dataTables.dataTables.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyGucOZmBUEyD6I6oOmxTDL_gO8kPWN7A"></script>
    <style>
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
