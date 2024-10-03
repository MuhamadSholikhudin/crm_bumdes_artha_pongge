<?php 
include '../../config/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMASANGAN </title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>
                    <div id="qrcode"></div>
                </th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php 
                $query = 'SELECT * FROM pelanggan LEFT JOIN pemasangan ON pelanggan.id_pelanggan = pemasangan.id_pelanggan WHERE pemasangan.id_pemasangan = "'.$_GET['id_pemasangan'].'" ';
                $pelanggan = QueryOnedata($query)->fetch_assoc();
            ?>  
            <tr>
                <td>
                    CODE : <?= $_GET['id_pemasangan'] ?>              
                </td>
            </tr>
            <tr>
                <td>
                    PELANGGAN : <?= $pelanggan['nm_pelanggan'] ?>              
                </td>
            </tr>
        </tbody>
    </table>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        const qrCodeContainer = document.getElementById('qrcode');
        new QRCode(qrCodeContainer, {
                text: "<?= $_GET['id_pemasangan'] ?>",
                width: 200,
                height: 200
        });

        window.print();
    </script>
</body>
</html>
