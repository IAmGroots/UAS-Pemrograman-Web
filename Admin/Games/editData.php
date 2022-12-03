<?php
include "../../koneksi.php";
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../../index.php");
  exit;
}

$id = $_GET["id"];
$query = mysqli_query($koneksi, "SELECT * FROM tb_games WHERE id_game ='$id'");
$row = mysqli_fetch_assoc($query);

if (isset($_POST["ubah"])) {
  date_default_timezone_set("asia/kuala_lumpur");
  $nama = $_POST["nama"];
  $genre = $_POST["genre"];
  $rating = $_POST["rating"];
  $deskripsi = $_POST["deskripsi"];
  $waktu = date("y-m-d h:i:s");
  $gambar = $_FILES["gambar"]["name"];
  $gambarBaru = "$id.png";
  $tmp = $_FILES["gambar"]["tmp_name"];

  if (move_uploaded_file($tmp, '../../databaseImages/' . $gambarBaru)) {
    $sql = "UPDATE tb_games SET 
              nama = '$nama',
              genre = '$genre',
              deskripsi = '$deskripsi',
              rating = '$rating',
              gambar = '$gambarBaru',
              waktu = '$waktu'
              WHERE id_game = '$id'";

    $result = mysqli_query($koneksi, $sql);

    if ($result) {
      echo "
          <script>
            alert('Data berhasil diubah');
            document.location.href = '../index.php';
          </script>
        ";
    } else {
      echo "
        <script>
          alert('Data gagal diubah');
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
  <title>Edit</title>
  <link rel="stylesheet" href="../../add-edit.css">
</head>

<body>
  <div class="bg">
    <div class="container">
      <form action="" method="POST" enctype="multipart/form-data">
        <h3>Edit Games</h3>
        <div class="inputBox">
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $row["nama"] ?>" required>
        </div>
        <div class="inputBox">
          <label for="">Genre</label>
          <input type="text" name="genre" value="<?php echo "$row[genre]" ?>" required>
        </div>
        <div class="inputBox">
          <label for="">Rating</label>
          <input type="number" name="rating" step="0.01" value="<?php echo "$row[rating]" ?>" required>
        </div>
        <div class="inputBox">
          <label for="">Gambar</label>
          <input type="file" name="gambar" value="<?php echo "$row[gambar]" ?>" required>
        </div>
        <div class="inputBox">
          <label for="">Deskripsi</label>
          <textarea name="deskripsi" cols="30" rows="10"><?php echo "$row[deskripsi]" ?></textarea>
        </div>
        <input type="submit" value="Ubah Games" name="ubah">
        <a href="../index.php">Kembali</a>
      </form>
    </div>
  </div>
</body>

</html>