<?php
require '../../backend/model/Session.php'; //Panggil kelas session
$ses = new Session(); //Buat objek session
$ses->sessionEnd(); //Akhiri sesi
header("location:../../index.php?loggedout");