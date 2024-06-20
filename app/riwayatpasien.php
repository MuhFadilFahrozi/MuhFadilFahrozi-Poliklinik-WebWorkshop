
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
            <h1>Riwayat Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Riwayat Pasien</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
            href="detailperiksa.php?page=pasien&id=<?= $data['id'] ?>">Detail Riwayat Pasien</a>
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
                document.location='riwayatpasien.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM pasien  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='riwayatpasien.php';
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
