<?php
class Uploader
{
   private $file = null; //Variabel file untuk konstruktor
   private $path = null;//variabel path untuk konstruktor
   function __construct($path,$image)
   {
      //atur nilai konstruktor
      $this->file = $image;
      $this->path = $path;
   }


   function upload()
   {
      $filename = md5(rand(0,999999999)).".jpg";//Buat nama file acak
      $jpeg = imagecreatefromjpeg($this->file); //Buat ulang struktur file JPEG
      imagejpeg($jpeg,$this->file,60); //Lakukan kompresi dengan tingkat kompresi 60
      if($up = move_uploaded_file($this->file,$this->path.$filename))
      {
         return ["status"=>true,"payload"=>$filename]; //Kembalikan status dan nama file
      }
      else{
         return ["status"=>false,"payload"=>null]; //kembalikan status
      }
   }
}