<?php
include "conn.php";



if (!isset($_GET['id_matkul'])){
	header( 'Location: home.php?page=setup_matkul');
}

$id_matkul= $_GET['id_matkul'];

$query = mysqli_query($koneksi,"SELECT * FROM setup_matkul WHERE id_matkul='$id_matkul'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){

	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_matkul=ucwords(htmlentities($_POST['nama_matkul']));
  echo "$nama_matkul";
  $query=mysqli_query($koneksi,"UPDATE setup_matkul SET nama_matkul='$nama_matkul' WHERE id_matkul='$id_matkul'");
  
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=25";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_matkul&status=26";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Mata Kuliah</h3> 
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
                      <th valign="top">Nama Mata Kuliah </th>
                      <td><input style="width: 350px;" class="form-control" type="text" class="inp-form" name="nama_matkul" value="<?php $result['nama_matkul']; ?>" /></td>
                      
                    </tr><br>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="edit" value="edit" class="btn btn-info" /><br>
                      </td>
  
                    </tr>
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
