<?php
require "koneksi.php";
if (isset($_POST["submit"])) {
  echo "
  <script>
    document.location.href = 'login.php';
  </script>
";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <script>
    function lightMode() {
      const isLight = document.body.classList.toggle("light-theme");
      let icon = document.getElementById("icon-mode");
      let mode = "";
      if (isLight) {
        mode = "Light Mode";
        icon = "images/sun.png";
      } else {
        mode = "Dark Mode";
        icon = "images/moon.png";
      }
      // Manipulasi DOM 1
      document.getElementById("icon-mode").src = icon;
    }
  </script>
</head>

<body>
  <!-- Navigation Start -->
  <?php include "Template/headerGuest.php" ?>
  <!-- Navigation End -->

  <!-- Home Page Start -->
  <div class="container-banner banner" id="home">
    <div class="judul">PlayStation 3</div>
    <div class="main-teks">
      <p>
        PlayStation 3 (Jepang: プレイステーション 3; merek dagang: PLAYSTATION
        3, disingkat PS3) adalah konsol Sony generasi ketiga. PlayStation 3
        merupakan penerus dari PlayStation dan PlayStation 2. Konsol ini
        bersaing dengan Xbox 360 dari Microsoft dan Wii dari Nintendo.
        PlayStation 3 dirilis di Jepang pada tanggal 11 November 2006, dan
        dirilis pada tanggal 17 November 2006 di Amerika Utara, Hong Kong dan
        Taiwan, dan 1 atau 7 Maret 2007 di Eropa dan Australasia, dan wilayah
        lainnya.
      </p>
      <div class="teks">
        <br />
        <p>
          PlayStation 3 secara resmi diperkenalkan kepada dunia pada tanggal
          16 Mei 2005 di E3. Konfigurasi final pertama dipertunjukkan di TGS
          (Tokyo Game Show) 2006. Teknologi terbaru yang digunakan adalah cell
          processor-nya, kemampuan cell processor untuk melakukan operasi
          floating point sangat baik karena cell processor merupakan
          arsitektur vector processor. Bahkan prosesor yang digunakan pada
          PlayStation 3 ini merupakan prosesor yang tercanggih saat ini.
          Selain itu GPU dibuat sendiri oleh Sony yang bekerjasama dengan
          NVidia.
        </p>
      </div>
    </div>
    <div class="btn-more">
      <p>Read More <i class="uil uil-arrow-right"></i></p>
    </div>
  </div>
  <!-- Home Page End -->

  <!-- Games Page Start -->
  <div class="container" id="games">
    <div class="listGames">Top 10 PS3 Games For You</div>
    <div class="boxCard">
      <?php
      $result = mysqli_query($koneksi, "SELECT * FROM tb_games WHERE rating >= 8 Limit 10");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<img src='databaseImages/$row[gambar]' alt='' />";
        echo "<div class='overlay overlayBg'>";
        echo "<div class='tittle'>$row[nama]</div>";
        echo "<div class='desc'>";
        echo "<a href='cek_login.php?id=$row[id_game]'>Beli Sekarang</a>";
        echo "<span>Rating $row[rating]/10</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
  </div>

  <!-- About Me n Form Page Start -->
  <div class="container" id="aboutMe">
    <div class="aboutMe-form">
      <div class="biodata">
        <img src="images/foto-profile.jpg" alt="" />
        <div class="data">
          <p>Muhammad Hadiseptian Nursukamto</p>
          <p>2109106058</p>
          <p>Mahasiswa Informatika</p>
          <p>Universitas Mulawarman</p>
        </div>
      </div>
      <form action="" href="#aboutMe" method="POST">
        <div class="boxForm">
          <h3>Request Games</h3>
          <div class="inputBox">
            <label for="">Nama Games</label>
            <input type="text" name="" id="" placeholder="Nama Games" />
          </div>
          <div class="inputBox">
            <label for="">Email User</label>
            <input type="email" name="" id="" placeholder="Example@gmail.com" />
          </div>
          <div class="inputBox">
            <label for="">No Telepon</label>
            <input type="tel" name="" id="" placeholder="081234567890" />
          </div>
          <input type="submit" name="submit" value="Submit" />
        </div>
      </form>
    </div>
  </div>
  <!-- About Me n Form Page End -->

  <!-- Footer Start -->
  <?php include "Template/footer.php" ?>
  <!-- Footer End -->
</body>
<script src="script.js"></script>
</html>