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
                <td> : <?= session()->get('name') ?></td>
            </tr>
            <tr>
                <td>Nama Bengkel</td>
                <td> : <?= session()->get('nama_bengkel') ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td> : <?= session()->get('address') ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td> : <?php date_default_timezone_set('Asia/Jakarta'); echo (new DateTime())->format("Y-m-d H:i:s"); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td> : <?= $detail['shipping']; ?></td>
            </tr>
        </table>
        <div class='nota-barang'>
        <table >
  <tr>
    <th>No.</th>
    <th>Nama Barang</th>
    <th>Kuantiti</th>
    <th>Harga</th>
    <th>Total Harga</th>
  </tr>
  
  <?php 
  $total = 0;
  for($i = 0;$i<count($detail_item);$i++)
  {?>
  <tr>
    <td><?php echo (($i + 1)) ?></td>
    <td><?php echo $detail_item[$i]['nama_barang']?></td>
    <td><?php echo $detail_item[$i]['qty']?></td>
    <td><?php echo $detail_item[$i]['price']?></td>
    <td><?php echo (int)$detail_item[$i]['price'] * (int)$detail_item[$i]['qty'];?></td>
  </tr>
  
  <?php $total=$total+ (int)$detail_item[$i]['price'] * $detail_item[$i]['qty'];}?>
  <tr>
            <td colspan="4">Grand Total</td>
            <td><?php echo $total?></td>
  </tr>
  </table>
  </div>
</body>
</html>