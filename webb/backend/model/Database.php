<?php
class Database
{
   function connect() //Fungsi koneksi ke database
   {
      //Setup akun koneksi
      $username = 'root';
      $password = '';
      $host = 'localhost';
      $db = "dimmeplace"; //Nama database
      return mysqli_connect($host, $username, $password, $db); //eksekusi koneksi dan kembalikan hasil eksekusi
   }
}