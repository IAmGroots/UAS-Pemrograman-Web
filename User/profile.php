<?php
session_start();
if ($_SESSION["akses"] != "user") {
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
if (isset($_POST["update"])) {
  $id = $data['id'];
  $usernameLama = strtolower($_SESSION["session_username"]);
  $username = strtolower($_POST["username"]);
  $password = $_POST["password"];
  $password = password_hash($password, PASSWORD_DEFAULT);
  $email = $_POST["email"];
  $no_hp = $_POST["no_hp"];

  $sql = "";
  if ($username == $usernameLama){
      $sql = "UPDATE tb_pengguna SET
              `role` = 'user', 
              `password` = '$password', 
              email = '$email', 
              no_hp = '$no_hp'
              WHERE id = '$id'";
  }
  else {
      $result = mysqli_query($koneksi, "SELECT username from tb_pengguna where username = '$username'");
      if (mysqli_fetch_assoc($result)){
          echo "
              <script>
                  alert('Username Telah Digunakan, Silahkan gunakan Username yang lain');
                  document.location.href = 'profile.php';
              </script>";
      } else {
          $sql = "UPDATE tb_pengguna SET 
                  `role` = 'user', 
                  username = '$username',
                  `password` = '$password', 
                  email = '$email', 
                  no_hp = '$no_hp'
                  WHERE id = '$id'";
      }
  }
  $result = mysqli_query($koneksi, $sql);
  if ( $result ) {
      $_SESSION["username"] = $username;
      echo"
          <script>
              alert('Data berhasil diubah');
              document.location.href = 'index.php';
          </script>
      ";
  }else{
      echo"
          <script>
              alert('Data gagal diubah');
              document.location.href = 'profile.php';
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
  <title>Profile</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <script>
    function lightMode() {
      const isLight = document.body.classList.toggle("light-theme");
      let icon = document.getElementById("icon-mode");
      let mode = "";
      if (isLight) {
        mode = "Light Mode";
        icon = "../images/sun.png";
      } else {
        mode = "Dark Mode";
        icon = "../images/moon.png";
      }
      document.getElementById("icon-mode").src = icon;
    }
  </script>
  <style>
    .container {
      min-height: 100vh;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    form {
      display: flex;
      flex-direction: column;
      height: 475px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border-radius: 20px;
    }
    .inputBox {
      width: 80%;
    }
    .inputBox input{
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .inputBox input:focus {
      border: 1px solid rgba(255, 255, 255, 0.5);
    }
    .inputBox input[type=submit]{
      color: #ffffff;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.5s;
    }
    .inputBox input[type=submit]:hover {
      color: #10dddd;
      background: rgba(255, 255, 255, 0.1)
    }
    .back {
      font-size: 14px;
      text-align: center;
      width: 15%;
      padding: 5px 10px;
    }
  </style>
</head>

<body>
  <?php include "../Template/headerUser.php" ?>
  <div class="container">
    <form action="" method="POST">
      <div class="inputBox">
        <label for="">Username</label>
        <input type="text" name="username" id="" value=<?php echo $data['username'] ?>>
      </div>
      <div class="inputBox">
        <label for="">Password</label>
        <input type="text" name="password" id="" value=<?php echo $_SESSION['session_password'] ?>>
      </div>
      <div class="inputBox">
        <label for="">Email</label>
        <input type="text" name="email" id="" value=<?php echo $data['email'] ?>>
      </div>
      <div class="inputBox">
        <label for="">No Hp</label>
        <input type="text" name="no_hp" id="" value=<?php echo $data['no_hp'] ?>>
      </div>
      <div class="inputBox">
        <input type="submit" name="update" id="" value="Update">
      </div>
      <div class="inputBox">
        <a href="index.php" class="back">Back</a>        
      </div>
    </form>
  </div>
</body>

</html>