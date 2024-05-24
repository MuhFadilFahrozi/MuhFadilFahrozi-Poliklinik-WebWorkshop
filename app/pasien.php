<?php

if ( isset($_SESSION["login"])){
    header("Location:login.php");

}
include('koneksi.php');
?>
<head>
<?php include('header.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include('navbar.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include('sidebar.php');?>

<form class="form row" method="POST" action="" name="pasienform" onsubmit="return(validate());">
<?php
$nama = '';
$alamat = '';
$no_ktp = '';
$no_hp = '';
$no_rm = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM pasien 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_ktp = $row['no_ktp'];
        $no_hp = $row['no_hp'];
        $no_rm = $row['no_rm'];
    }
?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<?php
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah/Edit Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah/Edit Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-15">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pasien</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
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
                  <div class="form-group">
                    <label for="no_rm">No Rm</label>
                    <input type="number" class="form-control" name="no_rm" id="no_rm" placeholder="Masukan No rm"value="<?php echo $no_rm ?>">
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
            <!-- /.card -->

  <!-- /.content-wrapper -->
  <hr class="mt-3">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No_ktp</th>
            <th scope="col">No_hp</th>
            <th scope="col">No_rm</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
   
        <?php
        
        $no = 1;
        $query = mysqli_query ($mysqli , "SELECT * FROM pasien");
        while ($data = mysqli_fetch_array($query)) :
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['nama']?></td>
        <td><?= $data['alamat']?></td>
        <td><?= $data['no_ktp']?></td>
        <td><?= $data['no_hp']?></td>
        <td><?= $data['no_rm']?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3"
            href="pasien.php?page=pasien&id=<?= $data['id'] ?>">Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" 
                href="pasien.php?page=pasien&id=<?= $data['id'] ?>&aksi=hapus">Hapus
            </a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
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
                document.location='pasien.php?';
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
</table>
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
