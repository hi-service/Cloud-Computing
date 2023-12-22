<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/status.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
function cancelFunction(order_id,status){
        var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('service/auth_status') ?>';
        var params = 'order_id='+ order_id +'&status='+ status;
        http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            location.href = window.location.href;
        }
    }
    http.send(params);
    
}
function finishFunction(user_id){
        var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('service/auth_status') ?>';
        var params = 'id_user='+ user_id;
        http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            location.href = '<?= base_url('') ?>';
        }
    }
    http.send(params);
    
}
    </script>

</head>
<body>

    
    <div class="container">

    <span class=back-btn>
    <a href= <?= base_url('service/dashboard')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    
      <?php if($data_order['status'] == 'waiting'){?>
        <div class="flex-card">
          <span class="rotate-icon">
          <i class="fa fa-spinner" style='font-size:70px;margin-bottom:10px;'></i>
            </span>
        <p>Status : Menunggu bengkel menerima layanan</p>
        </div>
        <?php }elseif($data_order['status'] == 'ongoing'){?>
          <div class="flex-card">
          <span class="rotate-icon">
          <i class="bi bi-gear" style='font-size:70px;margin-bottom:10px;'></i>
            </span>
        <p>Status : Layanan Sedang Berjalan</p>
        </div>
        <?php }elseif($data_order['status'] == 'finished'){?>
          <div class="flex-card">
          <i class="bi bi-check" style='font-size:70px;'></i>
        <p>Status : Layanan Selesai</p>
        </div>
        <?php }elseif($data_order['status'] == 'rejected'){?>
          <div class="flex-card">
          <i class="bi bi-x" style='font-size:70px;'></i>
        <p>Status : Layanan Ditolak</p>
        </div>
    <?php }?>
    
   

    <div class="desc-card">
      <h3 style="margin:0"> Order ID : #<?php echo $id_order['last_order_id'];?></h3>
      <span class="info-card">
        <p>Lihat Deskripsi Order : </p>
          <button class="btn-info" onclick="descFunction()">
          <i class="bi bi-info-circle"></i>
        </button>
    </span>
    
    </div>
    <?php if($data_order['status'] == 'waiting'){?>
      <button class="btn-submit" type="submit" onclick="cancelFunction(<?php echo $id_order['last_order_id'];?>,'rejected');" value="Submit"><i class="bi bi-x-lg" style="display:flex;align-items:center;padding-right:10px;color:red;"></i>Batalkan Pesanan</button>
        <?php }elseif($data_order['status'] == 'finished'){?>
      <button class="btn-submit" type="submit" value="Submit" onclick="finishFunction(<?php echo session()->get('id_user')?>);" value="Submit"><i class="bi bi-check2" style="font-size:20px;display:flex;align-items:center;padding-right:10px;color:#34d834;"></i>Order Layanan Lain</button>
      <?php }elseif($data_order['status'] == 'rejected'){?>
      <button class="btn-submit" type="submit" value="Submit" onclick="finishFunction(<?php echo session()->get('id_user')?>);" value="Submit"><i class="bi bi-search" style="font-size:20px;display:flex;align-items:center;padding-right:10px;color:#D83434;"></i>Order Layanan Lain</button>
        <?php }?>
        

</div>
<script>
  function descFunction(){
    Swal.fire(
  'INFO ORDER',
  '<h3>Nama Bengkel</h3> <p> <?php echo $data_order['nama_bengkel']?></p>'+
  '<h3>Waktu Order</h3> <p> <?php echo $data_order['waktu']?></p>'+
  '<h3>No.WA anda</h3> <p> <?php echo $data_order['nohp']?></p>'+
  '<h3>Alamat Anda</h3> <p> <?php echo $data_order['address']?></p>'+
  '<h3>Deskripsi / Keluhan</h3> <p> <?php echo $data_order['deskripsi']?></p>',
  'info'
)
  }

    </script>
</body>
    