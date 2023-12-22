<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/admin/dashboard.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
</head>
<body>
    <div class="container">
    <h3>Selamat Datang, <?php echo session()->get('nama_bengkel_admin')?> !</h3>
    <div class="data">
    <div class="data-attr">
    <i class="bi bi-clock-history"></i>
    <p>Total Order</p>
    <p class="text-data"><?php echo $allData;?></p>
    </div>
    <div class="data-attr">
    <i class="bi bi-hourglass-split"></i>
    <p>Total Order Menunggu</p>
    <p class="text-data"><?php echo $waitingData;?></p>
    </div>
    <div class="data-attr">
    <i class="bi bi-calendar-check"></i>
    <p>Total Order Selesai</p>
    <p class="text-data"><?php echo $completeData;?></p>
    </div>
    </div>
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