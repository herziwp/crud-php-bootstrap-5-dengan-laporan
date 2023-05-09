<?php
  //include atau panggil header.php yang ada folder layouts
  include('layouts/header.php');

?>
	
		<div class="card mt-3">
			<div class="card-header">
				Tambah Tagihan
			</div>
			<div class="card-body">
				<form action="" method="post" role="form" enctype="multipart/form-data" >
					<div class = "col  col-4"> 
						<label>Tanggal Tagihan</label>
						<input type="date" name="tgl_tagihan" required="" class="form-control">
					</div>
					<div class = "mt-2 col"> 
						<label>No. Pelanggan</label>
						<input type="text" name="no_pelanggan" required="" class="form-control">
					</div>
					<div class = "mt-2 col"> 
						<label>Jumlah Meter</label>
						<div class="input-group mb-3">
						 	<input type="number" min="0" name="jumlah_meter" class="form-control">
						 	<span class="input-group-text">m2</span>
						</div>
					</div>
					<div class = "mt-2 col"> 
						<label>Biaya Tagihan</label>
						<div class="input-group mb-3">
						 	<span class="input-group-text">Rp</span>
							<input type="number" min="0" name="biaya" class="form-control">
						</div>
					</div>

					<div class = "mt-2 col "> 
						<label>Foto</label>
						 <input type="file" name="foto" required="" class="form-control"/>
					</div>


					<button type="submit" class="btn btn-primary mt-3" name="submit" value="simpan">Simpan</button>
				</form>

				<?php
				include('koneksi.php');
				
				//melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
				if (isset($_POST['submit'])) {
					//menampung data dari inputan
					$tgl_tagihan = $_POST['tgl_tagihan'];
					$no_pelanggan = $_POST['no_pelanggan'];
					$jumlah_meter = $_POST['jumlah_meter'];
					$biaya = $_POST['biaya'];

					$nama_foto1   = $_FILES['foto']['name'];
			        $file_tmp1    = $_FILES['foto']['tmp_name'];   
			        //untuk acak nama file jadi sebagai angka unik, agar nama file tidak sama
			        $acak1      = rand(1,99999);


			          if($nama_foto1 != "") {
			          	//memberi nama baru pada foto yang diupload
			            $nama_unik1     = $acak1.$nama_foto1;
			            //upload ke folder foto
			            move_uploaded_file($file_tmp1,'foto/'.$nama_unik1);
			          } else {
			            $nama_unik1 = NULL;
			          }
			          
			        $foto = $nama_unik1;

					//query untuk menambahkan tagihan ke database, pastikan urutan nya sama dengan di database
					$datas = mysqli_query($koneksi, "insert into tagihan (tgl_tagihan,no_pelanggan,jumlah_meter,biaya,foto)values('$tgl_tagihan', '$no_pelanggan', '$jumlah_meter', '$biaya', '$foto')") or die(mysqli_error($koneksi));
					//id tagihan tidak dimasukkan, karena sudah menggunakan AUTO_INCREMENT, id akan otomatis

					//ini untuk menampilkan alert berhasil dan redirect ke halaman index
					echo "<script>alert('data berhasil disimpan.');window.location='index.php';</script>";
				}
				?>
			</div>
		</div>
<?php
//include atau panggil footer.php yang ada folder layouts
  include('layouts/footer.php');
?>
