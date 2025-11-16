<?php
require "Querybuilder.php";
class Akun
{
   function checkAkun($username) //Fungsi cek akun
   {
      $check = new Querybuilder("user"); //Objek querybuilder
      return $check->select("username = '$username'");//kembalikan data
   }

   function login($data) //Fungsi login
   {
      //Kumpulkan data yang dikirim ke parameter $data
      $email = $data['email'];
      $pass = $data['password'];
      $builder = new Querybuilder("user"); //Buat objek user
      $check = $builder->select("username = '$email' AND password = '$pass'"); //Cek data
      if($check['rows']) //Jika cocok
      {
         return ['status'=>1,"level"=>$check['single']['level']];
      }
      else{ //jika gagal
         return 99;
      }
   }

   function insert($data)//fungsi tambah akun
   {
      //Buat objek
      $insert = new Querybuilder("user");
      $get = new Querybuilder("user");
      $profil = new Querybuilder("profile");

      //Kumpulkan data dari parameter $data
      $nama = $data['nama'];
      $hp = $data['hp'];
      $email = $data['email'];
      $alamat = $data['alamat'];
      $password = md5($data['password']);

      //Periksa data menggunakan method checkAkun
      if($this->checkAkun($email)['rows'] == 1) //Exist
      {
         return 99;
      }
      else{ // Not exist
         //Tambah data
         $exe = $insert->insert("'','$email','$password','user'");
         if($exe)
         {
            $id = $get->select("username = '$email' ORDER BY id_data DESC LIMIT 1")['single']['id_data'];
            $buatProfil = $profil->insert("'','$id','$nama','$hp','$alamat'");
            if($buatProfil)
            {
               return 1;
            }
         }
      }
   }
}