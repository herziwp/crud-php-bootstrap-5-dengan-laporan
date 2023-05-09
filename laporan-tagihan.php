<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>LAPORAN</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Untuk load bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }

body{
  -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 ">
 <?php
 //menampung input date start dan end dari index tadi
    $start = $_GET['start'];
    $end = $_GET['end'];          
  ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <h5 class="text-center text-uppercase text-decoration-underline mt-4">Laporan Tagihan Periode : <?= $_GET['start'].' s/d '.$_GET['end']; ?></h5> 
    <table class="table table-bordered table-hover mt-4">
          <thead>
            <tr class="bg-primary text-light">
              <th>No</th>
              <th>Tgl Tagihan</th>
              <th>No Pelanggan</th>
              <th>Jumlah Meter</th>
              <th>Biaya</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('koneksi.php'); 
              //memanggil file koneksi
              $datas = mysqli_query($koneksi, "select * from tagihan where tagihan.tgl_tagihan BETWEEN '$start' AND '$end'") or die(mysqli_error($koneksi));

              //script untuk menampilkan data tagihan

              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan

              if (mysqli_num_rows($datas) > 0){


              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr>
            <td><?= $no; ?></td>
            <td><?= $row['tgl_tagihan']; ?></td>
            <td><?= $row['no_pelanggan']; ?></td>
            <td><?= $row['jumlah_meter']; ?> m2</td>
            <td>Rp <?= $row['biaya']; ?></td>
            <td>
              <img src="foto/<?= $row['foto']; ?>" style="width: 100px;">
            
                

              </td>
          </tr>
            <?php $no++; } ?>

            <?php } else { ?>

             <tr>
                <td colspan="6">Data dengan periode tersebut tidak ditemukan.</td>
             </tr>

            <?php }?>
          </tbody>
        </table>

  </section>
</body>
</html>
