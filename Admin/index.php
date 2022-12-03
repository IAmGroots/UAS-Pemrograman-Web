<?php
include "../koneksi.php";
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../dashboard.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
  <div class="bg">
    <?php include "../Template/headerAdmin.php" ?>
    <div class="container">
      <div class="head">
        <h2>Dashboard Games</h2>
        <div class="searchBox">
          <form action="" method="GET" class="search">
            <input type="text" name="keyword" id="" placeholder="Genshin Impact">
            <button type="submit" class="btn-search" name="search">
              <i class="uil uil-search"></i>
            </button>
          </form>
          <a href="index.php" class="back">Refresh</a>
        </div>
      </div>
      <!-- <a href="logout.php" class="back">Logout</a> -->
      <!-- <a href="dashboard.php" class="back">Refresh</a> -->
      <div class="table-box">
        <table>
          <tr>
            <td class="tNomor" style="color: #000000;">No</td>
            <td class="tNama" style="color: #000000;">Nama</td>
            <td class="tGenre" style="color: #000000;">Genre</td>
            <td class="tDeskripsi" style="color: #000000;">Deskripsi</td>
            <td class="tGambar" style="color: #000000;">Gambar</td>
            <td class="tWaktu" style="color: #000000;">Keterangan</td>
            <td class="tActionHead" style="color: #000000;">Aksi</td>
          </tr>

          <?php
          if (isset($_GET["search"])) {
            $keyword = $_GET["keyword"];
            $result = mysqli_query($koneksi, "SELECT * FROM tb_games WHERE
                      nama LIKE '%$keyword%' OR
                      genre LIKE '%$keyword%' OR
                      deskripsi LIKE '%$keyword%' OR
                      waktu LIKE '%$keyword%'");
          } else {
            $result = mysqli_query($koneksi, "SELECT * FROM tb_games");
          }
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='row'>";
            echo "<td class='tNomor'>$no</td>";
            echo "<td class='tNama'>$row[nama]</td>";
            echo "<td class='tGenre'>$row[genre]</td>";
            echo "<td class='tDeskripsi'>$row[deskripsi]</td>";
            echo "<td class='tGambar'><img src='../databaseImages/$row[gambar]' class='gambar-cover' width='100%' height='100%' alt='Gambar'></td>";
            echo "<td class='tWaktu'>$row[waktu]</td>";
            echo "<td class='tAction'>
                    <a href='Games/editData.php?id=$row[id_game]' class='kuning'><i class='uil uil-edit'></i></a>
                    <a href='Games/deleteData.php?id=$row[id_game]' class='merah'><i class='uil uil-trash-alt'></i></a>
                  </td>";
            echo "</tr>";
            $no++;
          }
          ?>
          <tr>
            <td class="tombol" colspan="7">
              <a href="Games/addData.php">Tambah Data</a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>

</html>