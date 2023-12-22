<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/admin/inventory.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function imageFunction($img){
                    Swal.fire({
        title: 'Foto barang!',
        imageUrl: $img,
        })
        }
        function updateFunction(id_barang,nm_barang,qty,hrg){
            Swal.fire({
            title: 'Update Data',
            html: `<input type="text" id="nama_barang" class="swal2-input" placeholder="`+nm_barang+`">`+
            `<input type="number" id="qty" class="swal2-input" placeholder="`+qty+`">` +
            `<input type="number" id="harga" class="swal2-input" placeholder="`+hrg+`">`,
            confirmButtonText: 'Submit',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                const nama_barang = Swal.getPopup().querySelector('#nama_barang').value
                const qty = Swal.getPopup().querySelector('#qty').value
                const harga = Swal.getPopup().querySelector('#harga').value
                var http = new XMLHttpRequest();
                var currentLocation = window.location;
                let url = '<?= base_url('admin/update_item') ?>';
                var params = 'id_barang=' + id_barang + '&nama_barang='+ nama_barang 
                + '&qty_barang='+ qty + '&harga_barang='+ harga ;
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
            })
        }
        function deleteFunction(id_barang){
                var http = new XMLHttpRequest();
                var currentLocation = window.location;
                let url = '<?= base_url('admin/delete_item') ?>';
                var params = 'id_barang=' + id_barang;
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

    </script>

</head>
<body>
    <div class="container">
    <h3>Selamat Datang, <?php echo session()->get('nama_bengkel_admin')?> !</h3>
    <button class="btn-submit" type="submit" id="add-btn" onclick="onClickAdd();" value="Submit"><i class="bi bi-plus-lg"  style="display:flex;align-items:center;padding-right:10px;color:white;"></i>Tambah Barang</button>
    <form id="form-additem" action="./add_item" method="post" enctype="multipart/form-data">
        <label for="nama-barang">Nama Barang :</label>
        <input type="text" name="nama_barang" id="nama-barang">
        <label for="qty-barang">Jumlah Barang :</label>
        <input type="number" name="qty_barang" id="qty-barang">
        <label for="harga-barang">Harga Barang :</label>
        <input type="number" name="harga_barang" id="harga-barang">
        <input type="file" name="userfile">
        <input type="submit" name="submit" value="Submit">
    </form>
    <h3>Daftar Barang Pada Bengkel Anda</h3>
    <table>
  <tr>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Gambar Barang</th>
    <th>Stok</th>
    <th>Harga</th>
    <th>Aksi</th>

  </tr>
  
  <?php 
    for($i=0; $i<count($data_item); $i++){
  ?>
  
    <tr>
        <td><?php echo $data_item[$i]['id_barang']?></td>
        <td><?php echo $data_item[$i]['nama_barang']?></td>
        <td>
            <i onclick="imageFunction('<?= base_url('uploads/img/items/') ?><?php echo $data_item[$i]['image']?>')" class="bi bi-eye"></i>
        </td>
        <td><?php echo $data_item[$i]['qty']?></td>
        <td><?php echo $data_item[$i]['price']?></td>
        <td>
        <i onclick="updateFunction(<?php echo $data_item[$i]['id_barang'] . ',\'' . $data_item[$i]['nama_barang'] . '\',' .$data_item[$i]['qty'] . ','. $data_item[$i]['price']?>);"class="bi bi-database-gear"></i>
         | 
         <i onclick="deleteFunction(<?php echo $data_item[$i]['id_barang']?>);"class="bi bi-trash"></i>
        </td>
    </tr>
    <?php }?>
</table>
    
    </div>
    <script>
    const body = document.querySelector("body");
    const toggle = body.querySelector(".toggle");
    const nav = body.querySelector(".sidebar");
    const contents = body.querySelector(".container");
    const forms =document.getElementById('form-additem');
    var visible =false
    function onClickAdd(){
        if(visible){
        forms.style.visibility = 'hidden';
        forms.style.position = 'absolute';
        visible = false;
        }else{
        forms.style.visibility = 'visible';
        forms.style.position = 'relative';
        visible = true;

        }

    }
    toggle.addEventListener("click", () =>{
        nav.classList.toggle("close");
    contents.classList.toggle("close");
})

    </script>    
</body>
</html>