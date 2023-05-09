<?php
  //include atau panggil header.php yang ada folder layouts
  include('layouts/header.php');

?>

		<div class="card mt-3">
			<div class="card-header">
				Laporan
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover">
						 <tr>
              <th style="vertical-align: middle;">Laporan Tagihan</th>
              <th>
              	<form method="get" action="laporan-tagihan.php" class="row ms-auto" target="_blank">
              		  <div class="col-auto">
                    	<input type="date" class="form-control form-control-sm" name="start" required >
                    </div>
                    <div class="col-auto">
                    	s.d
                  	</div>
                  <div class="col-auto">
                    <input type="date" class="form-control form-control-sm" name="end" required >
                  </div>
                     <div class="col-auto">
                    <button type="submit" class="btn btn-secondary btn-sm" name="submit" value="cetak">Cetak!</button>
                  </div>
                </form>
              </th>
            </tr>
				</table>
			</div>
		</div>



		<div class="card mt-3">
			<div class="card-header">
				DATA TAGIHAN <a href="tambah.php" class="btn btn-sm btn-dark float-xl-end">Tambah</a>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="bg-primary text-light">
							<th>No</th>
							<th>Tgl Tagihan</th>
							<th>No Pelanggan</th>
							<th>Jumlah Meter</th>
							<th>Biaya</th>
							<th>Foto</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							include('koneksi.php'); 
							//memanggil file koneksi
							$datas = mysqli_query($koneksi, "select * from tagihan") or die(mysqli_error($koneksi));

							//script untuk menampilkan data tagihan

							$no = 1;//untuk pengurutan nomor

							//cek jika data tidak kosong akan menampilkan data tagihan
							if (mysqli_num_rows($datas) > 0){

							//melakukan perulangan
							while($row = mysqli_fetch_assoc($datas)) {
						?>	

					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['tgl_tagihan']; ?></td>
						<td><?= $row['no_pelanggan']; ?></td>
						<td><?= $row['jumlah_meter']; ?> m2</td>
						<td>Rp <?= $row['biaya']; ?></td>
						<td>
							<a href="foto/<?= $row['foto']; ?>" target="_blank">
								<img src="foto/<?= $row['foto']; ?>" style="width: 100px;">
							</a>
								

							</td>
						<td>
								<a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
								<a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
						</td>
					</tr>
						<?php $no++; } ?>

						  <?php } else { ?>

             <tr>
                <td colspan="7">Data belum ada.</td>
             </tr>

            <?php }?>

					</tbody>
				</table>
			</div>
		</div>
	
<?php
//include atau panggil footer.php yang ada folder layouts
  include('layouts/footer.php');
?>
