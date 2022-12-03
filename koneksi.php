<?php 
  $koneksi = mysqli_connect("localhost", "root", "", "final web");
  if (!$koneksi) {
    die("Gagal terhubung ke database" . mysqli_connect_error());
  }
?>