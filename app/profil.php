
<?php


if ( isset($_SESSION["login"])){
    header("Location:login.php");

}
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

<form class="form row" method="POST" action="" name="pasienform" onsubmit="return(validate());">
<?php
$nama = '';
$alamat = '';
$no_hp = '';
$poli_id = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM dokter 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_hp = $row['no_hp'];
        $no_rm = $row['polid_id'];
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
            <h1>Edit Dokter</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Dokter</li>
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
                <h3 class="card-title">Dokter</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama Dokter</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan  Nama"value="<?php echo $nama ?>">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat"value="<?php echo $alamat ?>">
                  </div>
                  <div class="form-group">
                    <label for="no_ktp">No Hp</label>
                    <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No ktp"value="<?php echo $no_hp ?>">
                  </div>
                  <div class="form-group">
                    <label for="no_rm">No Rm</label>
                    <input type="number" class="form-control" name="poli_id" id="poli_id" placeholder="Masukan No rm"value="<?php echo $poli_id ?>">
                  </div>
                    </div>
                  </div>
                  </div>
                  </div>
                <!-- /.card-body -->
                <div class="d-flex justify-content-start mt-2">
        <button class="btn btn-primary rounded-pill px-3" type="submit"name="simpan">Simpan Perubahan</button>
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
            <th scope="col">No_hp</th>
            <th scope="col">Poli_id</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
   
        <?php
        
        $no = 1;
        $query = mysqli_query ($mysqli , "SELECT * FROM dokter");
        while ($data = mysqli_fetch_array($query)) :
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['nama']?></td>
        <td><?= $data['alamat']?></td>
        <td><?= $data['no_hp']?></td>
        <td><?= $data['poli_id']?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3"
            href="profil.php?page=profil&id=<?= $data['id'] ?>">Ubah</a>
            </a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE dokter  SET 
                                            nama = '" . $_POST['nama'] . "',
                                            alamat = '" . $_POST['alamat'] . "',
                                            no_hp = '" . $_POST['no_hp'] . "',
                                            poli_id = '" . $_POST['poli_id'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO dokter (nama,alamat,no_hp,poli_id) 
                                            VALUES ( 
                                                '" . $_POST['nama'] . "',
                                                '" . $_POST['alamat'] . "',
                                                '" . $_POST['no_hp'] . "',
                                                '" . $_POST['poli_id'] . "'
                                                )");
        }

        echo "<script> 
                document.location='profil.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM dokter  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='profil.php';
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
