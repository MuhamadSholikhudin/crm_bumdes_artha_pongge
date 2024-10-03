<?php 
include '../../config/config.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Export Data Excel Data Laporan pengaduan</title>
</head>
<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan data pengaduan.xls");
    ?>
    <center>
        <h1>Export Data Pengaduan </h1>
    </center>
    <table border="1">
        <tr class='text-center'>
            <th>ID PEMASANGAN</th>
            <th>ID USER</th>
            <th>TGL PENGADUAN</th>
            <th>TGL PERBAIKAN</th>
            <th>KET KENDALA</th>
            <th>FOTO KENDALA</th>
            <th>STATUS PENGADUAN</th>
        </tr>
        <?php
        $pengaduan = 'SELECT * FROM pengaduan 
                    LEFT JOIN pemasangan ON pengaduan.id_pemasangan = pemasangan.id_pemasangan 
                    LEFT JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan';
        foreach (QueryManyData($pengaduan) as $row) {
            $pemasangan = QueryOnedata('SELECT * FROM pemasangan JOIN pelanggan ON pemasangan.id_pelanggan = pelanggan.id_pelanggan where pemasangan.id_pemasangan = "' . $row['id_pemasangan'] . '"')->fetch_assoc();
            $user = QueryOnedata('SELECT * FROM user where id_user = "' . $row['id_user'] . '"')->fetch_assoc();
        ?>
            <tr>
                <td><?= $pemasangan['nm_pelanggan'] ?></td>
                <td><?= $user['nm_pengguna'] ?></td>
                <td><?= $row['tgl_pengaduan'] ?></td>
                <td><?= $row['tgl_perbaikan'] ?></td>
                <td><?= $row['ket_kendala'] ?></td>
                <td><?= $row['foto_kendala'] ?></td>
                <td><?= $row['status_pengaduan'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>