<?php
require 'backend/model/Querybuilder.php';
session_start();
$sCat = new Querybuilder("kategori");


?>
<!DOCTYPE Html>
<html>
   <head>
      <title>KULINERKU</title>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="assets/css/style.css"/>
      <script src="https://kit.fontawesome.com/45baddc7d9.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   </head>
   <body style="padding:0;margin:0;box-sizing: border-box;font-family: 'Rubiks'">
   <?php
   include 'temps/navbar.php';
   if(!empty($_GET['reg']))
   {
      if($_GET['reg'] == "ok")
      {
         ?>
         <div class="alert-wrapper">
            <div class="alert-body">
               <h2 style="text-align: center">Akun Berhasil dibuat!</h2>
               <p>Selanjutnya, silahkan Masuk</p>
               <a href="javascript:void(0)" class="navacc" data-target=".nav-login"> Masuk</a>
            </div>
         </div>
         <?php
      }
      else if($_GET['reg'] == "exist")
      {
         ?>
         <div class="alert-wrapper">
            <div class="alert-body">
               <h2 style="text-align: center">Akun Sudah Ada!</h2>
               <p>Silahkan gunakan E-mail yang lain</p>
               <a href="javascript:void(0)" class="navacc" data-target=".nav-register"> Coba Lagi</a>
               <a style="margin-top: 10px;" href="javascript:void(0)" class="alert-dismiss">Tutup</a>
            </div>
         </div>
         <?php
      }
   }

   if(!empty($_GET['login']))
   {
      if($_GET['login'] == "unknown")
      {
         ?>
         <div class="alert-wrapper">
            <div class="alert-body">
               <h2 style="text-align: center">Login Gagal!</h2>
               <p>Akun tidak diketahui</p>
               <a href="javascript:void(0)" class="navacc" data-target=".nav-login"> Coba Lagi</a>
               <a style="margin-top: 10px;" href="javascript:void(0)" class="navacc" data-target=".nav-register">Buat Akun</a>
               <a style="margin-top: 10px;" href="javascript:void(0)" class="alert-dismiss">Tutup</a>
            </div>
         </div>
         <?php
      }
   }
   ?>

   <div class="bg-wrapper">
      <img src="assets/bg.jpg">
      <div class="overlay">
         <div class="jumbotron">
            <img src="assets/logos.png" style="width:100px;height:100px;object-fit: contain">
            <h5>Welcome to our Website!</h5>
            <h1>KULINERKU</h1>
            <h4>Petualangan Kulinerku, Menjelajahi Hidangan Indonesia</h4>
         </div>
      </div>
   </div>

   <h1 style="text-align: center;margin-top:50px;">Pesan Sekarang!</h1>
   <div class="flex-container" style="padding:30px;">
      <?php
      $prod = new Querybuilder("produk");
      $prd1 = $prod->selectAll("1 ORDER BY id_data DESC");
      while($ff = mysqli_fetch_array($prd1['result']))
      {

         ?>
         <div class="product-wrapper">
            <img src="image/<?= $ff['foto'] ?>" style="width:100%;">
            <h3 style="margin-top:10px;"><?= $ff['nama'] ?></h3>
            <h5 style="margin:0;padding:0;">Rp.<?= number_format($ff['harga']) ?> &centerdot; <?= $ff['qty'] ?> <?= $ff['satuan'] ?></h5>
            <?php
            if($ff['qty'] != 0)
            {
               if(empty($_SESSION['user']))
               {
                  ?>
                  <a href="produk.php?id=<?= $ff['id_data'] ?>"><i class="fas fa-search"></i> Lihat</a>
                  <a class="open-popup" href="login.php"><span class="fas fa-shopping-cart"></span> ke Keranjang</a>
                  <?php
               }
               else{
                  ?>
                  <a href="produk.php?id=<?= $ff['id_data'] ?>"><i class="fas fa-search"></i> Lihat</a>
                  <a href="backend/cart.php?id=<?= $ff['id_data'] ?>"><span class="fas fa-shopping-cart"></span> ke Keranjang</a>
                  <?php
               }
            }
            else{
               ?>
               <h5 style="color:#fff;text-align: center;padding:20px;background: red;margin-top:10px;border-radius: 5px;">STOK HABIS</h5>
               <?php
            }

            ?>
         </div>
         <?php
      }
      ?>
   </div>
   <?php
   include 'temps/foote.php';
   ?>

   </body>
</html>
