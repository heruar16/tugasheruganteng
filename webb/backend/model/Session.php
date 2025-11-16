<?php
class Session
{
   function startSession($key,$value) //fungsi pembuat sesi
   {
      session_start();//mulai sesi
      $_SESSION[$key] = $value; //atur sesi menggunakan $key-$value pair
      return 1; //kembalikan status pembuatan sesi
   }

   function sessionEnd() //penghapus sesi
   {
      session_start(); //mulai sesi
      session_destroy(); //bersihkan semua sesi aktif
      return 1; //kembalikan status penghapusan sesi
   }
}