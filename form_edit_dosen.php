<?php
include "conn.php";



if (!isset($_GET['id_dosen'])){
	header( 'Location: home.php?page=data_dosen');
}

$id_dosen= $_GET['id_dosen'];

$query = mysqli_query($koneksi,"SELECT * FROM data_dosen WHERE id_dosen='$id_dosen'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){
	
	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_dosen=ucwords(htmlentities($_POST['nama_dosen']));
  $nip=htmlentities($_POST['nip']);
  $kelamin=htmlentities($_POST['kelamin']);
  $alamat=htmlentities($_POST['alamat']);
  
  $username=htmlentities($_POST['username']);
  $password=md5(htmlentities($_POST['password']));
  echo "$nama_dosen";
  $query=mysqli_query($koneksi, "UPDATE data_dosen SET nama_dosen='$nama_dosen', nip='$nip', kelamin='$kelamin', alamat='$alamat', username='$username', password='$password' WHERE id_dosen='$id_dosen'");
  
  
  if($query){
    ?><script language="javascript">document.location.href="?page=data_dosen&status=19";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_dosen&status=20";</script><?php
  }
  
}else{
  unset($_POST['edit']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Edit</title>
</head>
<body>
	<div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Data Dosen</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
  <div class="form-group">
  <div class="form-group">
	<form action="" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Dosen </th>
                      <td><input type="text" class="form-control" name="nama_dosen" value="<?php echo $result['nama_dosen']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIP</th>
                      <td><input type="text" class="form-control" name="nip" value="<?php echo $result['nip']; ?>"/></td>
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
                      <td><textarea name="alamat"><?php echo $result['alamat'];?></textarea></td>
                    </tr>

                    
                
                     <tr>
                      <th>Username</th>
                      <td><input type="text" class="form-control" name="username" value="<?php echo $result['username']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password" value="<?php echo $result['password']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
                      	<input type="submit" name="edit" id="edit" value="Edit" class="btn btn-info" />
                      </td>
                      <td></td>
                    </tr>
                  </table>
              </td>
              <td>
              </td>
            </tr>
            
			</form>
    </div>
  </table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


</body>
</html>
