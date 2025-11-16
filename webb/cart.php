<?php
session_start();
require 'backend/model/Querybuilder.php';
if(empty($_SESSION['user']))
{
   header("location:index.php");
}

$bCart = new Querybuilder("cart");
$bPrd = new Querybuilder("produk");
$bCat = new Querybuilder("kategori");
$user = $_SESSION['user'];
?>
<!DOCTYPE Html>
<html>
<head>
   <title>KULINERKU - Keranjang </title>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="assets/css/style.css"/>
   <script src="https://kit.fontawesome.com/45baddc7d9.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  
</head>
<body style="padding:0;margin:0;box-sizing: border-box;font-family: 'Rubiks'">
   <?php
   include 'temps/navbar.php';
   ?>

   <div class="wrapper-cart" style="padding-bottom: 100px;">
      <h1><i class="fas fa-shopping-cart"></i> Keranjang </h1>
      <div class="cart-items">
         <?php
         $getCart = $bCart->selectAll("username = '$user'");
         $totalHarga = 0;
         if($getCart['rows'])
         {
            while($fetchCart = mysqli_fetch_array($getCart['result']))
            {
               $idPrd = $fetchCart['id_prd'];
               $getPrd = $bPrd->select("id_data = '$idPrd'")['single'];
               $harga = $getPrd['harga']*$fetchCart['qty'];
               $totalHarga += $harga;
               ?>
               <div>
                  <div>
                     <img src="image/<?= $getPrd['foto'] ?>" style="border-radius:10px;width:100px;height:100px;object-fit: cover">
                  </div>
                  <div>
                     <h4 style="text-transform: uppercase"><?= $getPrd['nama'] ?></h4>
                     <h5 style="margin:0;padding:0;">Qty: <?= $fetchCart['qty'] ?></h5>
                     <h5 style="margin:0;padding:0;">Subtotal: Rp.<?= number_format($getPrd['harga']*$fetchCart['qty']) ?></h5>
                     <hr>
                     <a href="backend/delete-cart.php?id=<?= $fetchCart['id_data'] ?>" style="font-size:14px;color:red;text-decoration: none;background: red;color:#fff;padding:5px;">Hapus</a>
                     <a href="produk.php?id=<?= $getPrd['id_data'] ?>" style="font-size:14px;color:orange;text-decoration: none;padding:5px;">Pesan Lagi</a>
                  </div>
               </div>
               <?php
            }
            ?>
            <a href="index.php" style="text-transform: uppercase;display: block;text-align: center;color:orange;text-decoration: none;margin-bottom: 20px;margin-top:20px;">Belanja lagi</a>
            <?php
         }
         else{
            ?>
            <h2 style="text-align: center;padding:30px;"><i class="fas fa-inbox"></i> Keranjang Kosong!</h2>
            <a href="index.php" style="text-transform: uppercase;display: block;text-align: center;color:orange;text-decoration: none;margin-bottom: 20px;">Belanja sekarang</a>
            <?php
         }
         ?>
      </div>
      <h3 style="border-bottom:1px solid #ddd;border-top:1px solid #ddd;text-transform:uppercase;padding:20px;margin-top:5px;text-align: center">Sub-total: <span style="color:orange;">Rp.<?= number_format($totalHarga) ?></span></h3>
      <?php
      if($getCart['rows'])
      {
         ?>
         <a style="text-transform:uppercase;margin-top:10px;padding:15px;float:left;background: #5F9EA0;color:#fff;text-decoration: none" href="backend/checkout.php">Selesaikan Pembayaran</a>
         <?php
      }
      ?>
   </div>
</body>