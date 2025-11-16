<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas
//Buat objek
$getter = new Querybuilder('trans');
$produk = new Querybuilder("produk");
$rec = new Querybuilder("receipt");

//Mulai sesi
session_start();
$reg = $_GET['reg']; //Ambil kode reg
$delete = $getter->delete("kode_reg = '$reg'"); //Hapus data
header("location:".$_SERVER['HTTP_REFERER']); //kembalikan ke halaman sebelumnya