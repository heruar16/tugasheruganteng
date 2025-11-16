<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas
$builder = new Querybuilder("kategori"); //Buat objek
//Post data dari FORM
$name = $_POST['name'];
$desc = $_POST['desc'];
$show = $_POST['show'];
$create = $builder->insert("'','$name','$desc','$show'"); //Tambah data
if($create)//Jika berhasil
{
   header("location:../kategori.php?create=true");
}
else{ //Jika gagal
   header("location:../kategori.php?create=false");
}