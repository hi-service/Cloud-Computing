<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih bengkel!</title>
    <link rel="stylesheet" href=<?= base_url('assets/service.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
</head>
<body>
<div class="floating-profile">
    <div class="dropdown">
      <a class="profile-icon" href="#" onclick="toggleDropdown()">
        <i class="bi bi-person-circle"></i>
      </a>
      <div class="dropdown-menu" id="dropdownMenu">
        <a href="#">Atur Profil</a>
        <a href= <?= base_url('login/logout')?>  >Logout</a>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function toggleDropdown() {
      var dropdownMenu = document.getElementById("dropdownMenu");
      dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
    }
  </script>
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
        <h3>Cari bengkel pilihan anda</h3>

        <?php 
           $id_bengkel = array_column($garageData, 'id_bengkel');
           $nama_bengkel = array_column($garageData, 'nama_bengkel');
           $jarak = array_column($garageData, 'jarak');
           $alamat = array_column($garageData, 'alamat_bengkel');
           
        for($i=0;$i<count($jarak);$i++){
        ?>
        <div class="flex-card">
            <span class="img-card">
                <img src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg" alt="">
            </span>
            <span class="card-content">
                <h3><?= $nama_bengkel[$i] ?></h3>
                <p><?= $alamat[$i] ?></p>
                <h4><i class="bi bi-geo-alt" style="padding-right: 10px;color:rgb(88 88 88);"></i><?= $jarak[$i] ?> km</h4>
                <a class="btn-submit" href= <?= base_url('service/auth') . "?loc_id=" . $id_bengkel[$i]?> >
                <i class="bi bi-check2-circle" style="display:flex;align-items:center;padding-right:10px;color:red;" ></i>Lanjut Ke Layanan
                </a>
            </span>
        </div>
        
        <?php }?>
       
    </div>
    <p>Lokasi Anda Saat Ini : <?= $address ?></p>
    
</body>
  <!-- Sertakan library jQuery dan Bootstrap JS -->

</html>