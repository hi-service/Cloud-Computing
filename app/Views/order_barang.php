<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/items.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        var arr_barang = {
            id: [],
            qty: []

        };
        function tambahData(id){
            var input = document.getElementById('barang'+id);
            if(input.value == 0){
                input.value=1;
                arr_barang.id.push(id)
                arr_barang.qty.push(input.value)
                
            }else{
                input.value++;
                arr_barang.id.forEach(function (elemen, indeks) {
                if (elemen === id) {
                    arr_barang.qty[indeks] = input.value; // Mengubah nilai
                }
                });
            }
        }
        function kurangData(id){
            var input = document.getElementById('barang'+id);
            if(input.value == 0){
                input.value=0;
            }else{
                input.value--;

                if(input.value == 0){
                arr_barang.id.forEach(function (elemen, indeks) {
                if (elemen === id) {
                    arr_barang.qty.splice(indeks,1)
                    arr_barang.id.splice(indeks,1)
                }
                });
                }else{
                    arr_barang.id.forEach(function (elemen, indeks) {
                if (elemen === id) {
                    arr_barang.qty[indeks] = input.value; // Mengubah nilai
                }
                });
                } 
            
            }
        }
        function onClickOrder(){
            for(i=0;i<arr_barang.id.length;i++){
            var http = new XMLHttpRequest();
            let url = '<?= base_url('service/set_invoice') ?>';
            var params = 'id_barang=' + arr_barang.id[i] + '&qty='  + arr_barang.qty[i];
            http.open('POST', url, true);
            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
            http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                location.href = './get_invoice'
            }
            }
            http.send(params);
            }
            
             
        }
        
    </script>
</head>
<body>
  </script>
    <div class="container">
    
    <span class=back-btn>
    <a href= <?= base_url('service/dashboard')?> >
    <i class="bi bi-backspace"></i>
    Back
    </span>
    </a>
    <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h3>Cari barang di bengkel</h3>
        <?php 
        $var_j = 0;
        $hasil =  intval(count($itemData) / 3);
        $sisa = count($itemData) % 3;
        if($sisa = 0){
            $jumlah_loop = $hasil;
        }else{
            $jumlah_loop = $hasil+1;
        }
        for($i=0;$i<$jumlah_loop;$i++){?>
    <div class='item-place'>
            <?php while($var_j<count($itemData)){?>
        <div class="item-card">
            <img src="<?= base_url('uploads/img/items/') ?><?php echo $itemData[$var_j]['image']?>" alt=""> 
            <label> Stok : <?php echo $itemData[$var_j]['qty']?></label>
            <label> Harga : <?php echo number_format($itemData[$var_j]['price'],2,',','.')?></label>
            <span> 
            <i onclick= "kurangData(<?php echo $itemData[$var_j]['id_barang']?>);"class="bi bi-dash-square-dotted"></i>
            <input type="text"  id="<?php echo "barang" . $itemData[$var_j]['id_barang']?>" readonly> 
            <i onclick="tambahData(<?php echo $itemData[$var_j]['id_barang']?>);" class="bi bi-plus-square-dotted"></i>
            </span>
        </div>
        <?php 
        $var_j++;
        if($var_j%3==0){
            break;
        }
        }?>
    </div>
    <?php }?>
       <button onclick="onClickOrder();"type="button" class="button-order" style="color: black;" ><i class="bi bi-cart"></i>
 Proses Untuk Checkout</button> 
    </div>

    
</body>
  <!-- Sertakan library jQuery dan Bootstrap JS -->

</html>