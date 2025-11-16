<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas builder
$builder = new Querybuilder("kategori"); //Buat objek
$id = $_POST['id']; //Post ID kategori
//Normalisasi string
$name = str_replace("<br>","",$_POST['name']);
$desc = str_replace("<br>","",$_POST['desc']);
//Update data kategori
$update = $builder->update("nama_kat = '$name', deskripsi = '$desc'","id_data = '$id'");
echo json_encode(["name"=>$name,"desc"=>$desc]);