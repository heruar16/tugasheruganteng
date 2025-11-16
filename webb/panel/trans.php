<?php
require '../backend/model/Querybuilder.php';
$getter = new Querybuilder('trans');
$produk = new Querybuilder("produk");
$rec = new Querybuilder("receipt");
session_start();
include 'sys/authchecker.php';
?>
   <!DOCTYPE Html>
   <html lang="id">
   <head>
      <title>Admin - Transaksi</title>
      <?php include 'temps/stylenscripts.php'?>
   </head>
   <body style="padding:0;margin:0;font-family: 'Rubiks'">
      <?php include 'temps/sidebar.php' ?>
      <div class="panel-sections">
         <div class="sect-heading">
            <h1>Transaksi</h1>
            <p>Verifikasi Pembayaran</p>
         </div>

         <div class="sect-body">
            <div class="sect-col-half">
               <h2>PESANAN</h2>
               <?php
               $bTrans = $getter->selectAll("status = 0 GROUP BY kode_reg");
               while($ft = mysqli_fetch_array($bTrans['result']))
               {
                  $kodeReg = $ft['kode_reg'];
                  $order = $getter->selectAll("kode_reg = '$kodeReg'");
                  $totalHarga = 0;
                  $getRec = $rec->select("kode_reg = '$kodeReg'");
                  ?>
                  <div class="tr-wrapper">
                     <h5 style="text-transform: uppercase"><i class="fa fa-send"></i> PESANAN: <?= $ft['username'] ?></h5>
                     <h5 style="font-size:12px;color:#ccc;">ID ORDER: <?= $ft['kode_reg'] ?></h5>
                     <?php
                     while($f = mysqli_fetch_array($order['result']))
                     {
                        $idPrd = $f['id_prd'];
                        $getPrd = $produk->select("id_data = '$idPrd'")['single'];
                        $totalHarga += $getPrd['harga'] * $f['qty'];
                        ?>
                        <div class="order-item">
                           <h4><?= $getPrd['nama'] ?></h4>
                           <h5>Rp.<?= number_format($getPrd['harga'] * $f['qty']) ?> (<?= $f['qty'] ?>x)</h5>
                        </div>
                        <?php
                     }
                     ?>
                     <p style="display: block;padding:0;padding-bottom: 20px;">Total Harga: <b style="color:orange;">Rp.<?= number_format($totalHarga) ?></b></p>
                     <?php
                     if($getRec['rows'])
                     {
                        if($getRec['single']['status'] == 1)
                        {
                           ?>
                           <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: red;" href="actions/confirmpay.php?reg=<?= $kodeReg ?>">Batal Konfirmasi</a>
                           <?php
                        }
                        else{
                           ?>
                           <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: orange;" href="actions/confirmpay.php?reg=<?= $kodeReg ?>">Konfirmasi</a>
                           <?php
                        }
                        ?>
                        <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: orange;" href="../bukti/<?= $getRec['single']['foto'] ?>">Lihat Bukti Pembayaran</a>
                        <?php
                     }
                     ?>
                     <br><br>
                     <a href="actions/delete-reg.php?reg=<?= $kodeReg ?>" style="color:red;text-decoration: none;display: inline-block">
                        Batalkan & Hapus
                     </a>
                  </div>
                  <?php
               }
               ?>
            </div>
            <div class="sect-col-half">
               <h2>PESANAN DIKONFIRMASI</h2>
               <?php
               $bTrans1 = $getter->selectAll("status = 1 GROUP BY kode_reg");
               $totalDuit = 0;
               while($ft1 = mysqli_fetch_array($bTrans1['result']))
               {
                  $kodeReg1 = $ft1['kode_reg'];
                  $order1 = $getter->selectAll("kode_reg = '$kodeReg1'");
                  $totalHarga1 = 0;
                  $getRec1 = $rec->select("kode_reg = '$kodeReg1'");
                  ?>
                  <div class="tr-wrapper">
                     <h5 style="text-transform: uppercase"><i class="fa fa-send"></i> PESANAN: <?= $ft1['username'] ?></h5>
                     <h5 style="font-size:12px;color:#ccc;">ID ORDER: <?= $ft1['kode_reg'] ?></h5>
                     <?php
                     while($f1 = mysqli_fetch_array($order1['result']))
                     {
                        $idPrd1 = $f1['id_prd'];
                        $getPrd1 = $produk->select("id_data = '$idPrd1'")['single'];
                        $totalHarga1 += $getPrd1['harga'] * $f1['qty'];
                        ?>
                        <div class="order-item">
                           <h4><?= $getPrd1['nama'] ?></h4>
                           <h5>Rp.<?= number_format($getPrd1['harga'] * $f1['qty']) ?> (<?= $f1['qty'] ?>x)</h5>
                        </div>
                        <?php
                     }
                     ?>
                     <p style="display: block;padding:0;padding-bottom: 10px;">Total Harga: <b style="color:orange;">Rp.<?= number_format($totalHarga1) ?></b></p>
                     <?php
                     if($getRec1['rows'])
                     {
                        if($getRec1['single']['status'] == 1)
                        {
                           ?>
                           <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: red;" href="actions/confirmpay.php?reg=<?= $kodeReg1 ?>">Batal Konfirmasi</a>
                           <?php
                        }
                        else{
                           ?>
                           <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: orange;" href="actions/confirmpay.php?reg=<?= $kodeReg1 ?>">Konfirmasi</a>
                           <?php
                        }
                        ?>
                        <a style="padding:10px;color:#fff;text-decoration: none;font-size:12px;background: orange;" href="../bukti/<?= $getRec1['single']['foto'] ?>">Lihat Bukti Pembayaran</a>
                        <?php
                     }
                     ?>
                  </div>
                  <?php
                  $totalDuit += $totalHarga1;
               }
               ?>
               <h3>Pendapatan: Rp.<?= number_format($totalDuit) ?></h3>
            </div>
         </div>
      </div>
   </body>
</html>
