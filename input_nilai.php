<?php

include "conn.php";

if(isset($_GET['id_dosen'])){
	
	$id_dosen=$_GET['id_dosen'];
	$id_kelas=$_GET['id_kelas'];
	$id_matkul=$_GET['id_matkul'];
	
	$query=mysqli_query($koneksi,"select * from tbl_nilai where id_dosen='$id_dosen' and id_kelas='$id_kelas' and id_matkul='$id_matkul'");
	$cek=mysqli_num_rows($query);
	
	if($cek=='0'){
		
		?><script language="javascript">document.location.href="?page=input_nilai_mahasiswa&id_dosen=<?php echo $id_dosen;?>&id_matkul=<?php echo $id_matkul;?>&id_kelas=<?php echo $id_kelas;?>";</script><?php
	}else{
		
		?><script language="javascript">document.location.href="?page=input_nilai_update&id_dosen=<?php echo $id_dosen;?>&id_matkul=<?php echo $id_matkul;?>&id_kelas=<?php echo $id_kelas;?>";</script><?php
	}
	
}else{
	unset($_POST['id_dosen']);
}


?>






            <?php
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
                <td class="red-left">data gagal di simpan</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
			<?php
			}
			?>



      
		
		
	<div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Input Nilai Semester / Pilih Mata Kuliah</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
        
        
        <form id="mainform" action="">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="10%" class="info">Nomor</th>
            <th width="60%" class="info">Nama Mata Kuliah</th>
            <th width="30%" class="info">Kelas</th>
        </tr>
        
        
        <?php
		$id_dosen=$_SESSION['id_dosen'];
		$view=mysqli_query($koneksi,"select * from data_pengampu pengampu, setup_kelas kelas, setup_matkul matkul where pengampu.id_kelas=kelas.id_kelas and pengampu.id_matkul=matkul.id_matkul and pengampu.id_dosen='$id_dosen' order by id_pengampu asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><a href="?page=input_nilai&id_dosen=<?php echo $id_dosen;?>&id_matkul=<?php echo $row['id_matkul'];?>&id_kelas=<?php echo $row['id_kelas'];?>" style="text-decoration: none;" title="Pilih Mata Kuliah"><?php echo $row['nama_matkul'];?></a></td>
            <td><?php echo $row['nama_kelas'];?></td>
        </tr>
		<?php
		}
		?>
        </table>
        
        </form>
		</div>
	</div>
</div>
</div>
</div>

        
        
	
