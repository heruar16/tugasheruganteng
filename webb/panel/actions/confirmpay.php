<?php
require '../../backend/model/Querybuilder.php'; //Panggil kelas builder
//Buat objek
$bRec = new Querybuilder("receipt");
$bTrans = new Querybuilder("trans");
$bPrd = new Querybuilder("produk");

//Ambil kode REG menggunakan $_GET
$reg = $_GET['reg'];
$rec = $bRec->select("kode_reg = '$reg'"); //Ambil data berdasrkan kode reg
if($rec['single']['status'] == 0) //jika status reg = 0
{
   //Perbarui menjadi 1
   $bRec->update("status = '1'","kode_reg = '$reg'");
   $bTrans->update("status = '1'","kode_reg = '$reg'");
   $trans = $bTrans->selectAll("kode_reg = '$reg'")['result'];
   while($f = mysqli_fetch_array($trans))
   {
      //Update data kuantitas (kurangi data stok produk)
      $id = $f['id_prd'];
      $qty = $f['qty'];
      $produk = $bPrd->select("id_data = '$id'")['single'];
      $newQty = $produk['qty'] - $qty;
      $update = $bPrd->update("qty = '$newQty'","id_data = '$id'");
   }

   header("location:../trans.php");
}
else{
   //Jika konfirmasi dibatalkan admin, kembalikan jumlah stok
   $bRec->update("status = '0'","kode_reg = '$reg'");
   $bTrans->update("status = '0'","kode_reg = '$reg'");
   $trans = $bTrans->selectAll("kode_reg = '$reg'")['result'];
   while($f = mysqli_fetch_array($trans))
   {
      $id = $f['id_prd'];
      $qty = $f['qty'];
      $produk = $bPrd->select("id_data = '$id'")['single'];
      $newQty = $produk['qty'] + $qty;
      $update = $bPrd->update("qty = '$newQty'","id_data = '$id'");
   }

   header("location:../trans.php");
}