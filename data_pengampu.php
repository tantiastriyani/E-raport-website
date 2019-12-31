<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$id_dosen=htmlentities($_POST['id_dosen']);
	$id_matkul=htmlentities($_POST['id_matkul']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$query=mysqli_query($koneksi,"insert into data_pengampu values('','$id_dosen','$id_matkul','$id_kelas')");
	
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_pengampu&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_pengampu&status=2";</script><?php
	}
	
	
}else{
	unset($_POST['submit']);
}
if($_GET['mode']=='delete'){
  $id_pengampu=$_GET['id_pengampu'];
  $id_dosen=$_GET['id_dosen'];


  
  $query=mysqli_query($koneksi,"delete from data_pengampu where id_pengampu='$id_pengampu'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=data_pengampu&status=13";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_pengampu&status=14";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Data Pengampu</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=data_pengampu" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Dosen</th>
                      <td><select name="id_dosen"  class="form-control">
                      
                      <?php
					  $dosen=mysqli_query($koneksi,"select * from data_dosen order by nama_dosen asc");
					  while($row1=mysqli_fetch_array($dosen)){
					  ?>
                          <option value="<?php echo $row1['id_dosen'];?>"><?php echo $row1['nama_dosen'];?> [ <?php echo $row1['nip'];?> ] </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>Matakuliah</th>
                      <td><select name="id_matkul"  class="form-control">

                          <?php
						  $matkul=mysqli_query($koneksi,"select * from setup_matkul order by nama_matkul asc");
						  while($row2=mysqli_fetch_array($matkul)){
						  ?>
							  <option value="<?php echo $row2['id_matkul'];?>"><?php echo $row2['nama_matkul'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>Kelas</th>
                      <td><select name="id_kelas"  class="form-control">

                          <?php
						  $kelas=mysqli_query($koneksi,"select * from setup_kelas order by nama_kelas asc");
						  while($row3=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row3['id_kelas'];?>"><?php echo $row3['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
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
            <th width="13%" class="info">Nomor</th>
            <th width="20%" class="info">Nama Dosen</th>
            <th width="10%" class="info">NIP</th>
            <th width="20%" class="info">Mata Kuliah</th>
            <th width="17%" class="info">Kelas</th>
            <th width="30%" class="info">Aksi</th>
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT * from data_pengampu pengampu, setup_kelas kelas, setup_matkul matkul, data_dosen dosen where pengampu.id_kelas=kelas.id_kelas and pengampu.id_matkul=matkul.id_matkul and pengampu.id_dosen=dosen.id_dosen order by id_pengampu asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_dosen'];?></td>
            <td><?php echo $row['nip'];?></td>
            <td><?php echo $row['nama_matkul'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=data_pengampu&mode=delete&id_pengampu=<?php echo $row['id_pengampu'];?>&id_dosen=<?php echo $row['id_dosen'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_dp&id_pengampu=<?php echo $row['id_pengampu'];?>&id_dosen=<?php echo $row['id_dosen'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
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

        
        

