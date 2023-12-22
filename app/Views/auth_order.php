<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/auth_order.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
    <span class=back-btn>
    <a href= <?= base_url('')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h3>Detail Order Anda</h3>
        <h3>ID ORDER : # <?= $id_order ?></h3>
        <table style="max-width:100%">
            <tr>
                <td style="width:150px;">Nama</td>
                <td> : <?= $nama_user ?></td>
            </tr>
            <tr>
                <td>Nama Bengkel</td>
                <td> : <?= $nama_bengkel ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td> : <?= $alamatuser ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td> : <?php date_default_timezone_set('Asia/Jakarta'); echo (new DateTime())->format("Y-m-d H:i:s"); ?></td>
            </tr>
            <tr>
                <td>No.HP</td>
                <td> : <?= $no_hp ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Deskripsi</td>
                <td> : <?= $deskripsi ?></td>
            </tr>
        </table>
</body>
</html>