<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$nama_dosen=ucwords(htmlentities($_POST['nama_dosen']));
	$nip=htmlentities($_POST['nip']);
	$kelamin=htmlentities($_POST['kelamin']);
  $alamat=htmlentities($_POST['alamat']);
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
	$sql="insert into data_dosen values('','$nama_dosen','$nip','$kelamin', '$alamat', '$username','$password')";
    $query = mysqli_query($koneksi, $sql);
	
	if($query){
		?><script language="javascript">document.location.href="?page=data_dosen&status=1";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=data_dosen&status=2";</script><?php
	}
	
}else{
	unset($_POST['submit']);
}

if($_GET['mode']=='delete'){
  $username=$_GET['username'];
  $id_dosen=$_GET['id_dosen'];
  
  $query=mysqli_query($koneksi, "delete from data_dosen where id_dosen='$id_dosen'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=data_dosen&status=3";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_dosen&status=4";</script><?php
  }
}




?>

 <?php
			if($_GET['status']=='1'){
			?>
			
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data Berhasil Disimpan</td>
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
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Dosen</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=data_dosen" method="post">
          <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIP atau Nama Dosen' /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=data_dosen' class="btn btn-sm btn-success" >Refresh</i></a><br><br>

 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Dosen </th>
                      <td><input type="text" class="form-control" name="nama_dosen"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIP</th>
                      <td><input type="text" class="form-control" name="nip"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Kelamin</th>
                      <td><select name="kelamin"  class="form-control">
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <th>Alamat</th>
                    <td><textarea name="alamat"></textarea></td>
                    </tr>
                
                     <tr>
                      <th>Username</th>
                      <td><input type="text" class="form-control" name="username" /></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password"/></td>
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

       <center>
    <a href="javascript:;"><img src="./images/excel-icon.png" title="Export Data" width="50" height="50" border="0" onClick="window.open('./excel/export_data_dosen.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
    </center><br><br>
    <a href="home.php?page=import" class="btn btn-success pull-right">
        <span class="glyphicon glyphicon-upload"></span> Import Data
      </a><br><br>
      	
        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="26%" class="info">Nama Dosen</th>
            <th width="17%" class="info">NIP</th>
            <th width="7%" class="info">Kelamin</th>
            <th width="20%" class="info">Alamat</th>

          
            <th width="11%" class="info"><a href="">Username</th>
            <th width="15%" class="info"><a href="">Password</th>
            <th width="15%" class="info"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
$query1="select * from data_dosen order by nama_dosen asc";
                    
                    if(isset($_POST['qcari'])){
                 $qcari=$_POST['qcari'];
                 $query1="SELECT * FROM  data_dosen
                 where nip like '%$qcari%'
                 or nama_dosen like '%$qcari%'  ";
                    }
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
                    
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_dosen'];?></td>
            <td><?php echo $row['nip'];?></td>
            <td><?php echo $row['kelamin'];?></td>
           <td><?php echo $row['alamat'];?></td>
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['password'];?></td>
            <td class="options-width">
            <a href="?page=data_dosen&mode=delete&id_dosen=<?php echo $row['id_dosen'];?>&username=<?php echo $row['username'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_dosen&mode=update&id_dosen=<?php echo $row['id_dosen'];?>&username=<?php echo $row['username'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
            </td>
        </tr>
		<?php
		}
		?>
        </table>
        
        </form>
		
        </a>
      </th>
    </a>
  </th>
</tr>
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

    

