
<?php
include('koneksi.php');
?>
<head>
<?php include('header_dokter.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include('navbar_dokter.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include('sidebar_dokter.php');?>

<form class="form row" method="POST" action="" name="jadwal_periksaform" onsubmit="return(validate());">
<?php
$nama= '';
$hari = '';
$jam_mulai = '';
$jam_selesai = '';
$status = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $hari = $row['hari'];
        $jam_mulai = $row['jam_mulai'];
        $jam_selesai = $row['jam_selesai'];
        $status = $row['status'];
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
            <h1>Tambah/Edit jadwal_periksa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah/Edit jadwal_periksa</li>
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
                <h3 class="card-title">jadwal_periksa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="hari">hari jadwal_periksa</label>
                    <input type="text" class="form-control" name="hari" id="hari" placeholder="Masukan  hari"value="<?php echo $hari ?>">
                  </div>
                  <div class="form-group">
                    <label for="jam_mulai">jam_mulai</label>
                    <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" placeholder="Masukan jam_mulai"value="<?php echo $jam_mulai ?>">
                  </div>
                  <div class="form-group">
                    <label for="jam_selesai">jam selesai</label>
                    <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" placeholder="Masukan No ktp"value="<?php echo $jam_selesai ?>">
                  </div>
                  <div class="form-group">
                    <label for="status">jam selesai</label>
                    <input multiple="multiple" class="form-control" name="status" id="status" placeholder="Masukan No ktp"value="<?php echo $status ?>">
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
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Hari</th>
            <th scope="col">Jam mulai</th>
            <th scope="col">jam selesai</th>
            <th scope="col">status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
   
        <?php
        
        $no = 1;
        $query = mysqli_query ($mysqli , "SELECT * FROM jadwal_periksa");
        while ($data = mysqli_fetch_array($query)) :
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['id_dokter']?></td>
        <td><?= $data['hari']?></td>
        <td><?= $data['jam_mulai']?></td>
        <td><?= $data['jam_selesai']?></td>
        <td><?= $data['status']?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3"
            href="jadwalperiksa.php?page=jadwalperiksa&id=<?= $data['id'] ?>">Ubah</a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
          $ubah = mysqli_query($mysqli, "UPDATE jadwal_periksa  SET status ='Tidak Aktif'");
            $ubah = mysqli_query($mysqli, "UPDATE jadwal_periksa  SET 
                                            id_dokter = '" . $_POST['id_dokter'] . "',
                                            hari = '" . $_POST['hari'] . "',
                                            jam_mulai = '" . $_POST['jam_mulai'] . "',
                                            jam_selesai = '" . $_POST['jam_selesai'] . "',
                                            status = '" . $_POST['status'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO jadwal_periksa (id_dokter,hari,jam_mulai,jam_selesai,status) 
                                            VALUES ( 
                                                '" . $_POST['id_dokter'] . "',
                                                '" . $_POST['hari'] . "',
                                                '" . $_POST['jam_mulai'] . "',
                                                '" . $_POST['jam_selesai'] . "',
                                                '" . $_POST['status'] . "'
                                                )");
        }

        echo "<script> 
                document.location='jadwalperiksa.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM jadwal_periksa  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='jadwalperiksa.php';
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
