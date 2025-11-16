<?php
require '../backend/model/Querybuilder.php';
session_start();
include 'sys/authchecker.php';
?>
<!DOCTYPE Html>
<html lang="id">
   <head>
      <title>Admin</title>
      <?php include 'temps/stylenscripts.php'?>
   </head>
   <body style="padding:0;margin:0;font-family: 'Rubiks';background-image: url('../assets/bg.jpg')">
   <?php include 'temps/sidebar.php' ?>
   <div class="panel-sections">
      <div class="sect-heading" style="width: 100%;box-sizing: border-box;flex-flow: column;align-items: center;margin-top:150px;">
         <img src="../assets/logos.png" style="width:100px;height:100px;object-fit: contain">
         <h1 style="width:100%;text-align: center">Dashboard</h1>
         <p style="width:100%;text-align: center">Selamat datang di KULINERKU</p>
      </div>

      <div class="sect-body" style="padding-top:100px;padding-bottom: 100px;">

      </div>
   </div>
   </body>
</html>