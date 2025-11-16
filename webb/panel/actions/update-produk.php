<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas
$getter = new Querybuilder('kategori'); //Buat objek
session_start();//Mulai sesi
$cat = $getter->selectAll("1 ORDER BY nama_kat ASC")['result']; //Ambil data kategori
include '../sys/authchecker.php'; //Periksa otorisasi

$edit = new Querybuilder("produk"); //Buat objek produk
//POST data dari HTML
$id = $_POST['id'];
$name = $_POST['name'];
$cat = $_POST['kat'];
$descript = $_POST['descript'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
//Perbarui data produk
$update = $edit->update("nama = '$name', kategori = '$cat', deskripsi = '$descript', harga = '$harga', qty = '$qty'","id_data = '$id'");
if($update)
{
   header("location:../produk.php?edit=ok");
}