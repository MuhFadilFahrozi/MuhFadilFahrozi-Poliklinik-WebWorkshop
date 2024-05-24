<?php
session_start();
include('koneksi.php');
if (isset($_POST["login_dokter"])){

  $username =$_POST["username"];
  $passsword =$_POST["password"];

  $ambil = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");

  if(mysqli_num_rows($ambil) === 1 ){

    $row = mysqli_fetch_assoc($ambil);
    if (password_verify($passsword, $row["password"])){
      $_SESSION["login_dokter"]= true;
      header("Location:index_dokter.php");
      exit;
    }else {
      echo "<script>
      alert('Username atau password salah');
      window.location = 'login_dokter.php';
      </script>";
    }

  } else {
    echo "<script>
    alert('Username atau password salah');
    window.location = 'login_dokter.php';
    </script>";
  }
  $error = true;
 }
  
?>
<!DOCTYPE html>
<html>
<?php include('header.php');?>
<body class="hold-transition login-page">
<div class="login-card">
  <div class="login-logo">
    <a href="C:\xampp\htdocs\poliklinik_bengkod\app\pages\examples/index.html"><b>Login Dokter</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      
      <form action="login_dokter.php" method="POST">
        <div class="input-group mb-3">
        <input type="text" name="username" id="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" name="password" id="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <!-- /.col -->
          <div class="col center">
          <input type="submit" class="btn btn-primary btn-block" value="login_dokter" id="login_dokter"name="login_dokter"></input>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <p class="col center mb-0">
        <a href="register.php" class="text-center">Register </a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</body>



