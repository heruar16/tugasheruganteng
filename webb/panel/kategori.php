<?php
require '../backend/model/Querybuilder.php';
$getter = new Querybuilder('kategori');
session_start();
include 'sys/authchecker.php';

$cats = $getter->selectAll("1 ORDER BY nama_kat ASC");
?>
<!DOCTYPE Html>
<html lang="id">
<head>
   <title>Admin - Kategori Produk</title>
   <?php include 'temps/stylenscripts.php'?>
</head>
<body style="padding:0;margin:0;">
<?php include 'temps/sidebar.php' ?>
<div class="panel-sections">
   <div class="sect-heading">
      <h1>Kategori</h1>
      <p>Buat & Kelola kategori produk</p>
   </div>

   <div class="sect-body">
      <div class="sect-col-half">
         <h4>Buat Kategori</h4>
         <form action="actions/create-cat.php" method="post">
            <div class="form-group">
               <label>Nama Kategori</label>
               <input type="text" required name="name" placeholder="Misal: kue kering">
            </div>
            <div class="form-group">
               <label>Deskripsi</label>
               <textarea name="desc" placeholder="Misal: kue manis"></textarea>
            </div>
            <div class="form-group">
               <label>Tampilkan?</label>
               <select required name="show">
                  <option value="1">YA</option>
                  <option value="0">TIDAK</option>
               </select>
            </div>
            <div class="form-group">
               <button type="submit">Tambah & Simpan</button>
            </div>
         </form>
      </div>
      <div class="sect-col-half">
         <h4>Kategori</h4>
         <table cellpadding="10" border-collapse="collapse" class="table-styled">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Tampilkan?</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
            <?php
            $n=0;
            while($fetch = mysqli_fetch_array($cats['result']))
            {
               $n++;
               ?>
               <tr>
                  <td><?= $n ?></td>
                  <td class="edit-name<?= $n ?>" contenteditable="true" data-id="<?= $fetch['id_data'] ?>"><?= $fetch['nama_kat'] ?></td>
                  <td class="edit-desc<?= $n ?>" contenteditable="true" data-id="<?= $fetch['id_data'] ?>"><?= $fetch['deskripsi'] ?></td>
                  <td>
                     <?php
                     if($fetch['tampil'] == 1)
                     {
                        ?>
                        <b>Ya</b>
                        <a href="actions/cat-change.php?id=<?= $fetch['id_data'] ?>" style="font-size:10px;text-decoration: none;color:orange;font-weight:bold;" href="#">(Ganti)</a>
                        <?php
                     }
                     else{
                        ?>
                        <b style="color:red;">Tidak</b>
                        <a href="actions/cat-change.php?id=<?= $fetch['id_data'] ?>" style="font-size:10px;text-decoration: none;color:orange;font-weight:bold;" href="#">(Ganti)</a>
                        <?php
                     }
                     ?>
                  </td>
                  <td>
                     <a href="actions/cat-delete.php?id=<?= $fetch['id_data'] ?>" style="color:red;font-size:12px;text-decoration: none;font-weight:bold;">Hapus</a>
                  </td>
               </tr>
               <script>
                  $(".edit-name<?= $n ?>").on("keyup",function () {
                     let data = {"id":$(this).attr("data-id"),"name":$(".edit-name<?= $n ?>").html(),"desc":$(".edit-desc<?= $n ?>").html()};
                     $.ajax({
                        url:"actions/update-cat.php",
                        data,
                        type:"post",
                        async:true,
                        success:function (res) {
                           console.log(res);
                        }
                     });
                  });

                  $(".edit-desc<?= $n ?>").on("keyup",function () {
                     let data = {"id":$(this).attr("data-id"),"name":$(".edit-name<?= $n ?>").html(),"desc":$(".edit-desc<?= $n ?>").html()};
                     $.ajax({
                        url:"actions/update-cat.php",
                        data,
                        type:"post",
                        async:true,
                        success:function (res) {
                           console.log(res);
                        }
                     });
                  });
               </script>
               <?php
            }
            ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
</body>
