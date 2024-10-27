<?php
include '../../config/config.php';
session_start(); //Memulai session
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Penilaian Moving Average - Login</title>
    <!-- Custom fonts for this template-->
    <link href="<?= $url ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $url ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background: url('<?= $url . '/assets/img/' ?>image-7-1-1024x576.webp');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">FORM REGISTRASI PELANGGAN</h1>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['unvalid_username'])) {
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Error!</strong> <?= $_SESSION['unvalid_username'] ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    <?php
                                        unset($_SESSION['unvalid_username']);
                                    }
                                    ?>
                                    <form class="user" action="<?= $url . "/aksi/registration.php" ?>" enctype="multipart/form-data" method="POST">
                                        <div class='mb-3 row'>
                                            <label for='inputusername' class='col-sm-4 col-form-label'>Username</label>
                                            <div class='col-sm-8'>
                                                <input type='text' class='form-control' id='inputusername' name='username' required>
                                            </div>
                                        </div>
                                        <div class='mb-3 row'>
                                            <label for='inputnm_pengguna' class='col-sm-4 col-form-label'>Nama  </label>
                                            <div class='col-sm-8'>
                                                <input type='text' class='form-control' id='inputnm_pengguna' name='nm_pengguna' required>
                                            </div>
                                        </div>
                                        <div class='mb-3 row'>
                                            <label for='inputpassword' class='col-sm-4 col-form-label'>Password</label>
                                            <div class='col-sm-8'>
                                                <input type='password' class='form-control' id='inputpassword' name='password' required>
                                            </div>
                                        </div>
                                        <div class='mb-3 row'>
                                            <label for='inputpassword_confirm' class='col-sm-4 col-form-label'>Konfirasi Password</label>
                                            <div class='col-sm-8'>
                                                <input type='password' class='form-control' id='inputpassword_confirm' name='password_confirm' required>
                                            </div>
                                        </div>



                                        <button type="submit" class="btn btn-sm btn-primary  btn-block">
                                            <i class="fa fa-user-alt"></i>
                                            Daftar Pelanggan
                                        </button>

                                        <hr style="border: 1px solid;">
                                        <a href="<?= $url . "/app/auth/login.php" ?>" class="btn btn-google btn-sm btn-block">
                                            <i class="fa fa-arrow-left"></i> sudah punya akun ! Login
                                        </a>
                                        

                                    </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= $url ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $url ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $url ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $url ?>/assets/js/sb-admin-2.min.js"></script>

</body>

</html>