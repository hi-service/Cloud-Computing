<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/admin/order.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
function waFunction(nohp) {
  // Lakukan sesuatu dengan parameter
  
  window.open('https:/wa.me/' + nohp)
}
function locFunction(lat,lng) {
    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
    width=500,height=500,left=100,top=100`;

    open('<?= base_url('/map.php') ?>' + '?lat=' +lat +'&lng=' + lng, 'test', params);
}
function chatFunction(id_order) {

    open('<?= base_url('admin/cs_order_page') ?>'+'?id_order=' +id_order);
}
function swalSuccess(id_order,fcm_token){
            Swal.fire({
            title: 'Konfirmasi Order',
            html: `<input type="text" id="km_awal" class="swal2-input" placeholder="Kilo meter awal">`+
            `<input type="number" id="km_akhir" class="swal2-input" placeholder="KM selanjutnya">`,
            confirmButtonText: 'Submit',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                const km_awal = Swal.getPopup().querySelector('#km_awal').value
                const km_akhir = Swal.getPopup().querySelector('#km_akhir').value
                var http = new XMLHttpRequest();
                var currentLocation = window.location;
                let url = '<?= base_url('admin/setNextOrderKM') ?>';
                var params = 'order_id=' + id_order
                + '&km_sebelum='+ km_awal + '&km_sesudah='+ km_akhir ;
                http.open('POST', url, true);
                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    orderFunction(id_order,"finished",fcm_token)
                    }
                    }
                http.send(params);
                }
            })
        }

function orderFunction(order_id,status,token){
    var url = 'https://fcm.googleapis.com/fcm/send';
    var message = 'pesan';
    var title = 'Status Pesanan'
    var serverKey = 'AAAArnzS8s0:APA91bGSbl37exHLL7fAKziUderm2q3vrDpw3CqYPEBxkz2v61VSGr3UDm1NLaSuucg0dYeXIbpZ_3_qZgiUUvYn84Fjvz6xusnQhzf_mZsmeST97o9iphXeHSeCwopo-lnP5yyW1RP_'; 
    if(status==='ongoing'){
        title="Status pesanan telah diterima"
        message = "Pesanan anda telah diterima oleh bengkel, mohon tunggu karyawan mitra akan tiba sesaat lagi."
    }else if(status==='rejected'){
        title="Status pesanan telah ditolak"
        message = "Mohon maaf, pesanan anda ditolak oleh bengkel. Silahkan pilih bengkel lain yang tersedia di aplikasi."
    }else if(status==='finished'){
        title="Status pesanan telah selesai"
        message = "Horeee, pesanan telah selesai. Silahkan Konfirmasi pesanan dan berikan rating sesuai dengan pelayanan yang diberikan oleh bengkel mitra.\nJika anda merasa layanan belum terselesaikan, silahkan hubungi Customer Service Kami."
    }
    var headers = {
        'Authorization': 'key=' + serverKey,
        'Content-Type': 'application/json'
    };

    var notification = {
        'title': title,
        'body': message,
        'sound': 'default'
    };

    var data = {
        'notification': notification,
        'data': {
            'order_id': order_id,
            'status': status
        },
        'to': token // Replace with the FCM token of the user's device
    };

    var payload = {
        'headers': headers,
        'json': data
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);

    for (var key in payload.headers) {
        if (payload.headers.hasOwnProperty(key)) {
            xhr.setRequestHeader(key, payload.headers[key]);
        }
    }

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var result = xhr.responseText;
                var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('admin/auth_order') ?>';
        var params = 'order_id='+ order_id +'&status='+ status;
        http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    location.href = window.location.href;
                }
            }
            http.send(params);
            } else {
                console.error('FCM request failed with status: ' + xhr.status);
            }
        }
    };

    xhr.onerror = function () {
        console.error('Network error occurred while sending FCM request');
    };

    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(payload.json));
    
}

function descFucntion(address,description) {
    Swal.fire(
  'Detail Pesanan',
  '<h3 style="color:black;margin:0;"> Alamat Pengorder </h3>' + address + '<h3 style="color:black;margin:0;"> Deskripsi </h3>' + description,
  'info'
)
}

    </script>

</head>
<body>
    
    <div class="container">
    <h3>Selamat Datang, <?php echo session()->get('nama_bengkel_admin')?> !</h3>
        <?php 
           $order_id = array_column($orders, 'order_id');
           $nama = array_column($orders, 'nama');
           $nohp = array_column($orders, 'nohp');
           $waktu = array_column($orders, 'waktu');
           $lat = array_column($orders, 'lat');
           $lng = array_column($orders, 'lng');
           $description = array_column($orders, 'deskripsi');
           $address = array_column($orders, 'address');
           $status = array_column($orders, 'status');
           $fcm_token = array_column($orders, 'fcm_token');
           
        for($i=0;$i<count($order_id);$i++){
        ?>
        <div class="order-card">
            <p>Order ID : <?php echo $order_id[$i]?></p>
            <p>Nama Pengorder : <?php echo $nama[$i]?></p>
            <p>Waktu Order : <?php echo $waktu[$i]?></p>
            <p>Detail : </p>
            <div class="button-card">
            <button class='wa-btn'type="button" onclick="waFunction(<?php echo $nohp[$i] ?> );">
                <i style="color:#25D366" class="bi bi-whatsapp"></i>
                WA Pengorder
            </button>
            <button class='loc-btn' type="button" onclick="locFunction(<?php echo $lat[$i] ?>,<?php echo $lng[$i] ?>)">
                <i style="color:red" class="bi bi-pin-map"></i>
                Lokasi Order
            </button>
            <button class='desc-btn' type="button" onclick="descFucntion('<?php echo $address[$i]?>','<?php echo $description[$i]?>')">
                <i style="color:#FFFFFF"class="bi bi-info-circle"></i>
                Detail Lebih 
            </button>
            <button class='desc-btn' type="button" onclick="chatFunction(<?php echo $order_id[$i] ?>)">
                <i style="color:#FFFFFF"class="bi bi-info-circle"></i>
            </button>
            </div>
            <div class='acc-card'>
                <?php if($status[$i]=='waiting') {?>
                    <button class='acc-btn' type="button" onclick="orderFunction('<?php echo $order_id[$i]?>','ongoing','<?php echo $fcm_token[$i]?>');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Terima Order
                </button>
                <button class='reject-btn' type="button" onclick="orderFunction('<?php echo $order_id[$i]?>','rejected','<?php echo $fcm_token[$i]?>');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Tolak Order
                </button>
            <?php }elseif($status[$i]=='ongoing'){?>
                <button class='acc-btn' type="button" onclick="swalSuccess('<?php echo $order_id[$i]?>','<?php echo $fcm_token[$i]?>');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Selesai
                </button>
            <?php }elseif($status[$i]=='finished'){?>
                    Order telah diselesaikan
            <?php }elseif($status[$i]=='rejected'){?>
                    Order ditolak oleh bengkel
        <?php }elseif($status[$i]=='canceled'){?>
                    Dibatalkan Oleh Pelanggan
        <?php }?>
        
            </div>
            </div>
            <?php }?>
        
    </div>
    
</body>
<script>
    const body = document.querySelector("body");
    const toggle = body.querySelector(".toggle");
    const nav = body.querySelector(".sidebar");
    const contents = body.querySelector(".container");
    toggle.addEventListener("click", () =>{
        nav.classList.toggle("close");
    contents.classList.toggle("close");

})

    </script>
  <!-- Sertakan library jQuery dan Bootstrap JS -->

</html>