<?php
session_start();
$hostname = "localhost";
$user = "root";
$password = "";
$db_name ="poliklinik";

$mysqli = mysqli_connect($hostname,$user,$password,$db_name) or die (mysqli_error($koneksi));

if (isset($_SESSION['login'])){
	header("location:index.php");
	exit;
  }

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $cek_user = mysqli_query($mysqli,"SELECT * FROM user WHERE username = '$username'");
    $cek_login = mysqli_num_rows($cek_user);


    if ($cek_login > 0) {
      echo" <script>
        alert('Username telah terdaftar');
        window.location = 'register.php';
      </script>";
    } else {
      if ($password != $password2){
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        window.location = 'register.php';
      </script>";
      } else {
        $password = password_hash($password,PASSWORD_DEFAULT);
        mysqli_query($mysqli,"INSERT INTO user VALUE('','$username','$password')");
        echo "<script>
        alert('Data berhasil di kirim ');
        window.location = 'login.php';
      </script>";
      }
    }
  }


?>
<?php include('header.php')?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="C:\xampp\htdocs\poliklinik_bengkod\app\pages\examples/index.php"><b>Poliklinik</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register akun baru</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
        <input class="username" type="text" name="username" placeholder="username" required="yes">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input class="text" type="password" name="password" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input class="text w3lpass" type="password" name="password2" placeholder="Confirm Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          </div>
          <!-- /.col -->
          <div class="col-4 center">
            <input type="submit" class="btn btn-primary btn-block" value="SIGNUP" name="submit"></input>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.php" class="text-center">Sudah Punya Akun</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
