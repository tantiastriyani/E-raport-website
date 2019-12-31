<?php

include "conn.php";

?>

	
    	<?php
		
		$id_mahasiswa=$_SESSION['id_mahasiswa'];
		$mahasiswa=mysqli_fetch_array(mysqli_query($koneksi,"SELECT mahasiswa.nama_mahasiswa, mahasiswa.nim, kelas.nama_kelas from tbl_ruangan ruangan, data_mahasiswa mahasiswa, setup_kelas kelas where ruangan.id_mahasiswa=mahasiswa.id_mahasiswa and ruangan.id_mahasiswa='$id_mahasiswa' and ruangan.id_kelas=kelas.id_kelas"));
		
		$nama_mahasiswa=$mahasiswa['nama_mahasiswa'];
		$nim=$mahasiswa['nim'];
		$nama_kelas=$mahasiswa['nama_kelas'];
		
		?>

    <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Hasil Nilai Semester</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    
    <div class="form-group">
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th>Nama Mahasiswa</th>
          <td><input style="width: 350px;" type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $nama_mahasiswa;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th>NIM</th>
          <td><input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $nim;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td><input type="text" class="form-control" name="nim" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>
    </div>
      <br />
      
        <form id="mainform" action="home.php?page=input_nilai_mahasiswa" method="post">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered"

  
>
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="25%" class="info">Mata Kuliah</th>
           <th width="10%" class="info">Kehadiran</th>
             <th width="10%" class="info">Tugas</th>
              <th width="10%" class="info">Project</th>
               <th width="10%" class="info">UTS</th>
                <th width="10%" class="info">UAS</th>
                 <th width="10%" class="info">Nilai Akhir</th>  
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT nama_matkul, kehadiran, project, uts, uas FROM tbl_nilai nilai,  setup_matkul matkul, tbl_tugas tugas WHERE nilai.id_mahasiswa='$id_mahasiswa' and tugas.id_mahasiswa=nilai.id_mahasiswa and nilai.id_matkul=matkul.id_matkul order by matkul.nama_matkul asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_matkul'];?></td>
				<td><?php echo $row['kehadiran'];?></td>
        <td><?php echo (0.2*$row['tugas_1']) + (0.2*$row['tugas_2']) + (0.2*$row['tugas_3']) + (0.2*$row['tugas_4']) + (0.2*$row['tugas_5']); ?></td>
        <td><?php echo $row['project'];?></td>
        <td><?php echo $row['uts'];?></td>
        <td><?php echo $row['uas'];?></td>
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
              </div>
            </div>
          </div>
        </div>
      </div>
      
		
        
        
	