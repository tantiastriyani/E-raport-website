<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$jumSis = $_POST['jumlah'];
	
	
	for ($i=1; $i<=$jumSis; $i++)
	{
	   $id_mahasiswa = $_POST['id_mahasiswa'.$i];
	   $kehadiran  = $_POST['kehadiran'.$i];
	  
	   $project = $_POST['project'.$i];
	   $uts = $_POST['uts'.$i];
	   $uas = $_POST['uas'.$i];
	
	   
	   $id_dosen = $_POST['id_dosen'];
	   $id_kelas = $_POST['id_kelas'];
	   $id_matkul = $_POST['id_matkul'];

	   $query = "INSERT into tbl_nilai values('','$id_mahasiswa','$id_matkul','$id_kelas','$id_dosen','$kehadiran','$project','$uts','$uas')";
	   $hasil=mysqli_query($koneksi,$query);
	}
	
	if($hasil){
		?><script language="javascript">document.location.href="?page=input_nilai_selesai&id_dosen=<?php echo $id_dosen;?>&id_kelas=<?php echo $id_kelas;?>&id_matkul=<?php echo $id_matkul;?>";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=input_nilai_selesai&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}


?>

            <?php
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data berhasil disimpan</td>
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
                <td class="red-left">data gagal di simpan</td>
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
		
		$dosen=mysqli_fetch_array(mysqli_query($koneksi,"select * from data_dosen where id_dosen='$id_dosen'"));
		$kelas=mysqli_fetch_array(mysqli_query($koneksi,"select * from setup_kelas where id_kelas='$id_kelas'"));
		$matkul=mysqli_fetch_array(mysqli_query($koneksi,"select * from setup_matkul where id_matkul='$id_matkul'"));
		
		$nama_dosen=$dosen['nama_dosen'];
		$nama_kelas=$kelas['nama_kelas'];
		$nama_matkul=$matkul['nama_matkul'];
		
		?>
    
    <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Input Nilai Semester</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th>Nama dosen</th>
          <td><input type="text" style="width: 350px;" class="form-control" name="nama_dosen" value="<?php echo $nama_dosen;?>" disabled="disabled"/></td>
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
            <th width="10%" class="info">Nomor</th>
            <th width="60%" class="info">Nama Mahasiswa</th>
            <th width="60%" class="info">NIM</th>
            <th width="30%" class="info">Kehadiran</th>
             <th width="30%" class="info">Tugas</th>
              <th width="30%" class="info">Project</th>
               <th width="30%" class="info">UTS</th>
                <th width="30%" class="info">UAS</th>
               
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT * FROM tbl_ruangan ruangan, data_mahasiswa mahasiswa, tbl_tugas tugas WHERE tugas.id_mahasiswa=mahasiswa.id_mahasiswa and ruangan.id_mahasiswa=mahasiswa.id_mahasiswa and ruangan.id_kelas='$id_kelas' order by mahasiswa.nama_mahasiswa asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<input type="hidden" name="id_dosen" value="<?php echo $id_dosen;?>" />
			<input type="hidden" name="id_matkul" value="<?php echo $id_matkul;?>" />	
			<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
			<?php echo "<input type='hidden' name='id_mahasiswa".$i."' value='".$row['id_mahasiswa']."' />"; ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_mahasiswa'];?></td>
				<td><?php echo $row['nim'];?></td>
				<td><?php echo "<input type='text' name='kehadiran".$i."' size='10'/>"; ?></td>
				<td><?php echo (0.2*$row['tugas_1']) + (0.2*$row['tugas_2']) + (0.2*$row['tugas_3']) + (0.2*$row['tugas_4']) + (0.2*$row['tugas_5']); ?></td>
				<td><?php echo "<input type='text' name='project".$i."' size='10'/>"; ?></td>
				<td><?php echo "<input type='text' name='uts".$i."' size='10'/>"; ?></td>
				<td><?php echo "<input type='text' name='uas".$i."' size='10'/>"; ?></td>
				
			</tr>
			<?php
			$i++;
		}
			$jumSis = $i-1;
		?>
       
        <tr>
            <td colspan="12" align="center"><input type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-primary" value="Input" name="submit"/></td>
        </tr>
        </table>
               </form>
           </div>
       </div>
   </div>
</div>
</div>

		
        
        

