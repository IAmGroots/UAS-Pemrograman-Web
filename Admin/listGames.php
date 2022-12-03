<?php
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../index.php");
  exit;
}
require "../koneksi.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Games</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <style>
    body {
      background: rgb(50, 100, 200);
    }
  </style>
</head>

<body>
  <?php include "../Template/headerAdmin.php" ?>
  <div class="container">
    <div class="searchBox">
      <form action="" method="GET" class="search">
        <input type="text" name="keyword" id="" placeholder="Genshin Impact">
        <button type="submit" class="btn-search" name="search">
          <i class="uil uil-search" ></i>
        </button>
      </form>
      <a href="listGames.php" class="back">Refresh</a>
    </div>
    <div class="boxCard">
      <?php
      if (isset($_GET["search"])) {
        $keyword = $_GET["keyword"];
        $result = mysqli_query($koneksi, "SELECT * FROM tb_games WHERE
                  nama LIKE '%$keyword%' OR
                  genre LIKE '%$keyword%' OR
                  deskripsi LIKE '%$keyword%' OR
                  waktu LIKE '%$keyword%'");
      }
      else {
      $result = mysqli_query($koneksi, "SELECT * FROM tb_games");
      }
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<img src='../databaseImages/$row[gambar]' alt='' />";
        echo "<div class='overlay overlayBg'>";
        echo "<div class='tittle'>$row[nama]</div>";
        echo "<div class='desc'>";
        echo "<a href='detailGames.php?id=$row[id_game]'>Buy Now</a>";
        echo "<span>Rating $row[rating]/10</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
  </div>
</body>

</html>