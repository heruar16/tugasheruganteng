<?php
if(empty($_SESSION['level']))
{
   header("location:../");
}
else{
   if($_SESSION['level'] !== "admin")
   {
      header("location:../");
   }
}