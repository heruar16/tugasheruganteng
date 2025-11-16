<?php
require 'backend/model/Querybuilder.php';
session_start();
$get = new Querybuilder("produk");
$getCat = new Querybuilder("kategori");

$id = $_GET['cat'];
$cat1 = $getCat->select("id_data = '$id'")['single'];
$prd1 = $get->selectAll("kategori = '$id'");
?>
<!DOCTYPE Html>
<html>
   <head>
      <title>Kategori</title>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="assets/css/style.css"/>
      <script src="https://kit.fontawesome.com/45baddc7d9.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   </head>
   <body style="padding:0;margin:0;box-sizing: border-box">
      <?php
      include 'temps/navbar.php';
      ?>
      <div class="section">
         <h1><?= $cat1['nama_kat'] ?></h1>
         <div class="flex-container">
            <?php
            while($ff = mysqli_fetch_array($prd1['result']))
            {
               ?>
               <div class="product-wrapper">
                  <img src="image/<?= $ff['foto'] ?>" style="width:100%;">
                  <h3 style="margin-top:10px;"><?= $ff['nama'] ?></h3>
                  <h5>Rp.<?= number_format($ff['harga']) ?> &centerdot; <?= $ff['qty'] ?>x</h5>
                  <?php
                  if($ff['qty'] != 0)
                  {
                     if(empty($_SESSION['user']))
                     {
                        ?>
                        <a href="produk.php?id=<?= $ff['id_data'] ?>"><i class="fas fa-search"></i> Lihat</a>
                        <a data-target=".nav-login" class="open-popup" href="#"><span class="fas fa-shopping-cart"></span> ke Keranjang</a>
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
      </div>
   </body>
</html>