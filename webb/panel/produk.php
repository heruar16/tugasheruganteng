<?php
require '../backend/model/Querybuilder.php';
$getter = new Querybuilder('kategori');
session_start();
$cat = $getter->selectAll("1 ORDER BY nama_kat ASC")['result'];
include 'sys/authchecker.php';

$prdGetter = new Querybuilder("produk");
$prd = $prdGetter->selectAll("1 ORDER BY nama ASC")['result'];
?>
<!DOCTYPE Html>
<html lang="id">
<head>
   <title>Admin - Produk</title>
   <?php include 'temps/stylenscripts.php'?>
</head>
<body style="padding:0;margin:0;font-family: 'Rubiks'">
   <?php include 'temps/sidebar.php' ?>
   <div class="panel-sections">
      <div class="sect-heading">
         <h1>Produk</h1>
         <p>Buat & Kelola produk</p>
      </div>

      <div class="sect-body">
         <div class="sect-col-half">
            <?php
            if(!empty($_GET['produk']))
            {
               if($_GET['produk'] == "true")
               {
                  ?>
                  <h4 class="alert alert-success">Produk disimpan!</h4>
                  <?php
               }
               else{
                  ?>
                  <h4 class="alert alert-danger">Gagal!</h4>
                  <?php
               }
            }

            if(!empty($_GET['foto']))
            {
               ?>
               <h4 class="alert alert-danger">Foto gagal diupload!</h4>
               <?php
            }
            ?>
            <form action="actions/produk-add.php" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" required name="name" placeholder="dodol kentang" value="">
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
                  <textarea name="descript" required placeholder="Produk ini enak untuk disantap"></textarea>
               </div>
               <div class="form-group">
                  <label>Gambar Ikan</label>
                  <input type="file" accept=".jpg,.jpeg,.pmg," name="foto">
               </div>
               <div class="form-group">
                  <label>Harga</label>
                  <input type="number" required name="harga" placeholder="Misal: 1000000">
               </div>
               <div class="form-group">
                  <label>Qty</label>
                  <input type="number" required name="qty" placeholder="Misal: 100">
               </div>
               <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" required name="satuan" placeholder="Misal: pcs">
               </div>
               <div class="form-group">
                  <button type="submit">Simpan</button>
               </div>
            </form>
         </div>
         <div class="wrapper">
         </div>
         <table cellpadding="10" border-collapse="collapse" class="table-styled">
            <thead>
            <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Kategori</th>
               <th>Deskripsi</th>
               <th>Foto</th>
               <th>Harga</th>
               <th>Stok</th>
               <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n=0;
            while($fetch = mysqli_fetch_array($prd))
            {
               $idKat = $fetch['kategori'];
               $kat = $getter->select("id_data = '$idKat'")['single'];
               $n++;
               ?>
               <tr>
                  <td><?= $n ?></td>
                  <td><?= $fetch['nama'] ?></td>
                  <td><?= $kat['nama_kat'] ?></td>
                  <td><?= $fetch['deskripsi'] ?></td>
                  <td><img src="../image/<?= $fetch['foto'] ?>" style="width:70px;height:70px;border-radius:10px;object-fit: cover"/></td>
                  <td>Rp.<?= number_format($fetch['harga']) ?></td>
                  <td><?= $fetch['qty'] ?> <?= $fetch['satuan'] ?></td>
                  <td>
                     <a href="produk-edit.php?id=<?= $fetch['id_data'] ?>" style="color:orange;text-decoration: none;padding:5px;font-size:12px;font-weight: bold">Edit</a>
                     <a href="actions/produk-delete.php?id=<?= $fetch['id_data'] ?>" style="color:red;text-decoration: none;padding:5px;font-size:12px;font-weight: bold">Hapus</a>
                  </td>
               </tr>
               <?php
            }
            ?>
            </tbody>
         </table>
         </div>
</body>
