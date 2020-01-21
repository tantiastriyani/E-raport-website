<?php
include "conn.php";


if (!isset($_GET['kode_hari'])){
  header( 'Location: home.php?page=jadwal_hari');
}

$kode_hari= $_GET['kode_hari'];

$query1 = mysqli_query($koneksi,"SELECT * FROM hari WHERE kode_hari='$kode_hari'");

$result1 = mysqli_fetch_array($query1);

if(mysqli_num_rows($query1) < 1){
  
  die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  $nama_hari=ucwords(htmlentities($_POST['nama_hari']));

  $query=mysqli_query($koneksi,"UPDATE hari set nama_hari='$nama_hari' where kode_hari='$kode_hari'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_hari&status=29";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_hari&status=30";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Edit Data Hari</h3> 
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
                      <th valign="top">Nama Hari</th>
                      <td><input type="text" class="form-control" name="nama_hari" value="<?php echo $result1['nama_hari']; ?>"/></td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top"><input type="submit" name="edit" value="edit" class="btn btn-info" />
                          
                      </td>
                      <td></td>
                    </tr>
                  </table>
                
              </td>
              <td>  
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
