
		<script src="js/jquery.min.js"></script>
		
		<script>
		$(document).ready(function(){
			
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		

			<div class="col-lg-12">
			 <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-upload"></i> Import Data Dosen</h3> 
                        </div><br><br>


              
				<a href="home.php?page=data_mahasiswa" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>

		
			
			<form method="post" action="" enctype="multipart/form-data">

			
				<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-file-excel-o"></i> Pilih File</h4> 
			</div>
			<div class="panel-heading">
				<input type="file" name="file" class="pull-left">
				
				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button><br>
			</div>
				<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-exclamation"></i> File yang Di Upload Harus Berformat .CSV</h4> 
			</div>
			</form>
			
			
			
		
			<?php
			
			if(isset($_POST['preview'])){
				$nama_file_baru = 'data.csv';
				
				
				if(is_file('tmp/'.$nama_file_baru)) 
					unlink('tmp/'.$nama_file_baru); 
				
				$nama_file = $_FILES['file']['name']; 
				$tmp_file = $_FILES['file']['tmp_name'];
				$ext = pathinfo($nama_file, PATHINFO_EXTENSION);  
				
				
				if($ext == "csv"){
					
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
					
					
					require_once 'PHPExcel/PHPExcel.php';
					
					$inputFileType = 'CSV';
					$inputFileName = 'tmp/data.csv';

					$reader = PHPExcel_IOFactory::createReader($inputFileType);
					$excel = $reader->load($inputFileName);
					
					
					echo "<form method='post' action='proses_import.php'>";
					
					
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum lengkap diisi.
					</div>";
					
					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>Nama</th>
						<th>Nip</th>
						<th>Kelamin</th>
						<th>Alamat</th>

						<th>Username</th>
						<th>Password</th>
						
					</tr>";
					
					$numrow = 1;
					$kosong = 0;
					$worksheet = $excel->getActiveSheet();
					foreach ($worksheet->getRowIterator() as $row) { 
						if($numrow > 1){
							
							$cellIterator = $row->getCellIterator();
							$cellIterator->setIterateOnlyExistingCells(false); 
							
							$get = array();  
							foreach ($cellIterator as $cell) {
								array_push($get, $cell->getValue()); 
							}
							
							
							$nama = $get[0]; 
							$nip = $get[1]; 
							$kelamin = $get[2];
							$alamat = $get[3];
							$username = $get[4];  
							$password = $get[5]; 
							 
							
							if(empty($nama) && empty($nim) && empty($kelamin) && empty($alamat) && empty($username) && empty($password))
								continue; 

							$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; 
							$nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; 
							$jk_td = ( ! empty($kelamin))? "" : " style='background: #E07171;'"; 
							$alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; 
							$username_td = ( ! empty($username))? "" : " style='background: #E07171;'"; 
							$password_td = ( ! empty($password))? "" : " style='background: #E07171;'";
							$foto_td = ( ! empty($foto))? "" : " style='background: #E07171;'";
							
							if(empty($nama) or empty($nim) or empty($kelamin)  or empty($alamat) or empty($username) or empty($password)){
								$kosong++; 
							}
							
							echo "<tr>";
							echo "<td".$nama_td.">".$nama."</td>";
							echo "<td".$nip_td.">".$nip."</td>";
							echo "<td".$jk_td.">".$kelamin."</td>";
							echo "<td".$alamat_td.">".$alamat."</td>";
							echo "<td".$username_td.">".$username."</td>";
							echo "<td".$password_td.">".$password."</td>";
							
							echo "</tr>";
						}
						
						$numrow++; 
					}
					
					echo "</table>";
					
					
					if($kosong > 1){
					?>	
						<script>
						$(document).ready(function(){
							
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');
							
							$("#kosong").show(); 
						});
						</script>
					<?php
					}else{
						
						
						
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}
					
					echo "</form>";
				}else{ 
					echo "<div class='alert alert-danger'>
					Hanya File CSV (.csv) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>

