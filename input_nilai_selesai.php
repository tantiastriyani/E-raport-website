 <?php

include "conn.php";



      
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data berhasil disimpan </td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			
			if($_GET['status']=='0'){
			?>

            <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="red-left">Data Gagal Disimpan</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			?>


      	
		
		
	
    	<?php
		
		$id_dosen=$_GET['id_dosen'];
		$id_kelas=$_GET['id_kelas'];
		$id_matkul=$_GET['id_matkul'];
		
    
		$dosen=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from data_dosen where id_dosen='$id_dosen'"));
		$kelas=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from setup_kelas where id_kelas='$id_kelas'"));
		$matkul=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from setup_matkul where id_matkul='$id_matkul'"));
		
		$nama_dosen=$dosen['nama_dosen'];
		$nama_kelas=$kelas['nama_kelas'];
		$nama_matkul=$matkul['nama_matkul'];
		
		?>

     <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-check-square-o"></i> selesai</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    
    <div class="form-group">
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th>Nama Dosen</th>
          <td><input style="width: 350px;" type="text" class="form-control" name="nama_dosen" value="<?php echo $nama_dosen;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th>Mata Kuliah</th>
          <td><input type="text" class="form-control" name="nama_matkul" value="<?php echo $nama_matkul;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td><input type="text" class="form-control" name="nama_kelas" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>
    </div>
      <br />

     
      
        <form id="mainform" action="home.php?page=input_nilai_mahasiswa" method="post">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="25%" class="info">Nama Mahasiswa</th>
            <th width="10%" class="info">NIM</th>
           <th width="10%" class="info">Kehadiran</th>
             <th width="10%" class="info">Tugas</th>
              <th width="10%" class="info">Project</th>
               <th width="10%" class="info">UTS</th>
                <th width="10%" class="info">UAS</th>
                 <th width="10%" class="info">Nilai Akhir</th>  
        </tr>

        
        <?php
		$view=mysqli_query($koneksi, "SELECT * FROM tbl_nilai nilai, tbl_tugas tugas, data_mahasiswa mahasiswa WHERE tugas.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_dosen='$id_dosen' and nilai.id_kelas='$id_kelas' and nilai.id_matkul='$id_matkul' order by mahasiswa.nama_mahasiswa asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_mahasiswa'];?></td>
				<td><?php echo $row['nim'];?></td>
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
        <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" />
        </table>
        
        </form>
      </div>
    </div>
  </div>
</div>
</div>

		
        
        
	