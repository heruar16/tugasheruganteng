<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas
$qb = new Querybuilder('user'); //Buat objek
if(!empty($_GET))
{
   //Ambil ID menggunakan $_GET
   $id = $_GET['id'];
   $delete = $qb->delete("id_data = '$id'"); //Hapus
   if($delete)
   {
      header("location:".$_SERVER['HTTP_REFERER']);
   }
}