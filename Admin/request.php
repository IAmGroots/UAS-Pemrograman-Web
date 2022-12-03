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
    table tr:last-child td {
      padding: 10px;
      font-weight: 400;
    }
    table tr td {
      padding: 10px 0;
    }
  </style>
</head>

<body>
  <div class="bg">
    <?php include "../Template/headerAdmin.php" ?>
    <div class="container">
      <div class="head">
        <h2>Dashboard Request</h2>
        <div class="searchBox">
          <form action="" method="GET" class="search">
            <input type="text" name="keyword" id="" placeholder="Genshin Impact">
            <button type="submit" class="btn-search" name="search">
              <i class="uil uil-search"></i>
            </button>
          </form>
          <a href="request.php" class="back">Refresh</a>
        </div>
      </div>
      <div class="table-box">
        <table>
          <tr>
            <td class="tNomor" style="color: #000000;">No</td>
            <td class="tNama" style="color: #000000;">User</td>
            <td class="tNama" style="color: #000000;">Email</td>
            <td class="tNama" style="color: #000000;">No HP</td>
            <td class="tNama" style="color: #000000;">Games</td>
          </tr>

          <?php
          if (isset($_GET["search"])) {
            $keyword = $_GET["keyword"];
            $result = mysqli_query($koneksi, "SELECT * FROM tb_permintaan
                      JOIN tb_pengguna ON tb_permintaan.id_user = tb_pengguna.id
                      WHERE
                      username LIKE '%$keyword%' OR
                      email LIKE '%$keyword%' OR
                      no_hp LIKE '%$keyword%' OR
                      nama_games LIKE '%$keyword%'");
          } else {
            $result = mysqli_query($koneksi, "SELECT * FROM tb_permintaan
                                              JOIN tb_pengguna ON tb_permintaan.id_user = tb_pengguna.id");
          }
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $nama = ucwords($row['username']);
            echo "<tr class='row'>";
            echo "<td class='tNomor'>$no</td>";
            echo "<td class='tNama'>$nama</td>";
            echo "<td class='tNama'>$row[email]</td>";
            echo "<td class='tNama'>$row[no_hp]</td>";
            echo "<td class='tNama'>$row[nama_games]</td>";
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