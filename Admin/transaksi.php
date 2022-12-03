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
  <style>
    .tWaktu {
      width: 20%;
    }
    .tAction {
      width: 10%;
    }
    .tStatus {
      text-align: center;
      width: 10%;
    }
    table tr:last-child td {
      font-weight: 400;
    }
  </style>
</head>

<body>
  <div class="bg">
    <?php include "../Template/headerAdmin.php" ?>
    <div class="container">
      <div class="head">
        <h2>Dashboard Transaksi</h2>
        <div class="searchBox">
          <form action="" method="GET" class="search">
            <input type="text" name="keyword" id="" placeholder="Genshin Impact">
            <button type="submit" class="btn-search" name="search">
              <i class="uil uil-search"></i>
            </button>
          </form>
          <a href="transaksi.php" class="back">Refresh</a>
        </div>
      </div>
      <div class="table-box">
        <table>
          <tr>
            <td class="tNomor" style="color: #000000;">No</td>
            <td class="tGambar" style="color: #000000;">Gambar</td>
            <td class="tNama" style="color: #000000;">User</td>
            <td class="tGenre" style="color: #000000;">Games</td>
            <td class="tWaktu" style="color: #000000;">Keterangan</td>
            <td class="tStatus" style="color: #000000;">Status</td>
            <td class="tActionHead" style="color: #000000;">Aksi</td>
          </tr>

          <?php
          if (isset($_GET["search"])) {
            $keyword = $_GET["keyword"];
            $result = mysqli_query($koneksi, "SELECT * FROM tb_transaksi
                      JOIN tb_pengguna ON tb_transaksi.id_user = tb_pengguna.id
                      JOIN tb_games ON tb_transaksi.id_game = tb_games.id_game
                      WHERE
                      username LIKE '%$keyword%' OR
                      nama LIKE '%$keyword%' OR
                      keterangan LIKE '%$keyword%' OR
                      `status` LIKE '%$keyword%'");
          } else {
            $result = mysqli_query($koneksi, "SELECT * FROM tb_transaksi
                                              JOIN tb_pengguna ON tb_transaksi.id_user = tb_pengguna.id
                                              JOIN tb_games ON tb_transaksi.id_game = tb_games.id_game");
          }
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $nama = ucwords($row['username']);
            $status = ucwords($row['status']);
            echo "<tr class='row'>";
            echo "<td class='tNomor'>$no</td>";
            echo "<td class='tGambar'><img src='../databaseImages/$row[gambar]' class='gambar-cover' width='100%' height='100%' alt='Gambar'></td>";
            echo "<td class='tNama'>$nama</td>";
            echo "<td class='tGenre'>$row[nama]</td>";
            echo "<td class='tWaktu'>$row[keterangan]</td>";
            echo "<td class='tStatus'>$status</td>";
            echo "<td class='tAction'>
                    <a href='Transaksi/editData.php?id=$row[id_transaksi]' class='kuning'><i class='uil uil-edit'></i></a>
                    <a href='Transaksi/deleteData.php?id=$row[id_transaksi]' class='merah'><i class='uil uil-trash-alt'></i></a>
                  </td>";
            echo "</tr>";
            $no++;
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>