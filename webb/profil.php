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
$bUser = new Querybuilder("user");
$bProfile = new Querybuilder("profile");
$user = $_SESSION['user'];
$getUser = $bUser->select("username = '$user'")['single'];
$idUser = $getUser['id_data'];
$getPro = $bProfile->select("id_user = '$idUser'")['single'];
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

   <div class="profile-wrapper">
      <div class="flex-container" style="justify-content: space-evenly">
         <div style="display: flex;flex-flow: column;justify-content: center;align-items: center;border-right:1px solid #ddd;padding:120px;">
            <img style="width:120px;height:120px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4QzvYNgYlGx54bBBLh6_kwN74VAbokQQAFg&usqp=CAU">
            <hr>
            <h3 style="text-align: center;text-transform: uppercase"><?= $getPro['nama_lengkap'] ?></h3>
            <h3 style="text-align: center"><?= $getPro['nomor_hp'] ?> &centerdot; <?= $getPro['alamat'] ?></h3>
         </div>
         <div>
            <h1>Ubah Sandi</h1>
            <form action="backend/change-pass.php" method="post">
               <div class="form-group">
                  <label>Sandi Lama</label>
                  <input type="hidden" name="id" value="<?= $idUser ?>" required>
                  <input name="pass_old" required type="password" placeholder="Sandi Lama" minlength="8">
               </div>
               <div class="form-group">
                  <label>Sandi Baru</label>
                  <input name="pass_new" required type="password" placeholder="Sandi Baru" minlength="8">
               </div>
               <div class="form-group">
                  <label>Konfirmasi Sandi Baru</label>
                  <input name="pass_new_c" required type="password" placeholder="Konfirmasi Sandi Baru" minlength="8">
               </div>
               <div class="form-group">
                  <button type="submit">Simpan</button>
               </div>
            </form>
         </div>
         <?php
         if(!empty($_GET['change']))
         {
            ?>
            <div>
               <?php
               if($_GET['change'] == 99)
               {
                  ?>
                  <p style="background: red;color:#fff;"><i class="fa fa-warning"></i> Sandi lama tidak benar!</p>
                  <?php
               }
               else if($_GET['change'] == 98)
               {
                  ?>
                  <p style="background: orange;color:#fff;"><i class="fa fa-warning"></i> Konfirmasi sandi tidak cocok!</p>
                  <?php
               }
               else
               {
                  ?>
                  <p style="background: green;color:#fff;"><i class="fa fa-warning"></i> Sandi baru disimpan!</p>
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
