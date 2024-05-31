<?php




include('koneksi.php');
?>
<head>
<?php include('header.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


<form class="form row" method="POST" action="" name="pasienform" onsubmit="return(validate());">
<?php
$nama = '';
$alamat = '';
$no_ktp = '';
$no_hp = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM pasien 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_ktp = $row['no_ktp'];
        $no_hp = $row['no_hp'];

    }
?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<?php
}
?>
  <!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="C:\xampp\htdocs\poliklinik_bengkod\app\pages\examples/index.php"><b>Poliklinik</a>
  </div>

  <div class="card center">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar Pasien</p>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body ">
                  <div class="form-group">
                    <label for="nama">Nama Pasien</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan  Nama"value="<?php echo $nama ?>">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat"value="<?php echo $alamat ?>">
                  </div>
                  <div class="form-group">
                    <label for="no_ktp">No ktp</label>
                    <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukan No ktp"value="<?php echo $no_ktp ?>">
                  </div>
                  <div class="form-group">
                    <label for="no_hp">No hp</label>
                    <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No hp"value="<?php echo $no_hp ?>">
                  </div>
                    </div>
                  </div>
                  </div>
                  </div>
                <!-- /.card-body -->
                <div class="d-flex justify-content-start mt-2">
        <button class="btn btn-primary rounded-pill px-3" type="submit"name="simpan">Simpan</button>
    </div>
</form>

<?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE pasien  SET 
                                            nama = '" . $_POST['nama'] . "',
                                            alamat = '" . $_POST['alamat'] . "',
                                            no_ktp = '" . $_POST['no_ktp'] . "',
                                            no_hp = '" . $_POST['no_hp'] . "',
                                            no_rm = '" . $_POST['no_rm'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien (nama,alamat,no_ktp,no_hp,no_rm) 
                                            VALUES ( 
                                                '" . $_POST['nama'] . "',
                                                '" . $_POST['alamat'] . "',
                                                '" . $_POST['no_ktp'] . "',
                                                '" . $_POST['no_hp'] . "',
                                                '" . $_POST['no_rm'] . "'
                                                )");
        }

        echo "<script> 
                document.location='daftarpoli.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM pasien  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='pasien.php';
                </script>";
    }
    ?>
            <!-- /.card -->

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
