<?php
require '../backend/model/Querybuilder.php';
$getter = new Querybuilder('kategori');
session_start();
$cat = $getter->selectAll("1 ORDER BY nama_kat ASC")['result'];
include 'sys/authchecker.php';

$prdGetter = new Querybuilder("produk");
$id = $_GET['id'];
$produk = $prdGetter->select("id_data = '$id'")['single'];
?>
<!DOCTYPE Html>
<html lang="id">
<head>
   <title>Panel - Edit Produk</title>
   <?php include 'temps/stylenscripts.php'?>
</head>
<body style="padding:0;margin:0;">
<?php include 'temps/sidebar.php' ?>
<div class="panel-sections">
   <div class="sect-heading">
      <h1>Edit Produk</h1>
   </div>

   <div class="sect-body">
      <div class="sect-col-half">
         <form action="actions/update-produk.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label>Nama Produk</label>
               <input type="hidden" name="id" value="<?= $produk['id_data'] ?>" required>
               <input type="text" required name="name" placeholder="Ikan Nila" value="<?= $produk['nama'] ?>">
            </div>
            <div class="form-group">
               <label>Kategori</label>
               <select required name="kat">
                  <?php
                  while($f = mysqli_fetch_array($cat))
                  {
                     ?>
                     <option value="<?= $f['id_data'] ?>"><?= $f['nama_kat'] ?></option>
                     <?php
                  }
                  ?>
               </select>
            </div>
            <div class="form-group">
               <label>Deskripsi</label>
               <textarea name="descript" required placeholder="Enak untuk dikonsumsi"><?= $produk['deskripsi'] ?></textarea>
            </div>
            <div class="form-group">
               <label>Harga</label>
               <input type="number" required name="harga" placeholder="Misal: 1000000" value="<?= $produk['harga'] ?>">
            </div>
            <div class="form-group">
               <label>Qty</label>
               <input type="number" required name="qty" placeholder="Misal: 100" value="<?= $produk['qty'] ?>">
            </div>
             <div class="form-group">
                 <label>Satuan</label>
                 <input type="text" required name="satuan" placeholder="Misal: Kg" value="<?= $produk['satuan'] ?>">
             </div>
            <div class="form-group">
               <button type="submit">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
</body>
