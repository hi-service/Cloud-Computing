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
      <h2 id="text-login">Daftar Akun</h2>
      <p id="sub-text">Daftar agar anda dapat menggunakan layanan HiService</p>
      <p id="service-text"> Hi! <p id="service-text" style="color:red;"> Service </p></p>
      <?php
    if(session()->getFlashData('gagal')){
    ?>
      <span class="login-alert" style="background-color:red">
         <p style="color:red;font-size:20px">Email sudah terdaftar</p>
      </span>
      <?php
    }
    
    ?>
    <?php
    if(session()->getFlashData('success')){
    ?>
      <span class="login-alert" style="background-color:red">
         <p style="color:lightgreen;font-size:20px">Register Berhasil Silahkan Lakukan Login</p>
      </span>
      <?php
    }
    
    ?>

    
      <form class="input-frame" action=<?= base_url('login/submit_register') ?> method="post">
      <input type="text" id="name" name="name" placeholder="Nama" value="">
      <input type="email" id="username" name="username" placeholder="Email" value="">
      <input type="password" id="password" name="password" placeholder="password" value="">
      <input type="password" id="password-confirm" name="password-confirm" placeholder="Konfirmasi password" value="">
      <input type="number" id="user-number" name="user-number" placeholder="Phone Number | 628xxxxxx" value="">
      <button type="submit" class="btn btn-primary">Daftar<i class="bi bi-arrow-right float-right" ></i> 
</button>

   </form>
   <a href="../"><p class="register-acc">Sudah Memiliki Akun? Login<p></a>
   </div>
   <script>
      var password1 =document.getElementById('password');
      var password2 =document.getElementById('password-confirm');
      password2.addEventListener("change", (event) => {
         if(password1.value === '' || password2.value === ''){

         }else{
         if(password1.value === password2.value){
            password1.style.border = 'solid 1px lightgreen'
            password2.style.border = 'solid 1px lightgreen'
         }else{
            password1.style.border = 'solid 1px black'
            password2.style.border = 'solid 1px black'
         }}
      });
      password1.addEventListener("change", (event) => {
         if(password1.value === '' || password2.value === ''){

         }else{
         if(password1.value === password2.value){
            password1.style.border = 'solid 1px lightgreen'
            password2.style.border = 'solid 1px lightgreen'
         }else{
            password1.style.border = 'solid 1px black'
            password2.style.border = 'solid 1px black'
         }
      }
      });
   </script>
</body>

</html>
