<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas Querybuilder
$builder = new Querybuilder("kategori"); //Buat objek untuk tabel kategori
$id = $_GET['id']; //Panggil ID
$delete = $builder->delete("id_data = '$id'"); //Jalankan fungsi hapus
header("location:../kategori.php?delete=ok"); //Kembalikan client ke halaman kategori