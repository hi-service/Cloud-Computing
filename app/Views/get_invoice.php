<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/get_invoice.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
      function pickClick(){
        var pickCheck =document.getElementById('pickup');
        pickCheck.checked =true;
      }
      function shipClick(){
        var shipCheck =document.getElementById('shipping');
        shipCheck.checked =true;
    }
    function postData(){
      var pickCheck =document.getElementById('pickup');
      if(pickCheck.checked =true){
        var shipping = 'delivery'
      }else{
        var shipping = 'pickup'
      }
      var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('service/set_invoice_status') ?>';
        var params = 'shipping=' + shipping;
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            location.href = '<?= base_url('service/print_invoice') ?>';
        }
        }
        http.send(params);
            
    }
    </script>
</head>
<body>
    <div class="container">
    
    <span class=back-btn>
    <a href= <?= base_url('service/order_barang')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h3> Pesanan Anda </h3>
        <table>
  <tr>
    <th>No.</th>
    <th>Nama Barang</th>
    <th>Kuantitas</th>
    <th>Harga</th>
    <th>Total Harga</th>
  </tr>
  
  <?php 
  $total = 0;
  for($i = 0;$i<count($qty);$i++)
  {?>
  <tr>
    <td><?php echo (($i + 1)) ?></td>
    <td><?php echo $detail_item[$i]['nama_barang']?></td>
    <td><?php echo $qty[$i]?></td>
    <td><?php echo $detail_item[$i]['price']?></td>
    <td><?php echo (int)$detail_item[$i]['price'] * (int)$qty[$i]?></td>
  </tr>
  
  <?php $total=$total+ (int)$detail_item[$i]['price'] * (int)$qty[$i];}?>
  <tr>
            <td colspan="4">Grand Total</td>
            <td><?php echo $total?></td>
  </tr>
  </table>
  <span onclick="shipClick()" class='radio-box'>
    <input type="radio" name="shipping" id="shipping">
    <i class="bi bi-truck"></i>
    <p>Kirim ke rumah anda</p><br>

  </span>
  <span onclick="pickClick()"class='radio-box'>
  <input type="radio" name="shipping" id="pickup" >
    <i class="bi bi-house-gear"></i>
    <p>Ambil di bengkel</p>
  </span>
  <button class="btn-submit" type="submit" value="Submit" onclick="postData()" value="Submit"><i class="bi bi-cart-check" style="font-size:20px;display:flex;align-items:center;padding-right:10px;color:#34d834;"></i>Konfirmasi Pesanan</button>
    </div>
    
</body>
<script>
      var shipCheck =document.getElementById('shipping');
      shipCheck.checked =true;
</script>

</html>