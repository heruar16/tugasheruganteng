<?php
//Mulai sesi
session_start();
require 'model/Querybuilder.php'; //Gunakan kelas Querybuilder
$user = $_SESSION['user']; //Ambil session user
//Buat objek dari kelas
$bCart = new Querybuilder("cart");
$bPrd = new Querybuilder("produk");
$bTrans = new Querybuilder("trans");

//Periksa data pengguna pada tabel cart
$get = $bCart->selectAll("username = '$user'"); //Ambil semua data cart pengguna
$regCode = rand(1000,9999)."-".rand(1000,9999)."-".rand(1000,9999)."-".rand(1000,9999); //Generate kode unik sebagai ID Order
while($f = mysqli_fetch_array($get['result'])) //Ambil semua data
{
   //Lakukan checkout
   $idprd = $f['id_prd'];
   $getPrd = $bPrd->select("id_data = '$idprd'")['single'];
   $qty = $f['qty'];
   $total = $getPrd['harga'] * $qty;
   $status = 0;
   $date = date("Y-m-d H:i:s");
   $ins = $bTrans->insert("'','$idprd','$user','$qty','$total','$regCode','$status','$date'");
   $delete = $bCart->delete("id_prd = '$idprd' AND username = '$user'");
}
header("location:../transhistory.php"); //Selesai. Kembalikan ke halaman riwayat transaksi