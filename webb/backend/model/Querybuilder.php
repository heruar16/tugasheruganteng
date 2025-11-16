<?php
require 'Database.php';

class Querybuilder
{
   private $tableName; //Variabel konstruktor
   function __construct($dbname)
   {
      $this->tableName = $dbname; //Nama tabel yang akan diolah
   }

   function update($values,$clause) //fungsi update
   {
      $db = new Database(); //buat objek database untuk koneksi
      $table = $this->tableName; //Atur nama tabel
      $query = "UPDATE $table SET $values WHERE $clause"; //Query
      $exe = mysqli_query($db->connect(),$query); //eksekusi query
      return $exe; //kembalikan nilai hasil eksekusi
   }

   function insert($values) //fungsi insert
   {
      $db = new Database(); //buat objek database untuk koneksi
      $table = $this->tableName; //atur nama tabel
      $query = "INSERT INTO $table VALUES ($values)"; //query
      $execute = mysqli_query($db->connect(),$query); //eksekusi
      return $execute; //kembalikan nilai sesudah eksekusi
   }

   function select($clause) //fungsi select
   {
      $dbconf = new Database(); //buat objek database untuk koneksi
      $table = $this->tableName; //atur nama tabel
      $query = "SELECT * FROM $table WHERE $clause"; //query
      $exe = mysqli_query($dbconf->connect(),$query); //eksekusi
      $data['rows'] = mysqli_num_rows($exe); //hitung total data yang diambil masukkan ke array $data
      $data['single'] = mysqli_fetch_array($exe); //ambil satu baris dan masukkan ke array $data
      $data['result'] = $exe; //Ambil hasil eksekusi dan masukkan ke array $data
      return $data; //kembalikan array $data
   }

   function selectAll($clause) //fungsi select
   {
      $dbconf = new Database(); //buat objek database untuk koneksi
      $table = $this->tableName; //atur nama tabel
      $query = "SELECT * FROM $table WHERE $clause"; //query
      $exe = mysqli_query($dbconf->connect(),$query); //Eksekusi query
      $data['rows'] = mysqli_num_rows($exe); //Ambil satu baris data
      $data['result'] = $exe; //Ambil hasil eksekusi
      return $data; //kembalikan array $data
   }

   function delete($clause)
   {
      $dbconf = new Database(); //buat objek database untuk koneksi
      $table = $this->tableName; //Atur nama tabel
      $query = "DELETE FROM $table WHERE $clause"; //query
      $exe = mysqli_query($dbconf->connect(),$query); //eksekusi
      return $exe; //kembalikan status eksekusi query
   }
}