
<?php
  //include atau panggil header.php yang ada folder layouts
  include('layouts/header.php');

?>
	
	<div class="card mt-3">
			<div class="card-header">
				Edit Tagihan
			</div>
			<div class="card-body">
				<?php
				include('koneksi.php');

				$id = $_GET['id']; //mengambil id tagihan yang ingin diubah

				//menampilkan tagihan berdasarkan id
				$data = mysqli_query($koneksi, "select * from tagihan where id = '$id'");
				$row = mysqli_fetch_assoc($data);

				?>
				<form action="" method="post" role="form" enctype="multipart/form-data">

					<!-- ini digunakan untuk menampung id yang ingin diubah -->
					<input type="hidden" name="id" required="" value="<?= $row['id']; ?>">

					<div class = "col  col-4"> 
						<label>Tanggal Tagihan</label>
						<input type="date" name="tgl_tagihan" required="" class="form-control" value="<?= $row['tgl_tagihan']; ?>">
					</div>
					<div class = "mt-2 col"> 
						<label>No. Pelanggan</label>
						<input type="text" name="no_pelanggan" required="" class="form-control" value="<?= $row['no_pelanggan']; ?>">
					</div>
					<div class = "mt-2 col"> 
						<label>Jumlah Meter</label>
						<div class="input-group mb-3">
						 	<input type="number" min="0" name="jumlah_meter" class="form-control" value="<?= $row['jumlah_meter']; ?>">
						 	<span class="input-group-text">m2</span>
						</div>
					</div>
					<div class = "mt-2 col"> 
						<label>Biaya Tagihan</label>
						<div class="input-group mb-3">
						 	<span class="input-group-text">Rp</span>
								<input type="number" min="0" name="biaya" class="form-control" value="<?= $row['biaya']; ?>">
						</div>
					</div>

					<div class = "mt-2 col"> 
						<label>Foto Sebelumnya</label>
						<br>
						<img src="foto/<?= $row['foto']; ?>" class="col-3">
						 <input type="hidden" name="foto_sebelumnya" value="<?= $row['foto']; ?>" />
					</div>


					<div class = "mt-2 col"> 
						<label>Foto Baru (abaikan jika tidak ingin ganti foto)</label>
						 <input type="file" name="foto" class="form-control"/>
					</div>


					<button type="submit" class="btn btn-primary mt-3" name="submit" value="simpan">update data</button>
				</form>

				<?php

				//jika klik tombol submit maka akan melakukan perubahan
				if (isset($_POST['submit'])) {
					$id = $_POST['id'];
					$tgl_tagihan = $_POST['tgl_tagihan'];
					$no_pelanggan = $_POST['no_pelanggan'];
					$jumlah_meter = $_POST['jumlah_meter'];
					$biaya = $_POST['biaya'];

					$nama_foto1   = $_FILES['foto']['name'];
			        $file_tmp1    = $_FILES['foto']['tmp_name'];   
			        $acak1      = rand(1,99999);

			        	//cek jika foto baru tidak ada
			          if($nama_foto1 != "") {
			            $nama_unik1     = $acak1.$nama_foto1;
			            move_uploaded_file($file_tmp1,'foto/'.$nama_unik1);
			          } else {
			          	//maka tetap pakai foto lama
			            $nama_unik1 = $_POST['foto_sebelumnya'];
			          }
			      
			        $foto = $nama_unik1;

					//query mengubah tagihan
					mysqli_query($koneksi, "update tagihan set tgl_tagihan='$tgl_tagihan', no_pelanggan='$no_pelanggan', jumlah_meter='$jumlah_meter', biaya='$biaya', foto='$foto' where id ='$id'") or die(mysqli_error($koneksi));

					//redirect ke halaman index.php
					echo "<script>alert('data berhasil diupdate.');window.location='index.php';</script>";
				}



				?>
			</div>
		</div>
	</div>

<?php
//include atau panggil footer.php yang ada folder layouts
  include('layouts/footer.php');
?>
