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
   <title>KULINERKU - Riwayat</title>
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
      <h1><i class="fas fa-shopping-cart"></i> Riwayat Belanja</h1>
      <div class="hist-items">
         <?php
         $group = $bTrans->selectAll("username = '$user' GROUP BY kode_reg ORDER BY id_data DESC");
         while($fgr = mysqli_fetch_array($group['result']))
         {
            $kodeReg = $fgr['kode_reg'];
            $gItems = $bTrans->selectAll("kode_reg = '$kodeReg'");
            $status = $bTrans->selectAll("status = '1' AND kode_reg = '$kodeReg'");
            $upStatus = $bRec->select("kode_reg = '$kodeReg'");
            ?>
            <div class="reg-group">
               <p style="margin:0;padding:10px;background: #eecf97;color:#FF4500;margin:10px;border-radius: 5px;">
               <p style="margin:0;padding:10px;background: #eecf97;color:#FF4500;margin:10px;border-radius: 5px;">
                  ID Order: <b><?= $kodeReg ?></b><br>
                  DATE: <b><?= $fgr['tanggal'] ?></b>
               </p>
               <?php
               $totalGroup = 0;
               while($fitem = mysqli_fetch_array($gItems['result']))
               {
                  $idprd = $fitem['id_prd'];
                  $prdData = $bPrd->select("id_data = '$idprd'")['single'];
                  $totalGroup += $fitem['total'];
                  ?>
                  <div class="group-items">
                     <div>
                        <img src="image/<?= $prdData['foto'] ?>" style="width:100px;height:100px;object-fit: cover;border-radius:10px;">
                     </div>
                     <div>
                        <h4 style="text-transform: uppercase;margin:0;padding:0;"><?= $prdData['nama'] ?></h4>
                        <h5 style="margin: 0;padding:0;">Qty: <?= $fitem['qty'] ?></h5>
                        <h5 style="margin: 0;padding:0;">Subtotal: Rp.<?= number_format($fitem['total']) ?></h5>
                     </div>
                  </div>
                  <?php
               }
               ?>
               <h3 style="padding:10px;background: #5F9EA0;color:#FF4500;margin:10px;padding:20px;">Total Harga: Rp.<?= number_format($totalGroup) ?></h3>
               <?php
               if($status['rows'] == 0)
               {
                  if($upStatus['rows'])
                  {
                     if($upStatus['single']['status'] == 0)
                     {
                        ?>
                        <h3 style="padding:10px;color:#FF4500;">Bukti Pembayaran Sedang diverifikasi...</h3>
                        <?php
                     }
                  }
                  else{
                     ?>
                    <p style="font-size:16px;color:#333;">
                       Silahkan lakukan transfer sejumlah <b>RP.<?= number_format($totalGroup) ?></b> ke Nomor Rekening Berikut:<br><br>
                       Nama Bank: <b>BANK BRI</b><br>
                       A/N: <b>SIPIT</b><br>
                       No. Rekening: <b>0123-4567-8910</b><br><br>
                       Jika sudah melakukan transfer, upload bukti transfer dengan klik Tombol Dibawah.<br>
                       Jika sudah upload, tunggu hingga admin mengkonfirmasi pembayaraan.<br>
                       pembayaran akan dikonfirmasi pada waktu jam kerja 360/24
                    </p>
                     <a href="upload-bukti.php?reg=<?= $kodeReg ?>" style="color:orange;display: block;padding:10px;text-decoration: none">
                        <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                     </a>
                     <?php
                  }
               }
               else{
                  ?>
                  <h3 style="padding:10px;color:green;"><i class="fas fa-check"></i> Sudah Dibayar!</h3>
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