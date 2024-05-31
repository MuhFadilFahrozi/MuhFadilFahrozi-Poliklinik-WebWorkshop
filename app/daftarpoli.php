
<?php

include('koneksi.php');
?>
<head>
<?php include('header.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->

  <form class="form row" method="POST" action="" name="pasienform" onsubmit="return(validate());">
<?php
$no_rm = '';
if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM pasien 
    WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $no_rm = $row['no_rm'];
    }
?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<?php
}
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-15">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Daftar Poli</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_obat">Nomor Rekam medis</label>
                    <input type="text" class="form-control" name="no_rm" id="no_rm" placeholder="Masukan Nomor Rekam medis"value="<?php echo $no_rm ?>">
                  </div>
                  <div class="form-group">
                    <label for="kemasan">Pilih Poli</label>
                    <select class="form-control" name="id_jadwal">
            <option hidden>Pilih Poli</option>
            <?php
            $selected = '';
            $poli = mysqli_query($mysqli, "SELECT * FROM poli");
            while ($data = mysqli_fetch_array($poli)) {
                if ($data['id'] == $id_poli) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama_poli'] ?></option>
            <?php
            }
            ?>
        </select>
                  </div>
                  <div class="form-group">
                    <label for="harga">Pilih Jadwal</label>
                    <select class="form-control" name="id_jadwal">
            <option hidden>Pilih Jadwal</option>
            <?php
            $selected = '';
            $jadwal_periksa = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa");
            while ($data = mysqli_fetch_array($jadwal_periksa)) {
                if ($data['id'] == $id_jadwal_periksa) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['hari'] ?></option>
            <?php
            }
            ?>
        </select>
        <div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Keluhan</label>
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
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE pasien  SET 
                                            no_rm = '" . $_POST['no_rm'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien (no_rm) 
                                            VALUES ( 
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
