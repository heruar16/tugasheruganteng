<?php
require '../../backend/model/Querybuilder.php'; //Gunakan kelas builder
$builder = new Querybuilder("kategori"); //Buat objek
$id = $_GET['id']; //Ambil id kategori menggunakan $_GEt
$get = $builder->select("id_data = '$id'"); //Ambil data berdasarkan ID
$status = $get['single']['tampil']; //Ambil status 'tampil'
if($status == 1)//Jika status tampil = 1 (ditampilkan)
{
   //Ubah menjadi 0
   $change = $builder->update("tampil = 0","id_data = '$id'");
}
else{
   //Ubah menjadi 1
   $change = $builder->update("tampil = 1","id_data = '$id'");
}
header("location:../kategori.php?change=true");