<?php
//Mulai sesi
session_start();
require 'model/Querybuilder.php'; //Panggil kelas builder
//Cek otoritas sesi
if(empty($_SESSION['user']))
{
   header("location:../index.php");
}
//Buat objek
$bCart = new Querybuilder("cart");
$bPrd = new Querybuilder("produk");
$bCat = new Querybuilder("kategori");

//Post data dari FORM
$idProduk = $_POST['id'];
$qty = $_POST['qty'];
$username = $_SESSION['user']; //Ambil data sesi user
$check = $bCart->selectAll("id_prd = '$idProduk'"); //Ambil data keranjang berdasarkan id produk
if(!$check['rows']) //Jika data tidak ada
{
   //Tambah data baru
   $insert = $bCart->insert("'','$idProduk','$username','$qty'");
   if($insert)
   {
      header("location:../cart.php");
   }
}
else{ //Jika data sudah ada
   //Perbarui kuantitas item
   $qty = $bCart->select("id_prd = '$idProduk'")['single']['qty'] + $qty;
   $update = $bCart->update("qty = '$qty'","id_prd = '$idProduk'");
   if($update)
   {
      header("location:../cart.php");
   }
}