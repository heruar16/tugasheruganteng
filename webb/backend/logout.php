<?php
require 'model/Session.php'; //Panggil kelas session
$ses = new Session(); //buat objek sesi
if($ses->sessionEnd()) //Akhiri semua sesi
{
   header("location:".$_SERVER['HTTP_REFERER']); //Kembalikan client ke halaman sebelumnya
}
