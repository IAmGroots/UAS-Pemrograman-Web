<?php
include "../../koneksi.php";

$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM tb_games WHERE id_game = '$id'");

if ($result) {
  echo "
      <script>
        alert('Data berhasil dihapus');
        document.location.href = '../index.php';
      </script>
    ";
} else {
  echo "
      <script>
        alert('Data gagal dihapus');
        document.location.href = '../index.php';
      </script>
    ";
}
