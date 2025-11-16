<?php
require 'backend/model/Querybuilder.php';
session_start();
if(!empty($_SESSION['user']))
{
   header("location:index.php");
}
?>
<!DOCTYPE Html>
<html>
<head>
   <title>KULINERKU - Daftar</title>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="assets/css/style.css"/>
   <script src="https://kit.fontawesome.com/45baddc7d9.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>
<body>
<?php
include 'temps/navbar.php';
?>
<div class="a-wrapper">
   <h1>Daftar</h1>
   <div class="flex-group">
      <div class="flex-group-col">
         <form action="backend/register.php" method="post">
            <div class="form-group">
               <label>Nama Lengkap</label>
               <input type="text" required name="nama" placeholder="Misal: Sahrul Ikhwan">
            </div>
            <div class="form-group">
               <label>Nomor HP</label>
               <input type="text" required name="hp" placeholder="Misal: 0812345678910">
            </div>
            <div class="form-group">
               <label>Alamat E-Mail</label>
               <input type="email" required name="email" placeholder="email@gmail.com">
            </div>
            <div class="form-group">
               <label>Alamat</label>
               <input type="text" required name="alamat" placeholder="Misal: Kobar">
            </div>
            <div class="form-group">
               <label>Kata Sandi</label>
               <input type="password" required name="password" placeholder="Kata Sandi" minlength="8">
            </div>
            <div class="form-group">
               <button type="submit">Buat Akun</button>
            </div>
            <div class="form-group">
               <p style="padding:0;margin:0;">Sudah punya akun? <a href="login.php">Masuk</a></p>
            </div>
         </form>
      </div>
      <div class="flex-group-col"></div>
   </div>
</div>
</body>
</html>