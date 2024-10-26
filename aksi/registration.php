<?php
include '../config/config.php';
session_start();

if (isset($_POST)) {
        $username_check = QueryOnedata("SELECT * FROM user WHERE username = '" . $_POST['username'] . "' ");
        $query = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'  ";
        $login = QueryOnedata($query);
        if ($_POST['password'] != $_POST['password_confirm']) {
                $_SESSION['unvalid_username'] = 'Data pelanggan ' . $_POST['username'] . ' gagal di buat coba check form passwod yang di isi !';
                header("Location: " . $url . "/app/registration.php");
                exit();
        } else if ($username_check->num_rows > 0) {
                $_SESSION['unvalid_username'] = 'Data pelanggan ' . $_POST['username'] . ' sudah ada dalam sistem !';
                header("Location: " . $url . "/app/auth/registration.php");
                exit();
        } else if ($login->num_rows > 0) {
                $_SESSION['unvalid_username'] = 'Data pelanggan ' . $_POST['username'] . ' sudah ada dalam sistem !';
                header("Location: " . $url . "/app/auth/registration.php");
                exit();
        } else {
                $id = 1;
                $terahir_user = QueryOnedata("SELECT * FROM user ORDER BY CAST(SUBSTRING(id_user, 2) AS UNSIGNED) DESC ");
                if ($terahir_user->num_rows > 0) {
                        $id = Rplc("U", $terahir_user->fetch_assoc()['id_user']) + $id;
                }
                $data = [
                        'id_user' => 'U00' . $id,
                        'username' => $_POST['username'],
                        'password' => $_POST['password'],
                        'nm_pengguna' => $_POST['nm_pengguna'],
                        'level' => 'pelanggan'
                ];
                // Insert satu data
                $process = InsertOnedata('user', $data);
                $user = QueryOnedata('SELECT * FROM user ORDER BY CAST(SUBSTRING(id_user, 2) AS UNSIGNED) DESC LIMIT 1')->fetch_assoc();

                $id_p = 1;
                $terahir_pelanggan = QueryOnedata("SELECT * FROM pelanggan ORDER BY CAST(SUBSTRING(id_pelanggan, 3) AS UNSIGNED) DESC  ");
                if ($terahir_pelanggan->num_rows > 0) {
                        $id_p = Rplc("PL", $terahir_pelanggan->fetch_assoc()['id_pelanggan']) + $id_p;
                }

                $data = [
                        'id_pelanggan' => 'PL00' . $id_p,
                        'id_user' => $user['id_user'],
                        'nm_pelanggan' => $_POST['nm_pengguna']
                ];
                // Insert satu data
                $process = InsertOnedata('pelanggan', $data);
                $_SESSION['message'] = 'Data pelanggan ' . $_POST['username'] . ' berhasil di buat !';

                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nm_pengguna'] = $user['nm_pengguna'];
                $_SESSION['level'] = $user['level'];

                header("Location: " . $url . "/app/dashboard/dashboard.php");
                exit();
        }
} else {
        header("Location: " . $url . "/app/auth/login.php");
        exit();
}
