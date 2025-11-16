<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas
$builder = new Querybuilder("produk"); //Buat objek
$id = $_GET['id']; //Ambil id
$delete = $builder->delete("id_data = '$id'"); //Hapus produk
header("location:../produk.php?delete=ok");