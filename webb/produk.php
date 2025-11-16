<?php
require 'backend/model/Querybuilder.php';
session_start();
$sCat = new Querybuilder("kategori");
$sPrd = new Querybuilder("produk");
$id = $_GET['id'];
$prd = $sPrd->select("id_data = '$id'")['single'];
?>
   <!DOCTYPE Html>
   <html>
   <head>
      <title>KULINERKU - PRODUK</title>
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

   <form action="backend/to-cart.php" method="post">
      <div class="prd-wrapper">
         <div class="">
            <img src="image/<?= $prd['foto'] ?>" style="width:300px;height:300px;object-fit: cover">
         </div>
         <div class="">
            <h1 style="text-transform: uppercase"><?= $prd['nama'] ?></h1>
            <h3>Rp.<?= number_format($prd['harga']) ?></h3>
            <h3>Stok: <?= number_format($prd['qty']) ?> <?= $prd['satuan'] ?></h3>
            <hr>
            <h5 style="margin:0;padding:0;">Jumlah Item:</h5>
            <div class="controlwrap">
               <input type="hidden" name="id" required value="<?= $prd['id_data'] ?>">
               <button id="btnMin" type="button" class="itemcontrol"><i class="fas fa-minus"></i></button>
               <input name="qty" value="1" id="inpValue" style="text-align: center;color:orange;" type="number" class="itemcontrol">
               <button id="btnPlus" type="button" class="itemcontrol"><i class="fas fa-plus"></i></button>
            </div>
            <?php
            if(!empty($_SESSION['user']))
            {
               ?>
               <button style="padding:15px;border-radius:5px;background: orange;border:none;color:#fff;" type="submit"><i class="fas fa-shopping-cart"></i> Masuk Keranjang</button>
               <?php
            }
            else{
               ?>
               <p style="padding:0;margin-bottom: 10px;">Silahkan Masuk terlebih dahulu untuk dapat memesan</p>
               <button type="button" class="gologin" style="padding:15px;border-radius:5px;background: orange;border:none;color:#fff;"><i class="fas fa-shopping-cart"></i> Masuk Keranjang</button>
               <?php
            }
            ?>
            <p style="border-left:3px solid #ccc;padding:10px;margin-top:10px;display: block;">
               <span><b>Deskripsi:</b><br></span>
               <?= $prd['deskripsi'] ?>
            </p>
         </div>
      </div>
   </form>
   </body>
   <script>
      $(document).ready(function () {
         $(".gologin").click(function () {
            window.location = "login.php";
         });

         $("#btnPlus").click(function () {
            changeValue("inc","#inpValue",<?= $prd['qty'] ?>);
         })

         $("#btnMin").click(function () {
            changeValue("decr","#inpValue",<?= $prd['qty'] ?>);
         })
         function changeValue(cmd,elem,limit)
         {
            let value = parseInt($(elem).val());
            if(cmd === "inc")
            {
               if(value < parseInt(limit))
               {
                  value++;
                  $(elem).val(value);
               }
            }
            else if(cmd === "decr")
            {
               if(value === 0)
               {
                  $(elem).val(1);
                  value = 1;
               }
               else
               {
                  value--;
                  $(elem).val(value);
               }
            }
         }

         setInterval(function () {
            let val = parseInt($("#inpValue").val());
            if(val === 0)
            {
               $("#inpValue").val(1);
            }
         },0);
      });
   </script>
</html>
