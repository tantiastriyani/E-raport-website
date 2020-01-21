<?php
include "conn.php";



if (!isset($_GET['kode_pelajaran'])){
	header('Location: home.php?page=setup_mapel');
}

$kode_pelajaran= $_GET['kode_pelajaran'];

$query = mysqli_query($koneksi,"SELECT * FROM mata_pelajaran WHERE kode_pelajaran='$kode_pelajaran'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){

	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_pelajaran=ucwords(htmlentities($_POST['nama_pelajaran']));
  $keterangan=ucwords(htmlentities($_POST['keterangan']));
  $query=mysqli_query($koneksi,"UPDATE mata_pelajaran SET nama_pelajaran='$nama_pelajaran', keterangan='$keterangan' WHERE kode_pelajaran='$kode_pelajaran'");
  
  
  if($query){
    ?><script language="javascript">document.location.href="?page=setup_mapel&status=25";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=setup_mapel&status=26";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Mata Pelajaran</h3> 
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
                      <th valign="top">Nama Mata Pelajaran </th>
                      <td><input style="width: 350px;" class="form-control" type="text" class="inp-form" name="nama_pelajaran" value="<?php echo $result['nama_pelajaran']; ?>" /></td>
                    </tr><br>
                    <tr>
                      <th valign="top">Keterangan Mata Pelajaran </th>
                      <td><input style="width: 350px;" class="form-control" type="text" class="inp-form" name="keterangan" value="<?php echo $result['keterangan']; ?>" /></td>
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
