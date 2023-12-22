<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Login</title>
   <link rel="stylesheet" href=<?= base_url('assets/admin/login.style.css') ?>>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   <div class="container">
      <h2 id="text-login">Admin Login</h2>
      <p id="sub-text">Tingkatkan jangkuan bengkel anda dengan platform HiService</p>
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
      <form class="input-frame" action=<?= base_url('admin/auth_login') ?> method="post">
      <input type="text" id="admin_username" name="admin_username" placeholder="username" value="">
      <input type="password" id="admin_password" name="admin_password" placeholder="password" value="">
      <button type="submit" class="btn btn-primary">Masuk ke akun anda<i class="bi bi-arrow-right float-right" ></i> 
</button>
   </form>
   </div>
</body>

</html>
