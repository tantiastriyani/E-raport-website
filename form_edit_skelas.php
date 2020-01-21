<?php
include "conn.php";



if (!isset($_GET['kode_kelas'])){
	header( 'Location: home.php?page=setup_kelas');
}

$kode_kelas= $_GET['kode_kelas'];

$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){
	
	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $kelas=strtoupper(htmlentities($_POST['kelas']));
  $nama_kelas=ucwords(htmlentities($_POST['nama_kelas']));
  $query=mysqli_query($koneksi,"UPDATE kelas SET kelas='$kelas', nama_kelas='$nama_kelas' WHERE kode_kelas='$kode_kelas'");
  
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=23";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_kelas&status=24";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i>Edit Kelas</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
  <div class="form-group">
  <div class="form-group">
	<form action="" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Kelas </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="kelas" value="<?php echo $result['kelas']; ?>" /></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Nama Kelas </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_kelas" value="<?php echo $result['nama_kelas']; ?>" /></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="edit" value="Edit" class="btn btn-info" />
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

</body>
</html>
