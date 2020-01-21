<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$nama_pelajaran=ucwords(htmlentities($_POST['nama_pelajaran']));
	$keterangan=ucwords(htmlentities($_POST['keterangan']));
	
	$query=mysqli_query($koneksi,"insert into mata_pelajaran values('','$nama_pelajaran','$keterangan')");
	
	if($query){
		?><script language="javascript">document.location.href="?page=setup_mapel&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=setup_mapel&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}
if($_GET['mode']=='delete'){
  $kode_pelajaran=$_GET['kode_pelajaran'];


  
  $query=mysqli_query($koneksi,"delete from mata_pelajaran where kode_pelajaran='$kode_pelajaran'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_mapel&status=13";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_mapel&status=14";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i>Mata Pelajaran</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=setup_mapel" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>                  
                <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Mata Pelajaran </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_pelajaran"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Keterangan Mata Pelajaran </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="keterangan"/></td>
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
            <th width="6%" class="info">Nomor</th>
            <th width="39%" class="info">Nama Mata Pelajaran</th>
            <th width="39%" class="info">Keterangan</th>
            <th width="16%" class="info">Aksi</th>
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"select * from mata_pelajaran order by nama_pelajaran asc");
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_pelajaran'];?></td>
            <td><?php echo $row['keterangan'];?></td>
            <td class="options-width">
            <a href="?page=setup_mapel&mode=delete&kode_pelajaran=<?php echo $row['kode_pelajaran'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_smapel&mode=update&kode_pelajaran=<?php echo $row['kode_pelajaran'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
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

		
        
        
