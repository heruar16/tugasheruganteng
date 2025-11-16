<?php
//Mulai sesi
session_start();
require 'model/Querybuilder.php'; //Panggil kelas
//Cek otoritas
if(empty($_SESSION['user']))
{
   header("location:index.php");
}
//Buat objek dari kelas
$bCart = new Querybuilder("cart");
$id = $_GET['id'];//ambil ID menggunakan request $_GET
$check = $bCart->select("id_data = '$id'"); //Ambil data berdasarkan ID keranjang
if($check['rows'])
{
   //Jika data dengan ID $id tersedia, hapus
   $delete = $bCart->delete("id_data = '$id'");
   if($delete)
   {
      header("location:".$_SERVER['HTTP_REFERER']);
   }
}
else{
   //Jika data dengan $id tidak ada, maka tampilkan pesan 'No data'
   exit("No data");
}