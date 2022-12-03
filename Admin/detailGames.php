<?php
session_start();
if ($_SESSION["akses"] != "admin") {
  header("location: ../index.php");
  exit;
}
require "../koneksi.php";
$user = mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE username = '$_SESSION[session_username]'");
$dataUser = [];
while ($row = mysqli_fetch_assoc($user)) {
  $dataUser[] = $row;
}
foreach ($dataUser as $data);
if (isset($_POST["buy"])){
  echo"
      <script>
          document.location.href = 'listGames.php';
      </script>
  ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <style>
    body {
      background: rgb(50, 100, 200);
    }
    .container {
      /* border: 1px solid blue; */
      min-height: 100vh;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .games {
      display: flex;
      padding: 30px;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border-radius: 20px;
    }

    .gambar {
      width: 30%;
      border-radius: 15px;
    }

    .deskripsi {
      width: 100%;
      margin-left: 50px;
      padding-right: 50px;
    }

    .deskripsi h1 {
      margin-bottom: 10px;
    }

    .deskripsi p {
      font-size: 18px;
    }

    .subDeskripsi {
      display: flex;
      align-items: center;
    }

    .subDeskripsi p {
      margin-top: 10px 0;
      margin-right: 40px;
    }

    form {
      width: 100%;
    }

    .fullDeskripsi {
      display: flex;
      flex-direction: column;
      text-align: justify;
      margin-top: 20px;
    }

    .fullDeskripsi input[type=submit] {
      width: 100%;
      padding: 10px 0;
      text-align: center;
      text-decoration: none;
      color: #000000;
      font-size: 18px;
      font-weight: 700;
      letter-spacing: 1px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 10px;
      margin-top: 20px;
      backdrop-filter: blur(10px);
      transition: all 0.5s;
      border: none;
      cursor: pointer;
    }

    .fullDeskripsi input[type=submit]:hover {
      background: rgba(255, 255, 255, 0.1)
    }
  </style>
</head>

<body>
  <?php include "../Template/headerAdmin.php" ?>

  <?php
  $id_game = $_GET['id'];
  $result = mysqli_query($koneksi, "SELECT * FROM tb_games WHERE id_game = '$id_game'");
  $dataGames = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $dataGames[] = $row;
  }
  foreach ($dataGames as $data);
  ?>

  <div class="container">
    <div class="games">
      <img src='../databaseImages/<?php echo $data['gambar'] ?>' class="gambar" alt='' />
      <div class="deskripsi">
        <h1><?php echo $data['nama'] ?></h1>
        <div class="subDeskripsi">
          <p>Genre</p>
          <p><?php echo $data['genre'] ?></p>
        </div>
        <div class="subDeskripsi">
          <p>Rating</p>
          <p><?php echo $data['rating'] ?></p>
        </div>
        <div class="fullDeskripsi">
          <p>Deskripsi Games</p>
          <p><?php echo $data['deskripsi'] ?></p>
          <form action="" method="POST">
            <input type="submit" name="buy" value="Buy Now">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>