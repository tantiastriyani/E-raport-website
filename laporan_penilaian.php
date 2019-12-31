<div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Laporan Penilaian</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
              <form action="?page=laporan_penilaian" method="post">
            <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIM' /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=laporan_penilaian' class="btn btn-sm btn-success" >Refresh</i></a>
    
				<table border="0" width="100%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
				<tr>
                    <th width="1%" class="info">Nomor</th>
					<th width="20%" class="info">Nama Mahasiswa	</th>
					<th width="5%" class="info">NIM</th>
					<th width="5%" class="info">Kelas</th>
					<th width="15%" class="info">Mata Kuliah</th>
				  <th width="5%" class="info">Kehadiran</th>
	             <th width="5%" class="info">Tugas</th>
	              <th width="5%" class="info">Project</th>
	               <th width="5%" class="info">UTS</th>
	                <th width="5%" class="info">UAS</th>
	                 <th width="5%" class="info">Nilai Akhir</th>
	        </tr>
	                
                <?php
				$id_dosen=$_SESSION['id_dosen'];

				$query1="SELECT * FROM tbl_nilai nilai, data_mahasiswa mahasiswa, setup_matkul matkul, setup_kelas kelas, tbl_tugas tugas WHERE tugas.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_kelas=kelas.id_kelas and nilai.id_matkul=matkul.id_matkul and nilai.id_dosen='$id_dosen' order by mahasiswa.nama_mahasiswa asc";
                    
                    if(isset($_POST['qcari'])){
                 $qcari=$_POST['qcari'];
                 $query1="SELECT * FROM tbl_nilai nilai, data_mahasiswa mahasiswa, setup_matkul matkul, setup_kelas kelas, tbl_tugas tugas WHERE tugas.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_kelas=kelas.id_kelas and nilai.id_matkul=matkul.id_matkul and nilai.id_dosen='$id_dosen' 
                 and nim like '%$qcari%'";
                    }
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());

				
				$i = 1;
				while($row=mysqli_fetch_array($view)){
					?>
					<tr>
                        <td><?php echo $i;?></td>
						<td><?php echo $row['nama_mahasiswa'];?></td>
						<td><?php echo $row['nim'];?></td>
						<td><?php echo $row['nama_kelas']?></td>
						<td><?php echo $row['nama_matkul']?></td>
						<td><?php echo $row['kehadiran']?></td>
						<td><?php echo (0.2*$row['tugas_1']) + (0.2*$row['tugas_2']) + (0.2*$row['tugas_3']) + (0.2*$row['tugas_4']) + (0.2*$row['tugas_5']); ?></td>
						<td><?php echo $row['project']?></td>
						<td><?php echo $row['uts']?></td>
						<td><?php echo $row['uas']?></td>
						<td><?php $total = (0.1*$row['kehadiran']) + (0.2*$row['tugas']) + (0.3*$row['project']) + (0.2*$row['uts']) + (0.2*$row['uas']); 
						     if ($total>=80) {
						        echo "A";
						      }
						      else
						      if ($total>=79) {
						       echo "B";
						      }
						       else
						       if ($total>=60) {
						        echo "C";
						      }
						       else 
						        if ($total>=40) {
						        echo "D"; 
						      }
						       else
						        
						         {
						        echo "E"; 
						      }



    
      ?>
        </td>
			</tr>
						
					
					<?php
					$i++;
				}
					$jumSis = $i-1;
				?>
 
                
                
				</table>
			</form>
				 <div class="text-right">
                  <a class="btn btn-sm btn-warning tooltips" data-placement="bottom" data-original-title="Print Nilai" href="print_nilai.php"><span class="glyphicon glyphicon-print"></span></a>
                  </div>
			</div>
		</div>
	</div>
</div>
</div>

				 

			