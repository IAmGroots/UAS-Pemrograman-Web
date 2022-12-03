<?php
include "../../koneksi.php";
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../../index.php");
  exit;
}

$id = $_GET["id"];

$result = mysqli_query($koneksi, "SELECT * FROM tb_transaksi
                                              JOIN tb_pengguna ON tb_transaksi.id_user = tb_pengguna.id
                                              JOIN tb_games ON tb_transaksi.id_game = tb_games.id_game
                                              WHERE id_transaksi = $id");
$row = mysqli_fetch_assoc($result);
if (isset($_POST["ubah"])) {
  $status = $_POST["status"];
  $result = mysqli_query($koneksi, "UPDATE tb_transaksi SET `status` = '$status' WHERE id_transaksi = $id");
  if ($result) {
    echo "
        <script>
            alert('Data berhasil diubah');
            document.location.href = '../transaksi.php';
        </script>
    ";
  } else {
    echo "
        <script>
            alert('Data gagal diubah');
            document.location.href = '../transaksi.php';
        </script>
    ";
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
  <style>
    select {
      font-weight: 700;
      padding: 5px 10px;
      border-radius: 10px;
      border: none;
      outline: none;
    }
  </style>
</head>

<body>
  <div class="bg">
    <div class="container">
      <form action="" method="POST" enctype="multipart/form-data">
        <h3>Edit Transaksi</h3>
        <div class="inputBox">
          <label for="">Username</label>
          <input type="text" name="nama" value="<?php echo  ucwords($row['username']) ?>" required readonly>
        </div>
        <div class="inputBox">
          <label for="">Games</label>
          <input type="text" name="games" value="<?php echo "$row[nama]" ?>" required readonly>
        </div>
        <div class="inputBox">
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" step="0.01" value="<?php echo "$row[keterangan]" ?>" required readonly>
        </div>
        <div class="inputBox">
          <label for="">Status</label>
          <select name="status" id="" required>
            <?php
            if ($row['status'] != 'menunggu') {
              $status = ucwords($row['status']);
              echo "<option value='$row[status]' readonly >$status</option>";
            } else {
              echo "<option value=''>-</option>";
              echo "<option value='menunggu'>Menunggu</option>";
              echo "<option value='berhasil'>Berhasil</option>";
              echo "<option value='gagal'>Gagal</option>";
            }
            ?>
          </select>
        </div>
        <input type="submit" value="Submit" name="ubah">
        <a href="../transaksi.php">Kembali</a>
      </form>
    </div>
  </div>
</body>

</html>