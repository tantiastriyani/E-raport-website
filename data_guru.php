<?php

include "conn.php";

if(isset($_POST['submit'])){
	
	$nama_guru=ucwords(htmlentities($_POST['nama_guru']));
	$nip=htmlentities($_POST['nip']);
	$kelamin=htmlentities($_POST['kelamin']);
  $alamat=$_POST['alamat'];
  $agama=htmlentities($_POST['agama']);
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
	$sql_user="insert into user values('', '$username','$password', 'guru')";
  $qry = mysqli_query($koneksi, $sql_user);
	if($qry){
    $id_user = mysqli_insert_id($koneksi);
    $sql="insert into guru values('', '$id_user','$nip','$nama_guru','$kelamin', '$alamat', '$agama', 'aktif')";
    $query = mysqli_query($koneksi, $sql);
    
    if($query){
      ?>
      <script language="javascript">document.location.href="?page=data_guru&status=1";</script>
      <?php
    }else{
      ?>
      <script language="javascript">document.location.href="?page=data_guru&status=2";</script>
      <?php
    }  
  } else {
    ?>
    <script language="javascript">document.location.href="?page=data_guru&status=2";</script>
    <?php
  }
	
}else{
	unset($_POST['submit']);
}

if($_GET['mode']=='delete'){
  $username=$_GET['username'];
  $id_user=$_GET['id_user'];
  
  $query=mysqli_query($koneksi, "delete from user where id_user='$id_user'");
  
  $query1=mysqli_query($koneksi, "delete from guru where id_user='$id_user'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=data_guru&status=3";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_guru&status=4";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Guru</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
    		<form action="?page=data_guru" method="post">
          <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIP atau Nama Guru' /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=data_guru' class="btn btn-sm btn-success" >Refresh</i></a><br><br>

 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Guru </th>
                      <td><input type="text" class="form-control" name="nama_guru"/></td>
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
                    <tr>
                    <th>Alamat</th>
                    <td><textarea name="alamat" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <td><input type="text" class="form-control" name="agama"/></td>
                      <td></td>
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
            <th width="26%" class="info">Nama Guru</th>
            <th width="10%" class="info">NIP</th>
            <th width="12%" class="info">Kelamin</th>
            <th width="12%" class="info">Agama</th>
            <th width="20%" class="info">Alamat</th>
            <th width="15%" class="info"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
        $query1="select * from guru join user on guru.id_user = user.id_user order by nama_guru asc";
                    
        if(isset($_POST['qcari'])){
          $qcari=$_POST['qcari'];
          $query1="SELECT * FROM guru
          join user 
          on guru.id_user = user.id_user
          where guru.nip like '%$qcari%'
          or guru.nama_guru like '%$qcari%'  ";
        }
        $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
                    
		
		$no=0;
		while($row=mysqli_fetch_array($view)){
		?>	
		<tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_guru'];?></td>
            <td><?php echo $row['nip'];?></td>
            <td><?php echo $row['kelamin'];?></td>
            <td><?php echo $row['agama'];?></td>
            <td><?php echo $row['alamat'];?></td>
            <td class="options-width">
            <a href="?page=data_guru&mode=delete&id_user=<?php echo $row['id_user'];?>&username=<?php echo $row['username'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_guru&mode=update&id_user=<?php echo $row['id_user'];?>&username=<?php echo $row['username'];?>" title="Edit"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>
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

    

