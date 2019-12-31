<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$id_mahasiswa=htmlentities($_POST['id_mahasiswa']);
	$id_kelas=htmlentities($_POST['id_kelas']);
	
	$query=mysqli_query($koneksi,"insert into tbl_ruangan values('','$id_mahasiswa','$id_kelas')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}

if($_GET['mode']=='delete'){
  $id_mahasiswa=$_GET['id_mahasiswa'];
  $id_ruangan=$_GET['id_ruangan'];
  
  $query=mysqli_query($koneksi,"delete from tbl_ruangan where id_ruangan='$id_ruangan'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=9";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=10";</script><?php
  }
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

      <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Ruang Kelas</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=jadwal_ruangkelas" method="post">
          <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIM'/> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=jadwal_ruangkelas' class="btn btn-sm btn-success" >Refresh</i></a>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Mahasiswa</th>
                      <td><select name="id_mahasiswa"  class="form-control">
                      
                      <?php
					  $mahasiswa=mysqli_query($koneksi,"select * from data_mahasiswa order by nama_mahasiswa asc");
					  while($row1=mysqli_fetch_array($mahasiswa)){
					  ?>
                          <option value="<?php echo $row1['id_mahasiswa'];?>"><?php echo $row1['nama_mahasiswa'];?> [ <?php echo $row1['nim'];?> ] </option>
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
						  while($row2=mysqli_fetch_array($kelas)){
						  ?>
							  <option value="<?php echo $row2['id_kelas'];?>"><?php echo $row2['nama_kelas'];?></option>
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
                
              </td>
              <td>  
              </td>
            </tr>
        	</table>
			</form>

		    </div>

	    <form id="mainform" action="">
        <table border="0" width="71%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="13%" class="info">Nomor</th>
            <th width="24%" class="info">Nama Mahasiswa</th>
            <th width="26%" class="info">NIM</th>
            <th width="24%" class="info">Kelas</th>
            <th width="13%" class="info">Aksi</th>
        </tr>
        
        
        

     <?php
                    $query1="SELECT * from tbl_ruangan ruangan, setup_kelas kelas, data_mahasiswa mahasiswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_mahasiswa=mahasiswa.id_mahasiswa order by nama_mahasiswa asc";
                    
                    if(isset($_POST['qcari'])){
                 $qcari=$_POST['qcari'];
                 $query1="SELECT * from tbl_ruangan ruangan, setup_kelas kelas, data_mahasiswa mahasiswa where ruangan.id_kelas=kelas.id_kelas and ruangan.id_mahasiswa=mahasiswa.id_mahasiswa 
                 AND nim like '%$qcari%'";
                    }
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_mahasiswa'];?></td>
            <td><?php echo $row['nim'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=jadwal_ruangkelas&mode=delete&id_ruangan=<?php echo $row['id_ruangan'];?>&id_mahasiswa=<?php echo $row['id_mahasiswa'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_jrkelas1&mode=update&id_ruangan=<?php echo $row['id_ruangan'];?>&id_kelas=<?php echo $row['id_kelas'];?>&id_mahasiswa=<?php echo $row['id_mahasiswa'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
            </td>
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

		
        
        
	
