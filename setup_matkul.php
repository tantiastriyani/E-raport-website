<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$nama_matkul=ucwords(htmlentities($_POST['nama_matkul']));
	
	$query=mysqli_query($koneksi,"insert into setup_matkul values('','$nama_matkul')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=setup_matkul&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=setup_matkul&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
if($_GET['mode']=='delete'){
  $id_matkul=$_GET['id_matkul'];
  $nama_matkul=$_GET['nama_matkul'];


  
  $query=mysqli_query($koneksi,"delete from setup_matkul where id_matkul='$id_matkul'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=13";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=14";</script><?php
  }
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
                        <h3 class="panel-title"><i class="fa fa-book"></i>Mata Kuliah</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=setup_matkul" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>                  
                <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Mata Kuliah </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_matkul"/></td>
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
              
      	
        <form id="mainform" action="">
        <table border="0" width="61%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="16%" class="info">Nomor</th>
            <th width="68%" class="info">Nama Mata Kuliah</th>
            <th width="16%" class="info">Aksi</th>
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"select * from setup_matkul order by nama_matkul asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_matkul'];?></td>
            <td class="options-width">
            <a href="?page=setup_matkul&mode=delete&id_matkul=<?php echo $row['id_matkul'];?>&nama_matkul=<?php echo $row['nama_matkul'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_smatkul&mode=update&id_matkul=<?php echo $row['id_matkul'];?>&nama_matkul=<?php echo $row['nama_matkul'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
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

		
        
        
