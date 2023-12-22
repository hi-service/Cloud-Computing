<?php 
$page = str_replace("http://localhost/f-lomba/public/index.php/","",$data);;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialize-scale=1.0">
    <!------------------------------------------>
    <title>Hi - Service ~ Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href= <?= base_url('/assets/admin/sidebar.style.css') ?>> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">


</head>

<body>
    <nav class="sidebar">
        
    <header>
            <i class="fa fa-angle-right toggle" aria-hidden="true"></i>
        <div class="img_logo">
            <i style="font-size:48px;color: red;" id= "icon_person"class="fa fa-user-circle" aria-hidden="true"></i>
            <span>
            <h1 class="text">Selamat Datang Di </h1>
            <p class="text">Sistem Manajemen  Hi <p class="text" style="color:red;">Service</p></p>
        </span>
        </div>
    </header>
    <div class="menu-bar">
    <ul class="menu-link">
        <li class="<?php if(strcmp($page,'admin') == 0){echo 'nav-links active';}else{echo 'nav-links';}?>">
        <a href=<?= base_url('admin/') ?>>
                <i class="bi bi-house-door links"></i>
                <span class="text nav-text">Dashboard</span>
            </a>
        </li>
        <li class="<?php if(strcmp($page,'admin/order') == 0){echo 'nav-links active';}else{echo 'nav-links';}?>">
            <a href=<?= base_url('admin/order') ?>>
                <i class="bi bi-file-earmark-check links"></i>
                <span class="text nav-text">Layanan</span>
            </a>
        </li>
        <li class="<?php if(strcmp($page,'admin/inventory') == 0){echo 'nav-links active';}else{echo 'nav-links';}?>">
        <a href=<?= base_url('admin/inventory') ?>>
                <i class="bi bi-cart3 links"></i>
                <span class="text nav-text">Barang</span>
            </a>
            </li>
        <li class="<?php if(strcmp($page,'admin/order_item') == 0){echo 'nav-links active';}else{echo 'nav-links';}?>">
        <a href=<?= base_url('admin/order_item') ?>>
                <i class="bi bi-cart-check links"></i>
                <span class="text nav-text">Daftar Order Barang</span>
            </a>
        </li>
        </li>
        <li class="<?php if(strcmp($page,'admin/customer_service') == 0){echo 'nav-links active';}else{echo 'nav-links';}?>">
        <a href=<?= base_url('admin/customer_service') ?>>
                <i class="bi bi-chat-dots links"></i>
                <span class="text nav-text">Customer Service</span>
            </a>
        </li>
    </ul>
    <div class="logout_btn">
    <a href="<?= base_url('admin/logout') ?>">
    <span id="btn_logout" >
    <i style="font-size: 20px;color:black"class="bi bi-box-arrow-in-left"></i>
     <p style="font-family: 'DM Sans', sans-serif; color:black;"class="text nav-text">Sign Out</p>
    </span>
    </a>
    </div>
</nav>
</div>



    </script>
</body>


</html>