<?php
//Panggil kelas yang dibutuhkan
require 'model/Akun.php';
require 'model/Session.php';

//POST data dari Form HTML
$data['email'] = $_POST['email'];
$data['password'] = md5($_POST['password']);
//Buat objek
$account = new Akun();
$session = new Session();
//Cek data untuk persiapan login
$check = $account->login($data);
if($check['status']) //Jika pengecekan data di DB berhasil
{
   $level = $check['level']; //Ambil level pengguna
   if($session->startSession("user",$data['email'])) //Buat sesi untuk USER
   {
      $session->startSession("level",$level); //Buat sesi untuk Level
      if($level == "admin") //Jika yang login adalah Admin
      {
         header("location:../panel/dash.php"); //Arahkan ke dashboard admin
      }
      else{
         header("location:".$_SERVER['HTTP_REFERER']); //Arahkan ke halaman sebelumnya
      }
   }
}
else{//Pencocokan data akun tidak berhasil
   //Arahkan ke halamana login dengan pesan gagal
   header("location:../index.php?login=unknown");
}