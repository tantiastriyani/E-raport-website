<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$jumSis = $_POST['jumlah'];
	
	
	for ($i=1; $i<=$jumSis; $i++)
	{
	  
	 
	   $tugas_1 = $_POST['tugas_1'.$i];
	   $tugas_2 = $_POST['tugas_2'.$i];
	   $tugas_3 = $_POST['tugas_3'.$i];
	   $tugas_4 = $_POST['tugas_4'.$i];
	   $tugas_5 = $_POST['tugas_5'.$i];
	   $tugas_6 = $_POST['tugas_6'.$i];
	   $tugas_7 = $_POST['tugas_7'.$i];
	   $tugas_7 = $_POST['tugas_7'.$i];
	     $tugas_8 = $_POST['tugas_8'.$i];
	       $tugas_9 = $_POST['tugas_9'.$i];
	        $tugas_10 = $_POST['tugas_10'.$i];
			 $tugas_11 = $_POST['tugas_11'.$i];
			   $tugas_12 = $_POST['tugas_12'.$i];
			     $tugas_13 = $_POST['tugas_13'.$i];
			       $tugas_14 = $_POST['tugas_14'.$i];
			         $tugas_15 = $_POST['tugas_15'.$i];





	   
	   $id_mahasiswa = $_POST['id_mahasiswa'.$i];
	   $id_dosen = $_POST['id_dosen'];
	   $id_kelas = $_POST['id_kelas'];
	   $id_matkul = $_POST['id_matkul'];
	
	   $query = "update tbl_tugas set tugas_1='$tugas_1', tugas_2='$tugas_2', tugas_3='$tugas_3', tugas_4='$tugas_4', tugas_5='$tugas_5', tugas_6='$tugas_6', tugas_7='$tugas_7' where id_mahasiswa='$id_mahasiswa' and id_matkul='$id_matkul' and id_kelas='$id_kelas' and id_dosen='$id_dosen'";
	   $hasil=mysqli_query($koneksi,$query);
	}
	
	if($hasil){
		?><script language="javascript">document.location.href="?page=input_tugas_selesai&id_dosen=<?php echo $id_dosen;?>&id_kelas=<?php echo $id_kelas;?>&id_matkul=<?php echo $id_matkul;?>";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=input_nilai_selesai&status=0";</script><?php
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
                <td class="red-left"><?php echo mysqli_error();?></td>
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
                        <h3 class="panel-title"><i class="fa fa-pencil-square"></i> Update Nilai Tugas</h3> 
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
      <button id="tmh_kolom" class="btn btn-primary">Tambah Kolom</button><br>
        <form id="mainform" action="home.php?page=input_tugas_update" method="post">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>

 			<th width="1%" class="info">Nomor  </th>
            <th width="20%" class="info">Nama Mahasiswa</th>
            <th width="10%" class="info">NIM</th>
            <th width="5%" class="info">Tugas 1</th>
             <th width="5%" class="info">Tugas 2</th>
              <th width="5%" class="info">Tugas 3</th>
               <th width="5%" class="info">Tugas 4</th>
                <th width="5%" class="info">Tugas 5</th>
                
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT * FROM tbl_tugas tugas, data_mahasiswa mahasiswa WHERE tugas.id_mahasiswa=mahasiswa.id_mahasiswa and tugas.id_dosen='$id_dosen' and tugas.id_kelas='$id_kelas' and tugas.id_matkul='$id_matkul' order by mahasiswa.nama_mahasiswa asc");
		
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
				<td><?php echo "<input type='text' name='tugas_1".$i."' size='10' value='".$row['tugas_1']."'/>"; ?></td>
				<td><?php echo "<input type='text' name='tugas_2".$i."' size='10' value='".$row['tugas_2']."'/>"; ?></td>				<td><?php echo "<input type='text' name='tugas_3".$i."' size='10' value='".$row['tugas_3']."'/>"; ?></td>
				<td><?php echo "<input type='text' name='tugas_4".$i."' size='10' value='".$row['tugas_4']."'/>"; ?></td>
				<td><?php echo "<input type='text' name='tugas_5".$i."' size='10' value='".$row['tugas_5']."'/>"; ?></td>
				
			</tr>
			<?php
			$i++;
		}
			$jumSis = $i-1;
		?>
        <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" />
        <tr>
            <td colspan="12" align="center"><input type="submit" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-primary" value="Update" name="submit"/></td>
        </tr>
        </table>
        
        </form>
    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		var n=6;
		var r=0;
		$('#tmh_kolom').on('click', function () {
			n++;

			$('#tgs_tbl').find('tr').each(function(){
				console.log(r++);
				$(this).find('td').eq(n).after('<td><input size=10 name=tugas_'+(r-1)+(n-1)+'></input>');
				$(this).find('th').eq(n).after('<th class=info>Tugas '+(n-1)+'</th>');
			});
		});
	})

</script>
		
        
        
	
