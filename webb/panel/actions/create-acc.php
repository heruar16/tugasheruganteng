<?php
require '../../backend/model/Querybuilder.php'; //Panggil builder
//Buat objek
$query = new Querybuilder("user");
$profile = new Querybuilder("profile");

//Post dari FORM HTML
$data['name'] = $_POST['name'];
$data['email'] = $_POST['email'];
$data['pass'] = md5($_POST['password']);
$email = $data['email'];
$pass = $data['pass'];
$name = $data['name'];
$check = $query->select("username = '$email'"); //Cek pengguna
if(!$check['rows']) //Jika pengguna tidak ada
{
   //Buat akun
   $get = $query->select("1 ORDER BY id_data DESC LIMIT 1")['single']['id_data'];
   $id = $get;
   $create = $query->insert("'','$email','$pass','admin'");
   if($create)
   {
      //Buat profil pengguna
      $createP = $profile->insert("'','$id','$name','-','-'");
      if($createP)
      {
         header("location:../akun.php?create=ok");
      }
   }
}
else{
   header("location:../akun.php?create=exist");
}