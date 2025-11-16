<?php
require '../backend/model/Querybuilder.php';
$getter = new Querybuilder('user');
session_start();
include 'sys/authchecker.php';
?>
<!DOCTYPE Html>
<html lang="id">
<head>
   <title>Admin - Akun</title>
   <?php include 'temps/stylenscripts.php'?>
</head>
<body style="padding:0;margin:0;">
   <?php include 'temps/sidebar.php' ?>
   <div class="panel-sections">
      <div class="sect-heading">
         <h1>Akun</h1>
         <p>Kelola Akun Admin</p>
      </div>

      <div class="sect-body">
         <div class="sect-col-half">
            <h4>Buat Akun Admin</h4>
            <?php
            if(!empty($_GET['create']))
            {
               if($_GET['create'] == "ok")
               {
                  ?>
                  <h4 class="alert alert-success">Akun berhasil dibuat!</h4>
                  <?php
               }
               else{
                  ?>
                  <h4 class="alert alert-danger">Akun sudah ada!</h4>
                  <?php
               }
            }
            ?>
            <form action="actions/create-acc.php" method="post">
               <div class="form-group">
                  <label>Nama Admin</label>
                  <input type="text" required name="name" placeholder="Misal: Sahrul Ikhwan">
               </div>
               <div class="form-group">
                  <label>E-Mail</label>
                  <input type="email" required name="email" placeholder="Misal: sahrul@gmail.com">
               </div>
               <div class="form-group">
                  <label>Sandi</label>
                  <input type="password" required name="password" placeholder="Min. 8 Karakter" minlength="8">
               </div>
               <div class="form-group">
                  <button type="submit">Buat Akun</button>
               </div>
            </form>
         </div>

         <div class="sect-col-half">
            <h4>List Akun Admin</h4>
            <table cellpadding="10" border-collapse="collapse" class="table-styled">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>User Name</th>
                     <th>Level</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
               <?php
               $getAkun = $getter->selectAll("level = 'admin' ORDER BY id_data DESC");
               $n=0;
               while($fetch = mysqli_fetch_array($getAkun['result']))
               {
                  $n++;
                  ?>
                  <tr>
                     <td><?= $n ?></td>
                     <td style="font-size:14px;"><?= $fetch['username'] ?></td>
                     <td><code><?= $fetch['level'] ?></code></td>
                     <td>
                        <?php
                        if($fetch['username'] !== $_SESSION['user'])
                        {
                           ?>
                           <a href="actions/delete-akun.php?id=<?= $fetch['id_data'] ?>" style="color:red;text-decoration: none;font-weight:bold;text-transform: uppercase;font-size:13px;">Hapus</a>
                           <?php
                        }
                        else{
                           ?>
                           <a href="actions/logout.php" style="color:green;text-decoration: none;font-weight:bold;text-transform: uppercase;font-size:13px;">Logout</a>
                           <?php
                        }
                        ?>
                     </td>
                  </tr>
                  <?php
               }
               ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</body>
</html>