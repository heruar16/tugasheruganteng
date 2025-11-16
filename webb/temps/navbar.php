<div class="navbar">
   <div class="nav-base-group">
      <div class="nav-group">
         <a href="index.php"><img src="assets/logos.png" style="padding:5px;background:#ddd;border-radius:100px;width:30px;height:30px;object-fit: contain"></a>
      </div>
      <div class="nav-group flex-center">
         <a href="index.php">Beranda</a>
         <a href="produkview.php" data-target=".nav-cont-cat">Produk</a>
         <!--      <a href="#" class="opencat" data-target=".nav-cont-src" style="border-right:1px solid #ddd;margin-right:20px;padding-right:20px;"><i class="fas fa-search"></i></a>-->
      </div>
   </div>
   <div class="nav-base-group">
      <div class="nav-group" style="">
         <?php
         if(!empty($_SESSION['user']))
         {
            if($_SESSION['level'] == "user")
            {
               ?>
               <a style="margin-right:5px;width:25px;height:25px;text-align: center;display: flex;flex-flow: row;align-items: center;align-content: center;justify-content: center" class="nav-acc" href="transhistory.php"><i class="fas fa-clock"></i></a>
               <a style="margin-right:5px;width:25px;height:25px;text-align: center;display: flex;flex-flow: row;align-items: center;align-content: center;justify-content: center" class="nav-acc" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
               <a style="margin-right:5px;" class="nav-acc" href="profil.php"><i class="fas fa-user"></i> Profil</a>
               <a class="nav-acc" href="backend/logout.php">Keluar</a>
               <?php
            }
            else if($_SESSION['level'] == "admin")
            {
               ?>
               <a style="margin-right:5px;width:25px;height:25px;text-align: center;display: flex;flex-flow: row;align-items: center;align-content: center;justify-content: center" class="nav-acc" href="transhistory.php"><i class="fas fa-clock"></i></a>
               <a style="margin-right:5px;width:25px;height:25px;text-align: center;display: flex;flex-flow: row;align-items: center;align-content: center;justify-content: center" class="nav-acc" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
               <a style="margin-right: 5px;" class="nav-acc" href="panel/dash.php"><i class="fas fa-user"></i> Admin</a>
               <a style="margin-right: 5px;" class="nav-acc" href="backend/logout.php">Keluar</a>
               <?php
            }
         }
         else{
            ?>
            <a class="nav-acc" href="login.php">Masuk</a>
            <a class="nav-acc" href="register.php">Daftar</a>
            <?php
         }
         ?>
      </div>
   </div>

   <div class="nav-container nav-cont-cat">
      <?php
      $cat = new Querybuilder("kategori");
      $get = $cat->selectAll("tampil = '1' ORDER BY nama_kat ASC");
      while($f = mysqli_fetch_array($get['result']))
      {
         ?>
         <a href="kategori.php?cat=<?= $f['id_data'] ?>"><?= $f['nama_kat'] ?></a>
         <?php
      }
      ?>
   </div>

   <div class="nav-container nav-cont-src flex-center">
      <form action="" method="post">
         <input type="text" required name="search" class="nav-search" placeholder="Cari produk...">
         <button type="button" class="src-submit"><i class="fas fa-search"></i></button>
      </form>

      <div class="search-result">
         <h1 style="text-align: center"><i class="fas fa-search"></i> Mencari...</h1>
      </div>
   </div>
</div>

<form action="backend/login.php" method="post">
   <div class="nav-login nav-pop" data-state="off">
      <div class="nav-pop-body">
         <button style="position: absolute;top:0;right:0;" type="button" class="nav-pop-dismiss"><i class="fas fa-times"></i></button>
         <h1>Masuk</h1>
         <p>Gunakan alamat E-Mail kamu</p>
         <input type="email" required name="email" placeholder="Alamat E-Mail">
         <input type="password" required name="password" placeholder="Sandi" minlength="8">
         <button type="submit">Masuk</button>
         <p style="text-align: center">Belum punya akun?</p>
         <a href="javascript:void(0)" class="navacc" data-target=".nav-register">Buat akun</a>
      </div>
   </div>
</form>

<form method="post" action="backend/register.php">
   <div class="nav-register nav-pop" data-state="off">
      <div class="nav-pop-body">
         <form method="post">
            <button style="position: absolute;top:0;right:0;" type="button" class="nav-pop-dismiss"><i class="fas fa-times"></i></button>
            <h1>Daftar</h1>
            <input type="text" required name="nama" placeholder="Nama Lengkap">
            <input type="text" required name="hp" placeholder="Nomor HP">
            <input type="email" required name="email" placeholder="E-Mail">
            <input type="text" required name="alamat" placeholder="Alamat">
            <input type="password" required name="password" placeholder="Kata Sandi" minlength="8">
            <button type="submit">Buat Akun</button>
            <p style="text-align: center">Sudah punya akun?</p>
            <a href="javascript:void(0)" class="navacc" data-target=".nav-login">Masuk</a>
         </form>
      </div>
   </div>
</form>

<script>
   $(document).ready(function () {
      $(".nav-container").fadeOut(0);
      $(".opencat").click(function () {
         let target = $(this).attr("data-target");
         openContainer(target)
      });

      $(".nav-acc").click(function () {
         let target = $(this).attr("data-target");
         openPop(target);
      });

      $(".open-popup").click(function () {
         let target = $(this).attr("data-target");
         openPop(target);
      });

      $(".navacc").click(function () {
         let target = $(this).attr("data-target");
         openPop(target);
      });

      $(".nav-pop-dismiss").click(function () {
         $(".nav-pop").css("display","none");
         $(".nav-pop").attr("data-state","off");
      });

      function openContainer(target)
      {
         $(target).fadeToggle(300);
      }

      function openPop(target)
      {
         let state = $(target).attr("data-state");
         $(".nav-pop").css("display","none");
         $(".nav-pop").attr("data-state","off");
         $(".alert-wrapper").css("display","none");
         if(state === "off")
         {
            $(target).css("display","flex");
            $(target).attr("data-state","on");
         }
         else
         {
            $(target).css("display","none");
            $(target).attr("data-state","off");
         }
      }

      $(".alert-dismiss").click(function () {
         $(".alert-wrapper").fadeOut(300);
      });


      $(".nav-search").on("keyup",function () {
         let value = $(this).val();
         if($.trim(value) !== "")
         {
            $(".nav-cont-src").addClass("search-con");
            $(".search-result").fadeIn(200);
            search(value);
         }
         else
         {
            $(".nav-cont-src").removeClass("search-con");
            $(".search-result").fadeOut(0);
         }
      });

      function search(key)
      {
         let data = {"key":key};
         $.ajax({
            url:"viewholder/result.php",
            data:data,
            type:'post',
            success:function(res){
               $(".search-result").html(res);
            }
         })
      }
   });
</script>