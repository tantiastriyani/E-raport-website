<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$kode_kelas=htmlentities($_POST['kode_kelas']);
	$kode_guru=htmlentities($_POST['kode_guru']);
	$kode_hari=htmlentities($_POST['kode_hari']);
	$kode_pelajaran=htmlentities($_POST['kode_pelajaran']);
	$jam_mulai=htmlentities($_POST['jam_mulai']);
	$jam_selesai=htmlentities($_POST['jam_selesai']);
	
	$query=mysqli_query($koneksi,"insert into jadwal values('','$kode_kelas','$kode_guru','$kode_hari','$kode_pelajaran','$jam_mulai','$jam_selesai')");
	
	
	if($query){
		?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=2";</script><?php
	}
	
	
}else{
	unset($_POST['submit']);
}
if($_GET['mode']=='delete'){
  $kode_jadwal=$_GET['kode_jadwal'];


  
  $query=mysqli_query($koneksi,"delete from jadwal where kode_jadwal='$kode_jadwal'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=13";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=14";</script><?php
  }
}


?>





    <div id="content-table-inner">
    		
            <?php
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left"> Data berhasil disimpan</td>
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
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Data Jadwal Pelajaran</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=jadwal_pelajaran" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                  <tr>
                      <th>Kelas</th>
                      <td><select name="kode_kelas"  class="form-control">

                          <?php
						  $kelas=mysqli_query($koneksi,"select * from kelas");
						  while($row3=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row3['kode_kelas'];?>"><?php echo $row3['kelas']." ".$row3['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>Guru</th>
                      <td><select name="kode_guru"  class="form-control">
                      
                      <?php
					  $guru=mysqli_query($koneksi,"select * from guru order by nama_guru asc");
					  while($row1=mysqli_fetch_array($guru)){
					  ?>
                          <option value="<?php echo $row1['kode_guru'];?>"><?php echo $row1['nama_guru'];?> [ <?php echo $row1['nip'];?> ] </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>hari</th>
                      <td><select name="kode_hari"  class="form-control">
                      
                      <?php
					  $hari=mysqli_query($koneksi,"select * from hari");
					  while($row0=mysqli_fetch_array($hari)){
					  ?>
                          <option value="<?php echo $row0['kode_hari'];?>"><?php echo $row0['nama_hari'];?> </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Mata Pelajaran</th>
                      <td><select name="kode_pelajaran" class="form-control">

                          <?php
						  $mapel=mysqli_query($koneksi,"select * from mata_pelajaran order by nama_pelajaran asc");
						  while($row2=mysqli_fetch_array($mapel)){
						  ?>
							  <option value="<?php echo $row2['kode_pelajaran'];?>"><?php echo $row2['nama_pelajaran'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Jam Mulai</th>
                      <td><input type="time" class="form-control" name="jam_mulai"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Jam Selesai</th>
                      <td><input type="time" class="form-control" name="jam_selesai"/></td>
                      <td></td>
                    </tr>
                  
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                          <input type="reset" value="Reset" class="btn btn-danger"  />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                
              
			</form>

			</div>
			  
        <form id="mainform" action="">
        <table border="0" width="71%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="10%" class="info">Hari</th>
            <th width="8%" class="info">Jam Mulai</th>
            <th width="8%" class="info">Jam Selesai</th>
            <th width="20%" class="info">Nama Guru</th>
            <th width="20%" class="info">Mata Pelajaran</th>
            <th width="17%" class="info">Kelas</th>
            <th width="22%" class="info">Aksi</th>
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT * from jadwal JOIN guru ON jadwal.kode_guru = guru.kode_guru JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas JOIN hari ON jadwal.kode_hari = hari.kode_hari JOIN mata_pelajaran ON jadwal.kode_pelajaran = mata_pelajaran.kode_pelajaran");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_hari'];?></td>
            <td><?php echo $row['jam_mulai'];?></td>
            <td><?php echo $row['jam_selesai'];?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['nama_pelajaran'];?></td>
            <td><?php echo $row['kelas']." ".$row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=jadwal_pelajaran&mode=delete&kode_jadwal=<?php echo $row['kode_jadwal'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_dp&kode_jadwal=<?php echo $row['kode_jadwal'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
            </td>
        </tr>
		<?php
		}
		?>
        </table>
            </form>
         </td>
       </tr>
     </table>
   </form>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>

        
        

