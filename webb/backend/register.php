<?php
require 'model/Akun.php'; //Panggil kelas
//Post data dari FORM HTML
$data['nama'] = $_POST['nama'];
$data['hp'] = $_POST['hp'];
$data['email'] = $_POST['email'];
$data['alamat'] = $_POST['alamat'];
$data['password'] = $_POST['password'];
$acc = new Akun(); //Buat objek kelas
$insert = $acc->insert($data); //Buat akun dengan method insert
if($insert == 1)
{
   header("location:../login.php?success"); //Register berhasil. Arahkan ke halaman login
}
else{
   header("location:../index.php?reg=exist"); //Register gagal. Arahkan ke halaman register
}