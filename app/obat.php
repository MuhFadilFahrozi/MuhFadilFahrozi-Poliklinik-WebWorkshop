
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

<form class="form row" method="POST" action="" name="obatform" onsubmit="return(validate());">
<?php
$nama_obat = '';
$kemasan = '';
$harga = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM obat 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama_obat = $row['nama_obat'];
        $kemasan = $row['kemasan'];
        $harga = $row['harga'];
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
            <h1>Tambah/Edit obat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah/Edit obat</li>
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
                <h3 class="card-title">obat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_obat">Nama obat</label>
                    <input type="text" class="form-control" name="nama_obat" id="nama_obat" placeholder="Masukan Nama Obat"value="<?php echo $nama_obat ?>">
                  </div>
                  <div class="form-group">
                    <label for="kemasan">Harga</label>
                    <input type="text" class="form-control" name="kemasan" id="kemasan" placeholder="Masukan kemasan"value="<?php echo $kemasan ?>">
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukan harga"value="<?php echo $harga ?>">
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
            <th scope="col">Nama Obat</th>
            <th scope="col">Hemasan</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
   
        <?php
        
        $no = 1;
        $query = mysqli_query ($mysqli , "SELECT * FROM obat");
        while ($data = mysqli_fetch_array($query)) :
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['nama_obat']?></td>
        <td><?= $data['kemasan']?></td>
        <td><?= $data['harga']?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3"
            href="obat.php?page=obat&id=<?= $data['id'] ?>">Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" 
                href="obat.php?page=obat&id=<?= $data['id'] ?>&aksi=hapus">Hapus
            </a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE obat  SET 
                                            nama_obat = '" . $_POST['nama_obat'] . "',
                                            kemasan = '" . $_POST['kemasan'] . "',
                                            harga = '" . $_POST['harga'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO obat (nama_obat,kemasan,harga) 
                                            VALUES ( 
                                                '" . $_POST['nama_obat'] . "',
                                                '" . $_POST['kemasan'] . "',
                                                '" . $_POST['harga'] . "'
                                                )");
        }

        echo "<script> 
                document.location='obat.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM obat  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='obat.php';
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
