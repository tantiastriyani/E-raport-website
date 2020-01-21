<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$kelas=strtoupper(htmlentities($_POST['kelas']));
	$nama_kelas=ucwords(htmlentities($_POST['nama_kelas']));
	
	$query=mysqli_query($koneksi, "insert into kelas values('', '$kelas', '$nama_kelas', 'Aktif')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=setup_kelas&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=setup_kelas&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
if($_GET['mode']=='delete'){
  $kode_kelas=$_GET['kode_kelas'];


  
  $query=mysqli_query($koneksi,"delete from kelas where kode_kelas='$kode_kelas'");

  if($query){
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=11";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=12";</script><?php
  }
}
if($_GET['mode']=='update'){
  $kode_kelas=$_GET['kode_kelas'];

  $kelas=htmlentities($_POST['kelas']);
  $nama_kelas=strtoupper(htmlentities($_POST['nama_kelas']));
  
  $query=mysqli_query("update kelas set kelas='$kelas', nama_kelas='$nama_kelas' where kode_kelas='$kode_kelas'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=15";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=16";</script><?php
  }
}


?>





    		
            <?php
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data berhasil disimpan :)</td>
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
                        <h3 class="panel-title"><i class="fa fa-database"></i> Data Kelas</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=setup_kelas" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Kelas </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="kelas"/></td>
                      <td></td>
                    </tr><tr>
                      <th>Nama Kelas </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_kelas"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                          <input type="reset" value="Reset" class="btn btn-danger"  />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                
              
			</form>
</div>

      	
        <form id="mainform" action="">
        <table border="0" width="61%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="16%" class="info">Nomor</th>
            <th width="18%" class="info">Kelas</th>
            <th width="50%" class="info">Nama Kelas</th>
            <th width="16%" class="info">Aksi</th>
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"select * from kelas");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['kelas'];?></td>
            <td><?php echo $row['nama_kelas'];?></td>
            <td class="options-width">
            <a href="?page=setup_kelas&mode=delete&kode_kelas=<?php echo $row['kode_kelas'];?>&nama_kelas=<?php echo $row['nama_kelas'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_skelas&mode=update&kode_kelas=<?php echo $row['kode_kelas'];?>&nama_kelas=<?php echo $row['nama_kelas'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
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

		
        
        
	