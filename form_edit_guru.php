<?php
include "conn.php";



if (!isset($_GET['id_user'])){
	header( 'Location: home.php?page=data_dosen');
}

$id_user= $_GET['id_user'];

$query = mysqli_query($koneksi,"SELECT * FROM guru JOIN user on guru.id_user = user.id_user WHERE guru.id_user='$id_user'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){
	
	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_guru=ucwords(htmlentities($_POST['nama_guru']));
	$nip=htmlentities($_POST['nip']);
	$kelamin=htmlentities($_POST['kelamin']);
  $alamat=$_POST['alamat'];
  $agama=htmlentities($_POST['agama']);
	$username=htmlentities($_POST['username']);
	$password=md5(htmlentities($_POST['password']));
	
  $query=mysqli_query($koneksi, "UPDATE guru SET nama_guru='$nama_guru', nip='$nip', kelamin='$kelamin', alamat='$alamat', agama='$agama' WHERE id_user='$id_user'");
  
  $query1=mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password' WHERE id_user='$id_user'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=data_guru&status=19";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_guru&status=20";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Data Guru</h3> 
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
                      <th>Nama Guru </th>
                      <td><input type="text" class="form-control" name="nama_guru" value="<?php echo $result['nama_guru']; ?>"/></td>
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
                          <option <?php if($result['kelamin']=="laki-laki"){ echo "selected"; } ?> value="laki-laki">Laki-laki</option>
                          <option <?php if($result['kelamin']=="perempuan"){ echo "selected"; } ?> value="perempuan">Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Agama </th>
                      <td><input type="text" class="form-control" name="agama" value="<?php echo $result['agama']; ?>"/></td>
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
