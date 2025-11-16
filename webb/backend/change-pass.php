<?php
//Mulai sesi
session_start();
require 'model/Querybuilder.php';
//Cek jika sesi User tidak ada
if(empty($_SESSION['user']))
{
   header("location:index.php");
}
$user = $_SESSION['user']; //Ambil isi sesi User
$bUser = new Querybuilder("user");
$getUser = $bUser->select("username = '$user'")['single'];

//POST data dari form HTML
$old = md5($_POST['pass_old']);
$new = md5($_POST['pass_new']);
$con = md5($_POST['pass_new_c']);

$checkOld = $bUser->select("username = '$user' AND password = '$old'"); //Cek sandi lama
if($checkOld['rows']) //Jika sandi lama sama
{
   //Cek sandi baru dan konfirmasi sandi
   if($con == $new) //Sandi sama
   {
      //Perbarui sandi
      $update = $bUser->update("password = '$new'","username = '$user'");
      if($update)
      {
         header("location:../profil.php?change=true"); //Return true (sandi disimpan)
      }
   }
   else{ //Sandi tidak sama
      header("location:../profil.php?change=98"); //Return kode 98 (sandi baru dan konfirmasi sandi tidak cocok)
   }
}
else{
   header("location:../profil.php?change=99"); //Return kode 99 (sandi lama tidak cocok)
}