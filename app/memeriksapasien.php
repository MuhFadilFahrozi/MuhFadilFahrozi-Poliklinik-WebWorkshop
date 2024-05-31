
<?php
include('koneksi.php');
?>
<head>
<?php include('header.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include('navbar_dokter.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include('sidebar_dokter.php');?>

<form class="form row" method="POST" action="" name="periksaform" onsubmit="return(validate());">
<?php
    $id_daftar_poli = '';
    $tgl_periksa = '';
    $catatan = '';
    $obat ='';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM periksa
            WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $id_daftar_poli = $row['id_daftar_poli'];
            $tgl_periksa = $row['tgl_periksa'];
            $catatan = $row['catatan'];
            $obat =$row['id'];
        }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
<?php

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah/Edit Periksa</h1>
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
                <h3 class="card-title">Periksssa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Id daftar poli</label>
                    <input type="int" class="form-control" name="id_daftar_poli" id="id_daftar_poli" placeholder="Masukan  Nama"value="<?php echo $id_daftar_poli ?>">
                  </div>
                  <div class="form-group">
                    <label for="tgl_periksa">Tanggal Periksa</label>
                    <input type="date time" class="form-control" name="tgl_periksa" id="tgl_periksa" placeholder="Masukan tgl_periksa"value="<?php echo $tgl_periksa ?>">
                  </div>
                  <div class="form-group ">
                    <label for="catatan">catatan</label>
                    <input type="number" class="form-control" name="catatan" id="catatan" placeholder="Masukan No ktp"value="<?php echo $catatan ?>">
                  </div>
                  <div class="form-group mb -2 ">
                    <label for="Pilih obat" class="form-tabel">Obat</label>
                    <select  class="form-control" name="obat" id="obat" multiple="multiple">
                    <?php
                    $selected = '';
                    $obat = mysqli_query($mysqli, "SELECT * FROM obat");
                    while ($data = mysqli_fetch_array($obat)) {
                        if ($data['id'] == $id_obat) {
                              $selected = 'selected="selected"';
                          } else {
                              $selected = '';
                          }
                    ?>
                <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama_obat'] ?></option>
            <?php
            }
            ?>
             </select>
                  </div>
                  <?php 
            if(isset($_POST['simpan'])) {

                $obat=implode(",", $_POST['obat']);
                
                $koneksi->query("INSERT INTO obat(nama_obat) VALUES('$obat')");

            } 
            ?>
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
            <th scope="col">Nama Pasien</th>
            <th scope="col">Keluhan</th>
            <th scope="col">Obat</th>
        </tr>
    </thead>
    <tbody>
   
    <?php
            $result = mysqli_query($mysqli,
            "SELECT     pr.*, 
             p.nama AS 'nama_pasien', 
             GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS 'obat'
         FROM periksa pr  
         LEFT JOIN pasien p ON (pr.id_pasien = p.id)
         LEFT JOIN jadwal_periksa jp ON (pr.id = jp.id_jadwal)
         LEFT JOIN obat o ON (dp.id_obat = o.id)
         GROUP BY p.id
         ORDER BY pr.jadwal_periksa DESC");
        $no = 1;
        $query = [' obat  '];
        while ($data = mysqli_fetch_array($result)):
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['nama']?></td>
        <td><?= $data['catatan']?></td>
        <td><?= $data['obat']?></td>
        <td>
        <?php
                $sql_obat = mysqli_query($mysqli, "SELECT obat.nama_obat  FROM jadwal_periksa JOIN 
                obat ON jadwal_periksa.id_obat = obat.nama_obat WHERE 
                id_jadwal = '$data[id]'") or die (mysqli_error($con));
                while ($data_obat = mysqli_fetch_array($sql_obat)){
                    echo $data_obat['id_obat']."<br>";
                }
                ?>
            <a class="btn btn-success rounded-pill px-3"
            href="memeriksapasien.php?page=memeriksapasien&id=<?= $data['id'] ?>">Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" 
                href="memeriksapasien.php?page=memeriksapasien&id=<?= $data['id'] ?>&aksi=hapus">Hapus
            </a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <?php
    if (isset($_POST['simpan'])) {
        if (isset($_POST['id'])) {
            $ubah = mysqli_query($mysqli, "UPDATE periksa  SET 
                                            nama = '" . $_POST['nama'] . "',
                                            catatan = '" . $_POST['catatan'] . "',
                                            obat = '" . $_POST['obat'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
        } else {
            $tambah = mysqli_query($mysqli, "INSERT INTO pasien (nama,catatan,no_ktp,no_hp,obat) 
                                            VALUES ( 
                                                '" . $_POST['nama'] . "',
                                                '" . $_POST['catatan'] . "',
                                                '" . $_POST['obat'] . "'
                                                )");
        }

        echo "<script> 
                document.location='memeriksapasien.php?';
                </script>";
    }

    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'hapus') {
            $hapus = mysqli_query($mysqli, "DELETE FROM periksa  WHERE id = '" . $_GET['id'] . "'");
        }

        echo "<script> 
                document.location='memeriksapasien.php';
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
