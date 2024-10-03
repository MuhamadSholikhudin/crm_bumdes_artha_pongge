<?php 
include '../../config/config.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export Data Excel Laporan Pemasangan</title>
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
    header("Content-Disposition: attachment; filename=Laporan data pemasangan.xls");
    ?>
    <center>
        <h1>Laporan Data Pemasangan </h1>
    </center>
    <table border="1">
        <tr class='text-center'>
            <th>PELANGGAN</th>
            <th>PETUGAS LAPANGAN</th>
            <th>TGL PERMINTAAN PEMASANGAN</th>
            <th>TGL REALISASI PEKERJAAN</th>
            <th>TGL TAGIHAN</th>
            <th>BIAYA</th>
            <th>STATUS PEMASANGAN</th>
        </tr>
        <?php
        $pema = 'SELECT * FROM pemasangan ORDER BY id_pemasangan DESC';
        foreach (QueryManyData($pema) as $row) {
            $pelanggan = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = "' . $row['id_pelanggan'] . '"')->fetch_assoc();
            $user = QueryOnedata('SELECT * FROM user where id_user = "' . $row['id_user'] . '"')->fetch_assoc();
        ?>
            <tr>
                <td><?= $pelanggan['nm_pelanggan'] ?></td>
                <td><?= $user['nm_pengguna'] ?></td>
                <td><?= DateNUll($row['tgl_permintaan_pemasangan']) ?></td>
                <td><?= DateNUll($row['tgl_realisasi_pekerjaan']) ?></td>
                <td><?= DateNUll($row['tgl_tagihan']) ?></td>
                <td><?= intToRupiah($row['biaya']) ?></td>
                <td><?= $row['status_pemasangan'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>