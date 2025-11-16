<?php
session_start(); //Mulai sesi
require 'model/Querybuilder.php'; //menggunakan class Querybuilder
//Cek jika sesi User tidak ada
if(empty($_SESSION['user']))
{
   header("location:../index.php"); //Kembalikan client ke halaman index
}

//Buat objek
$bCart = new Querybuilder("cart");
$bPrd = new Querybuilder("produk");
$bCat = new Querybuilder("kategori");

$idProduk = $_GET['id']; //Ambil ID produk menggunakan GET
$username = $_SESSION['user']; //Ambil Username
$check = $bCart->selectAll("id_prd = '$idProduk'"); //Cek produk menggunakan id produk
if(!$check['rows']) //Jika produk di keranjang tidaka ada
{
   $insert = $bCart->insert("'','$idProduk','$username','1'"); //Masukkan produk baru
   if($insert)
   {
      header("location:../cart.php"); //Kembalikan ke halaman cart
   }
}
else{ //Jika produk sudah ada
   //Update kuantitas produk
   $qty = $bCart->select("id_prd = '$idProduk'")['single']['qty'] + 1;
   $update = $bCart->update("qty = '$qty'","id_prd = '$idProduk'");
   if($update)
   {
      header("location:../cart.php"); //Kembalikan ke halaman cart
   }
}