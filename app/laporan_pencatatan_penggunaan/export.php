<?php
function QueryManyData($sql)
{
    $conn = new mysqli("localhost", "root", "", "danis");
    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    // Menutup koneksi database
    $conn->close();
    return $result;
}

function QueryOnedata($sql)
{
    $conn = new mysqli("localhost", "root", "", "danis");

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

function intToRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function DateNUll($tanggal)
{
    if ($tanggal != NULL && $tanggal != '0000-00-00') {
        return $tanggal;
    } else {
        return '';
    }
}
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
    header("Content-Disposition: attachment; filename=Laporan data Pencatatan Penggunaan.xls");
    ?>

    <center>
        <h1>Laporan Data Pencatatan Penggunaan </h1>
    </center>

    <table border="1">
        <tr class='text-center'>
            <th>PEMASANGAN</th>
            <th>NOMOR PASANG</th>
            <th>NILAI STAND METER</th>
            <th>FOTO STAND METER</th>
        </tr>
        <?php
        $pencatat = 'SELECT  pemasangan.id_pelanggan, pencatatan_penggunaan.nomor_pasang, pencatatan_penggunaan.nilai_stand_meter, pencatatan_penggunaan.foto_stand_meter, pencatatan_penggunaan.id_pencatatan FROM pencatatan_penggunaan 
                    LEFT JOIN pemasangan ON pencatatan_penggunaan.id_pemasangan = pemasangan.id_pemasangan ORDER BY pemasangan.id_pemasangan DESC';
        foreach (QueryManyData($pencatat) as $row) {
            $pel = QueryOnedata('SELECT * FROM pelanggan where id_pelanggan = ' . $row['id_pelanggan'] . '')->fetch_assoc();
        ?>
            <tr>
                <td>
                    <?= $pel['nm_pelanggan'] ?>
                </td>
                <td><?= $row['nomor_pasang'] ?></td>
                <td><?= $row['nilai_stand_meter'] ?></td>
                <td><?= $row['foto_stand_meter'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>