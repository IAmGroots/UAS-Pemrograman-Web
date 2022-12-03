<?php
session_start();
if ($_SESSION["akses"] != "user") {
  header("location: ../index.php");
  exit;
}
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script>
    function lightMode() {
      const isLight = document.body.classList.toggle("light-theme");
      let icon = document.getElementById("icon-mode");
      let mode = "";
      if (isLight) {
        icon = "../images/sun.png";
      } else {
        icon = "../images/moon.png";
      }
      document.getElementById("icon-mode").src = icon;
    }
  </script>
  <style>
    /* body {
      background: rgb(50, 100, 200);
    } */

    .boxPesanan {
      padding-top: 30px;
      margin: auto;
      width: 90%;
      display: flex;
      flex-wrap: wrap;
      /* border: 1px solid blue; */
    }

    .pesanan {
      margin: auto;
      margin-bottom: 30px;
      width: 30%;
      padding: 10px;
      border: 1px solid rgba(255, 255, 255, 0.25);
      display: flex;
      justify-content: space-between;
      flex-direction: row;
      align-items: center;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(5px);
      color: #ffffff;
      border-radius: 13px;
    }

    .deskripsi {
      margin: 0;
      margin-left: 5px;
      display: flex;
      text-align: left;
      flex-direction: column;
    }

    .pesanan p {
      padding: 0;
      margin-bottom: 3px;
      font-weight: 400;
      border: 1px solid transparent;
    }

    .gambar-games {
      width: 50%;
      border-radius: 10px;
    }
    .pesanan .status {
      font-weight: 600;
      font-size: 15px;
      letter-spacing: 1px;
      margin-top: 5px;
      padding-top: 2px;
      padding-bottom: 5px;
      border: 1px solid transparent;
      border-radius: 8px;
      text-align: center;
    }

    .back {
      text-decoration: none;
      color: #ffffff;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      padding: 5px 10px;
      margin-right: 7px;
      border: 1px solid transparent;
      transition: all 0.5s;
    }

    .back:hover {
      border: 1px solid rgba(255, 255, 255, 0.4);
    }

    .bagianAtas {
      width: 90%;
      /* height: 80px; */
      display: flex;
      flex-direction: column;
      align-items: center;
      /* text-align: center; */
      margin-top: 90px;
      /* border: 1px solid blue; */
    }

    .tombol{
      width: 100%;
      display: flex;
      justify-content: left;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <!-- header -->
  <?php include "../Template/headerUser.php" ?>
  <div class="bagianAtas">
    <h1> Daftar Transaksi Anda </h1>
  </div>


  <div class="boxPesanan">
    <?php
    $user = mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE username = '$_SESSION[session_username]'");
    $dataUser = [];
    while ($row = mysqli_fetch_assoc($user)) {
      $dataUser[] = $row;
    }
    foreach ($dataUser as $data);

    $result = mysqli_query(
      $koneksi,
      "SELECT * FROM tb_transaksi
                              INNER JOIN tb_pengguna ON tb_transaksi.id_user = tb_pengguna.id
                              INNER JOIN tb_games ON tb_transaksi.id_game = tb_games.id_game
                              WHERE tb_transaksi.id_user = $data[id]"
    );
    if (mysqli_num_rows($result) === 0) {
      echo "<p
                      style='
                          color: #ffffff;
                          font-size: 24px;
                          width: 100%;
                      '> 
                      Tidak Ada Pesanan </p>";
    } else {
      $pesanan = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $pesanan[] = $row;
      }
      foreach ($pesanan as $pesan) :
    ?>
        <div class="pesanan">
          <img src="../databaseImages/<?php echo $pesan['gambar']; ?>" class="gambar-games" alt="Gambar Produk">
          <div class="deskripsi">
            <p style="font-weight: 600; margin-bottom: 10px;"><?php echo ucwords($pesan['nama']); ?></p>
            <p style="margin-bottom: 10px;">Genre : <?php echo $pesan['genre']; ?></p>
            <p style="margin-bottom: 10px;">Keterangan</p>
            <p style="margin-bottom: 20px;"><?php echo $pesan['waktu']; ?></p>
            <?php
            $status = ucwords($pesan['status']);
            if ($pesan['status'] == "berhasil") {
              echo "<p class='status'
                              style='
                                  margin: auto;
                                  width: 90px;
                                  background: #28a745;'
                              >$status</p>";
            } else if ($pesan['status'] == "gagal") {
              echo "<p class='status'
                              style='
                                  margin: auto;
                                  width: 70px;
                                  background: #dc3545;'
                              >$status</p>";
            } else {
              echo "<p class='status' 
                              style='
                                  margin: auto;
                                  width: 105px;
                                  background: #ffc107;
                                  color: #000000;'
                              >$status</p>";
            }
            ?>
            <!-- <div class="action">
                          <button>
                              <a href="../pesanan/edit_pesanan_user.php?id=<?php echo $pesan['id_transaksi']; ?>">Edit</a>
                          </button>
                          <button>
                              <a href="../pesanan/hapus.php?id=<?php echo $pesan['id_transaksi']; ?>">Delete</a>
                          </button>
                      </div> -->
          </div>
        </div>
    <?php
      endforeach;
    }
    ?>
  </div>
</body>
<script src="../script.js"></script>
</html>