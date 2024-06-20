
<?php
include('koneksi.php');
?>
<head>
<?php include('header_dokter.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->


            <!-- /.card -->

  <!-- /.content-wrapper -->
  <hr class="mt-3">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Keluhan</th>
            <th scope="col">Catatan</th>
            <th scope="col">Obat</th>
        </tr>
    </thead>
    <tbody>
   
    <?php
            $result = mysqli_query($mysqli,
            "SELECT     pr.*,
             d.nama AS 'nama_dokter', 
             p.nama AS 'nama_pasien', 
             GROUP_CONCAT(o.nama_obat SEPARATOR ', ') AS 'obat'
         FROM periksa pr 
         LEFT JOIN dokter d ON (pr.id_dokter = d.id) 
         LEFT JOIN pasien p ON (pr.id_pasien = p.id)
         LEFT JOIN detail_periksa dp ON (pr.id = dp.id_periksa)
         LEFT JOIN obat o ON (dp.id_obat = o.id)
         GROUP BY pr.id
         ORDER BY pr.tgl_periksa DESC");
        $no = 1;
        $query = [' obat  '];
        while ($data = mysqli_fetch_array($result)):
        ?>
        <tr>
        <th scope="col"><?= $no++ ?></th>
        <td><?= $data['tgl_periksa']?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3"
            href="riwayatpasien.php?page=pasien&id=<?= $data['id'] ?>">Detail Riwayat Pasien</a>
        </td>
        </tr>
        <?php endwhile; ?>
    </tbody>

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
