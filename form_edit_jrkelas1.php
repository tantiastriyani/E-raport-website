<?php
include "conn.php";



if (!isset($_GET['id_ruangan'])){
  header( 'Location: home.php?page=jadwal_ruangkelas');
}

$id_ruangan= $_GET['id_ruangan'];

if (!isset($_GET['id_mahasiswa'])){
  header( 'Location: home.php?page=jadwal_ruangkelas');
}

$id_mahasiswa= $_GET['id_mahasiswa'];

$query1 = mysqli_query($koneksi,"SELECT * FROM data_mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");

$result1 = mysqli_fetch_array($query1);

if(mysqli_num_rows($query1) < 1){
  
  die("Data tidak ditemukan");
}
if (!isset($_GET['id_kelas'])){
  header( 'Location: home.php?page=jadwal_ruangkelas');
}

$id_kelas= $_GET['id_kelas'];

$query2 = mysqli_query($koneksi,"SELECT * FROM setup_kelas WHERE id_kelas='$id_kelas'");

$result2 = mysqli_fetch_array($query2);

if(mysqli_num_rows($query2) < 1){
  
  die("Data tidak ditemukan");
}

if(isset($_POST['edit'])){
  $id_ruangan=($_GET['id_ruangan']);
  $id_kelas=ucwords(htmlentities($_POST['id_kelas']));
  $qry = mysqli_query($koneksi,"SELECT * FROM setup_kelas WHERE id_kelas='$id_kelas'");
  $data1 = mysqli_fetch_array($qry);

  $query=mysqli_query($koneksi,"UPDATE tbl_ruangan set id_kelas='$data1[id_kelas]' where id_ruangan='$id_ruangan'");
  
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=29";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_ruangkelas&status=30";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Edit Ruang Kelas</h3> 
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
                      <th valign="top">Nama Mahasiswa</th>
                      <td><input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $result1['nama_mahasiswa']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">NIM</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="NIM" value="<?php echo $result1['nim']; ?>"/></td>
                      <td></td>
                    </tr>
                    
                   
                    
                    <tr>
                      <th>Kelas</th>
                      <td><select name="id_kelas"  class="form-control">

                          <?php
              $kelas=mysqli_query($koneksi,"select * from setup_kelas order by nama_kelas asc");
              while($row2=mysqli_fetch_array($kelas)){
              ?>
                <option value="<?php echo $row2['id_kelas'];?>"><?php echo $row2['nama_kelas'];?></option>
              <?php
              }
              ?>    
  
                        </select>
                      </td>
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
