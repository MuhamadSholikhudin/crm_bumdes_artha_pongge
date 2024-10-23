<?php
include '../config/config.php';
session_start();
if (isset($_POST['simpanpengaduan'])) {
    $ekstensi_diperbolehkan = ['png', 'jpg'];
    $nama_file = $_FILES['foto_kendala']['name'];
    $x = explode('.', $nama_file);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto_kendala']['size'];
    $file_tmp = $_FILES['foto_kendala']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            $nama_file = $YMDhis . $_FILES['foto_kendala']['name'];
            $upload_guru = move_uploaded_file(
                $file_tmp,
                $lokasi_foto . '/foto_kendala/' . $nama_file
            );
            if ($upload_guru) {
                // Data yang ingin Execution
                $data = [
                    'id_pengaduan' => $_POST['id_pengaduan'],
                    'id_pemasangan' => $_POST['id_pemasangan'],
                    'id_user' => $_POST['id_user'],
                    'tgl_pengaduan' => $_POST['tgl_pengaduan'],
                    'tgl_perbaikan' => $_POST['tgl_perbaikan'],
                    'ket_kendala' => $_POST['ket_kendala'],
                    'foto_kendala' => $nama_file,
                    'status_pengaduan' => $_POST['status_pengaduan'],
                ];
                // Insert satu data
                $process = InsertOnedata('pengaduan', $data);
            } else {
                $process['message'] = 'UPLOAD FOTO TIDAK BERHASIL';
            }
        } else {
            $process['message'] = 'UKURAN FILE TERLALU BESAR';
        }
    } else {
        $process['message'] =
            'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }
    $_SESSION['message'] = 'Data Pengaduan ' . $process['message'];
    header('Location: ' . $url . '/app/pengaduan/index.php');
    exit();
} elseif (isset($_POST['updatepengaduan'])) {
    $nama_file = $_POST['foto_kendala_old'];
    if (isset($_FILES['foto_kendala'])) {
        $ekstensi_diperbolehkan = ['png', 'jpg'];
        $nama_file = $_FILES['foto_kendala']['name'];
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['foto_kendala']['size'];
        $file_tmp = $_FILES['foto_kendala']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                $nama_file = $YMDhis . $_FILES['foto_kendala']['name'];
                unlink(
                    $lokasi_foto . '/foto_kendala/' . $_POST['foto_kendala_old']
                );
                $upload_guru = move_uploaded_file(
                    $file_tmp,
                    $lokasi_foto . '/foto_kendala/' . $nama_file
                );
            } else {
                $nama_file = $_POST['foto_kendala_old'];
            }
        } else {
            $nama_file = $_POST['foto_kendala_old'];
        }
    }

    // Data yang ingin Execution
    $data = [
        'id_pemasangan' => $_POST['id_pemasangan'],
        'id_user' => $_POST['id_user'],
        'tgl_pengaduan' => $_POST['tgl_pengaduan'],
        'tgl_perbaikan' => $_POST['tgl_perbaikan'],
        'ket_kendala' => $_POST['ket_kendala'],
        'foto_kendala' => $nama_file,
        'status_pengaduan' => $_POST['status_pengaduan'],
    ];
    // Update data berdasarkan
    $process = UpdateOneData(
        'pengaduan',
        $data,
        ' WHERE id_pengaduan ="' . $_POST['id_pengaduan'] . '"'
    );
    $_SESSION['message'] = 'Data Pengaduan ' . $process['message'];
    header('Location: ' . $url . '/app/pengaduan/index.php');
    exit();
} elseif ($_GET['action'] == 'delete') {
    $process = DeleteOneData(
        'pengaduan',
        'WHERE id_pengaduan = "' . $_GET['id_pengaduan'] . '"'
    );
    $_SESSION['message'] = 'Data Pengaduan ' . $process['message'];
    header('Location: ' . $url . '/app/pengaduan/index.php');
    exit();
}
