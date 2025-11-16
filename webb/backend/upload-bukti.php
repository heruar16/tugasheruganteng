<?php
//Panggil kelas
require 'model/Querybuilder.php';
require 'model/Uploader.php';
//Buat objek
$bTrans = new Querybuilder("trans");
$bRec = new Querybuilder("receipt");
//POST data dari FORM
$idreg = $_POST['idreg'];
$foto = $_FILES['foto']['tmp_name']; //Ambil file dari Form
$uploader = new Uploader("../bukti/",$foto); //Jalankan fungsi upload dengan parameter $path dan $file
$upload = $uploader->upload(); //Eksekusi perintah upload
if($upload['status']) //Jika upload berhasil
{
   $filename = $upload['payload']; //Ambil nama file yang sudah digenerate
   $status = 0; //Status awal
   $date = date("Y-m-d H:i:s"); //Buat tanggal
   $check = $bRec->select("kode_reg = '$idreg'"); //Cek receipt berdasarkan kode reg
   if(!$check['rows']) //Jika tidak ada data
   {
      //buat data baru
      $ins = $bRec->insert("'','$idreg','$filename','$status','$date'");
      if($ins)
      {
         header("location:../transhistory.php?ok");
      }
   }
   else{
      //data sudah ada
      header("location:../transhistory.php?exist");
   }
}
else{ //Jika upload gagal
   header("location:../transhistory.php?upload=false");
}
