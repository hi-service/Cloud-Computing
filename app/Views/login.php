<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Login</title>
   <link rel="stylesheet" href=<?= base_url('assets/login.style.css') ?>>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   <div class="container">
      <h2 id="text-login">Masuk menggunakan akun anda</h2>
      <p id="sub-text">Masuk ke akun anda untuk menggunakan layanan</p>
      <p id="service-text"> Hi! <p id="service-text" style="color:red;"> Service </p></p>
      <?php
    if(session()->getFlashData('gagal')){
    ?>
      <span class="login-alert" style="background-color:red">
         <p style="color:red;font-size:20px">Login gagal! Username/Password Salah</p>
      </span>
      <?php
    }
    ?>
      <form class="input-frame" action=<?= base_url('login/login_action') ?> method="post">
      <input type="text" id="username" name="username" placeholder="username" value="">
      <input type="password" id="password" name="password" placeholder="password" value="">
      <button type="submit" class="btn btn-primary">Masuk ke akun anda<i class="bi bi-arrow-right float-right" ></i> 
</button>
<a href="./login/register"><p class="register-acc">Belum Memiliki Akun? Daftar<p></a>

   </form>
   </div>
</body>

</html>
