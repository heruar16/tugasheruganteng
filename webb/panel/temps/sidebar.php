<div class="panel-side" style="background: #fff">
   <a href="dash.php"><img src="../assets/logos.png" style="padding:20px;background:#ddd;border-radius:100px;width:50px;height:50px;object-fit: contain"></a>
   <h4 style="margin:0;margin-top:10px;text-transform: uppercase"><?= $_SESSION['user'] ?></h4>
   <h4 style="margin:0;margin-top:10px;"><code><?= $_SESSION['level'] ?></code></h4>
   <div class="side-menu">
      <a href="dash.php">Beranda</a>
      <a href="akun.php">Akun</a>
      <a href="kategori.php">Kategori Produk</a>
      <a href="produk.php">Produk</a>
      <a href="trans.php">Transaksi</a>
      <a href="../index.php" style="border-top:1px solid #5F9EA0;margin-top:20px;color: #5F9EA0">Ke Halaman Awal</a>
      <a href="actions/logout.php" style="color:red;">Keluar</a>
   </div>
</div>