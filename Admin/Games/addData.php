<?php
include "../../koneksi.php";
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../../index.php");
  exit;
}

if (isset($_POST["tambah"])) {
  date_default_timezone_set("asia/kuala_lumpur");
  $nama = $_POST["nama"];
  $genre = $_POST["genre"];
  $rating = $_POST["rating"];
  $deskripsi = $_POST["deskripsi"];
  $waktu = date("y-m-d h:i:s");
  $gambar = $_FILES["gambar"]["name"];
  $gambarBaru = "$nama.png";
  $tmp = $_FILES["gambar"]["tmp_name"];

  if (move_uploaded_file($tmp, '../../databaseImages/' . $gambarBaru)) {
    $sql = "INSERT INTO tb_games VALUES 
              (0,
              '$nama',
              '$genre',
              '$deskripsi',
              '$rating',
              '$gambarBaru',
              '$waktu')";

    $result = mysqli_query($koneksi, $sql);

    if ($result) {
      echo "
          <script>
            alert('Data berhasil ditambah');
            document.location.href = '../index.php';
          </script>
        ";
    } else {
      echo "
          <script>
            alert('Data gagal ditambah');
            document.location.href = '../index.php';
          </script>
        ";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add</title>
  <link rel="stylesheet" href="../../add-edit.css">
</head>

<body>
  <div class="bg">
    <div class="container">
      <form action="" method="POST" enctype="multipart/form-data">
        <h3>Tambah Games</h3>
        <div class="inputBox">
          <label for="">Nama</label>
          <input type="text" name="nama" placeholder="Nama Games" required>
        </div>
        <div class="inputBox">
          <label for="">Genre</label>
          <input type="text" name="genre" placeholder="Genre Games" required>
        </div>
        <div class="inputBox">
          <label for="">Rating</label>
          <input type="number" name="rating" step="0.1" placeholder="Rating Games" required>
        </div>
        <div class="inputBox">
          <label for="">Gambar</label>
          <input type="file" name="gambar" required>
        </div>
        <div class="inputBox">
          <label for="">Deskripsi</label>
          <textarea name="deskripsi" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" value="Tambah Games" name="tambah">
        <a href="../index.php">Kembali</a>
      </form>
    </div>
  </div>
</body>

</html>