<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$nama_hari=htmlentities($_POST['nama_hari']);
	
	
	$query=mysqli_query($koneksi,"insert into hari values('','$nama_hari')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=jadwal_hari&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=jadwal_hari&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}

if($_GET['mode']=='delete'){
  $kode_hari=$_GET['kode_hari'];
  
  $query=mysqli_query($koneksi,"delete from hari where kode_hari='$kode_hari'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_hari&status=9";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_hari&status=10";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bank"></i>Data Hari</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=jadwal_hari" method="post">
          
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Hari</th>
                      <td>
                      <input type="text" class="form-control" name="nama_hari"/>
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
            <th width="74%" class="info">Nama Hari</th>
            <th width="13%" class="info">Aksi</th>
        </tr>
        
        
        

     <?php
                    $query1="SELECT * from hari";
          
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_hari'];?></td>
            <td class="options-width">
            <a href="?page=jadwal_hari&mode=delete&kode_hari=<?php echo $row['kode_hari'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_jhari&mode=update&kode_hari=<?php echo $row['kode_hari'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
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

		
        
        
	
