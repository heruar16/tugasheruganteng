<?php
//Panggil kelas
require '../../backend/model/Querybuilder.php';
require '../../backend/model/Uploader.php';
$builder = new Querybuilder("produk"); //buat objek

//POST data dari HTML
$name = $_POST['name'];
$cat = $_POST['kat'];
$descript = $_POST['descript'];
$foto = $_FILES['foto']['tmp_name'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$satuan = $_POST['satuan'];

$up = new Uploader("../../image/",$foto); //Upload foto produk
$upload = $up->upload();
if($upload['status']) //Jika upload berhasil
{
   //Masukkan data ke tabel
   $imageName = $upload['payload'];
   $insert = $builder->insert("'','$name','$cat','$descript','$imageName','$harga','$qty','$satuan'");
   if($insert)
   {
      header("location:../produk.php?produk=true");
   }
   else{
      header("location:../produk.php?produk=false");

   }
}
else{ //jika gagal
   header("location:../produk.php?foto=false");
}