<?php
require '../backend/model/Querybuilder.php';
$db = new Database();
$key = $_POST['key'];
$bPrd = new Querybuilder("produk");
?>
<style>
.s-wrap
{
    padding:15px;
    display: flex;
    justify-content: flex-start;
    border-bottom: 1px solid #ddd;
    width:600px;
    align-items: center;
    justify-items: center;
    justify-self: center;
    align-content: center;
    margin-bottom: 5px;
}
</style>
<div style="display: flex;flex-flow: column;align-items: center">
   <?php
   $search = $bPrd->selectAll("(nama LIKE '%$key%' OR deskripsi LIKE '%$key%') ORDER BY nama ASC");
   while($f = mysqli_fetch_array($search['result']))
   {
      ?>
      <div class="s-wrap">
         <div style="padding: 10px;"><img src="image/<?= $f['foto'] ?>" style="border-radius:10px;width:100px;height:100px;object-fit:cover;"></div>
         <div style="padding: 10px;">
            <h3 style="margin:0;"><?= $f['nama'] ?></h3>
            <h4 style="margin:0;">Rp.<?= number_format($f['harga']) ?> &centerdot; Tersisa <?= $f['qty'] ?></h4>
         </div>
         <div style="display: flex;flex-flow: column">
            <?php
            if($f['qty'] != 0)
            {
               ?>
               <a href="produk.php?id=<?= $f['id_data'] ?>" style="padding:10px;color:orange;text-decoration: none"><i class="fas fa-search"></i> Lihat</a>
               <a href="cart.php?id=<?= $f['id_data'] ?>" style="padding:10px;color:orange;text-decoration: none"><i class="fas fa-shopping-cart"></i> Masuk Keranjang +1</a>
               <?php
            }
            else{
               ?>
               <p style="text-align: center;padding:20px;color:red;font-weight: bold">Stok habis</p>
               <?php
            }
            ?>
         </div>
      </div>
      <?php
   }
   ?>
</div>

