<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/admin/order_item.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function orderFunction(order_id,status){
        var http = new XMLHttpRequest();
        var currentLocation = window.location;
        let url = '<?= base_url('admin/update_order_status') ?>';
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
    
}
        function waFunction(nohp) {
        window.open('https:/wa.me/' + nohp)
        }
        function locFunction(lat,lng) {
            let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
            width=500,height=500,left=100,top=100`;

            open('<?= base_url('/map.php') ?>' + '?lat=' +lat +'&lng=' + lng, 'test', params);
        }
        
        function descFunction(id){
            var barang = 'invoice'+id
            
        var desc =document.getElementById(barang).value;
            Swal.fire({
  title: 'Data Table',
  html: desc,
  confirmButtonText: 'OK'
});
        }
    </script>

</head>
<body>
    
    <div class="container">
    <h3>Selamat Datang, <?php echo session()->get('nama_bengkel_admin')?> !</h3>
    <?php 
    use App\Models\Admin_Model;
    $item_model = new Admin_Model();
    for($j=0;$j<count($invoiceStatus);$j++){?>
    <div class="order-card">
    <p>Order ID : <?php echo $invoiceStatus[$j]['id_order']?></p>
    <p>Nama Pengorder : <?php echo $invoiceStatus[$j]['nama']?></p>
    <p>Waktu Order : <?php echo $invoiceStatus[$j]['waktu']?></p>
    <p>Jenis Order : <?php echo $invoiceStatus[$j]['shipping']?></p>
    <p>Detail : </p>
    <?php 

    $data_item = $item_model->getItemOrder($invoiceStatus[$j]['id_order']);
    $dataContent = '<table>';
    $dataContent .= '<tr>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                        </tr>';
        $harga = 0;
        $hargatotal = 0;
        for($i=0;$i<count($data_item);$i++){
            $harga = (int)$data_item[$i]['price'] * $data_item[$i]['qty'];
            $hargatotal += $harga;
                $dataContent .= '<tr>';
                $dataContent .= '<td>' . $data_item[$i]['nama_barang'] . '</td>';
                $dataContent .= '<td>' . $data_item[$i]['qty'] . '</td>';
                $dataContent .= '<td>' . $data_item[$i]['price'] . '</td>';
                $dataContent .= '<td>' . $harga  . '</td>';
                $dataContent .= '</tr>';
        }
    $dataContent .= '<tr>';
    $dataContent .= '<td colspan="3">Grand Total</td>';
    $dataContent .= '<td>' .$hargatotal . '</td>';
    $dataContent .= '<tr>';
    $dataContent .= '</table>';
    $dataContent .= '<p style="color:black"> Lokasi Customer : ' . $invoiceStatus[$j]['address'] .'</p>';
    ?>
    <div class="button-card">
        
            <button class='wa-btn'type="button" onclick="waFunction(<?php echo $invoiceStatus[$j]['nohp'] ?> );">
                <i style="color:#25D366" class="bi bi-whatsapp"></i>
                WA Pengorder
            </button>
            <button class='loc-btn' type="button" onclick="locFunction(<?php echo $invoiceStatus[$j]['lat'] ?>,<?php echo $invoiceStatus[$j]['lng']?>)">
                <i style="color:red" class="bi bi-pin-map"></i>
                Lokasi Pengorder
            </button>
            <textarea id="<?php echo 'invoice' .  $invoiceStatus[$j]['id_order']?>" style="display: none;" ><?php echo $dataContent;?></textarea>
            <button class='desc-btn' type="button" onclick="descFunction(<?php echo $invoiceStatus[$j]['id_order']?>)">
                <i style="color:#FFFFFF"class="bi bi-info-circle"></i>
                Detail Lebih 
            </button>
    </div>
    <div class='acc-card'>
                <?php if($invoiceStatus[$j]['status']=='waiting') {?>
                    <button class='acc-btn' type="button" onclick="orderFunction('<?php echo $invoiceStatus[$j]['id_order']?>','prepared');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Terima Order
                </button>
                <button class='reject-btn' type="button" onclick="orderFunction('<?php echo $invoiceStatus[$j]['id_order']?>','rejected');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Tolak Order
                </button>
            <?php }elseif($invoiceStatus[$j]['status']=='prepared'){?>
                <button class='acc-btn' type="button" onclick="orderFunction('<?php echo $invoiceStatus[$j]['id_order']?>','ready');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Kirim Barang
                </button>
            <?php }elseif($invoiceStatus[$j]['status']=='ready' && $invoiceStatus[$j]['shipping']=='delivery'){?>
                <button class='acc-btn' type="button" onclick="orderFunction('<?php echo $invoiceStatus[$j]['id_order']?>','finished');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Pesanan Telah Dikirim
                </button>
            <?php }elseif($invoiceStatus[$j]['status']=='ready' && $invoiceStatus[$j]['shipping']=='pickup'){?>
                <button class='acc-btn' type="button" onclick="orderFunction('<?php echo $invoiceStatus[$j]['id_order']?>','finished');">
                    <i style="color:#FFFFFF;padding-right:10px;font-size:20px"class="bi bi-check2-circle"></i>
                    Pesanan Telah Diambil
                </button>
            <?php }elseif($invoiceStatus[$j]['status']=='finished'){?>
                    SELESAI
            <?php }elseif($invoiceStatus[$j]['status']=='rejected'){?>
                    DITOLAK
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