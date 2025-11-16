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
$bTrans = new Querybuilder("trans");
$bRec = new Querybuilder("receipt");
$user = $_SESSION['user'];
?>
<!DOCTYPE Html>
<html>
<head>
   <title>SIPIT - Upload</title>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="assets/css/style.css"/>
   <script src="https://kit.fontawesome.com/45baddc7d9.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   <style>
      .section-half
      {
          width:50%;
          box-sizing: border-box;
      }
   </style>
</head>
<body style="   padding:0;margin:0;box-sizing: border-box;font-family: 'Rubiks'">
<?php
include 'temps/navbar.php';
?>
<div class="wrapper-cart">
   <h1 style="text-transform: uppercase"><i class="fas fa-upload"></i> Upload Bukti Pembayaran</h1>
   <h4 style="margin:0;padding-top:5px;padding-bottom:5px;">ORDER ID: <?= $_GET['reg'] ?></h4>
   <div class="section-half">
      <form method="post" action="backend/upload-bukti.php" enctype="multipart/form-data">
         <div class="form-group">
            <label>Pilih Foto</label>
            <input type="hidden" value="<?= $_GET['reg'] ?>" name="idreg" required>
            <input type="file" accept=".jpeg,.jpg,png" required name="foto">
         </div>
         <div class="form-group">
            <button type="submit"><span class="fas fa-upload"></span> Upload</button>
         </div>
      </form>
   </div>
</div>