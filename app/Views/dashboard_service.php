<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href=<?= base_url('assets/dashboard.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
    function onClickPesan() {
        window.location.href = "./order"; 
    }
    function onClickConvers() {
        window.location.href = "./conversation"; 
    }
    function onClickBarang() {
        window.location.href = "./order_barang"; 
    }
    </script>
</head>
<body>
        <span class=back-btn>
            <a href= <?= base_url('')?> >
            <i class="bi bi-backspace"></i>
            Back
            </span>
            </a>
    <div class="container">
        <div class="id-card">
        
        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxjb2xsZWN0aW9uLXBhZ2V8MXw3NjA4Mjc3NHx8ZW58MHx8fHx8&w=1000&q=80" alt="Avatar">
        <h3>Hello, <?= session()->get('name'); ?></h3>   
        <div class="attr-container">
            
            <h4 style="margin-top:10px">
            <i class="bi bi-phone"></i>
            Nomor Telp.
            <h4 style="margin-left:11%"> <?= session()->get('nohp'); ?></h4>
            </h4>
            
            <h4 style="margin-top:10px">
            <i class="bi bi-pin-map"></i>
            Bengkel Yang Dipilih.
            <h4 style="margin-left:11%"> <?= session()->get('nama_bengkel'); ?></h4>
            </h4>
            <h4 style="margin-top:10px">
            <i class="bi bi-exclamation-circle"></i>
            Status Order
            <h4 style="margin-left:11%"> <?= session()->get('status_order'); ?></h4>
            </h4>
            <h4 style="margin-top:10px">
            <i class="bi bi-exclamation-circle"></i>
            Status Buy Order
            <h4 style="margin-left:11%"> <?= session()->get('status_buy_order'); ?></h4>
            </h4>
        </div> 
        <a class="btn-logout" href=<?= base_url('login/logout') ?>>
        <i class="bi bi-arrow-bar-left" style="margin-top: 5px;padding-right:10px"></i> Logout
        </a>
    </div>
        <div class="sleep-card">

            <div onclick="onClickPesan();" class="flex-box">
            <i class="bi bi-house-gear"></i>
            <p> Pesan Layanan </p>
            </div>
            <div onclick="onClickBarang();"class="flex-box">
            <i class="bi bi-bag-check"></i>
            <p> Beli Barang </p>
            </div>

            <div onclick="onClickConvers();"class="flex-box">
            <i class="bi bi-send"></i>
            <p> Customer Service </p>
            </div>
        </div>
    </div>
</body>
</html>
