<?php

include "conn.php";

$id_pengampu= $_GET['id_pengampu'];



$id_dosen= $_GET['id_dosen'];

$query1= mysqli_query($koneksi, "SELECT * FROM data_dosen WHERE id_dosen='$id_dosen'");

$result1= mysqli_fetch_array($query1);






$id_matkul= $_GET['id_matkul'];

$query3 = mysqli_query($koneksi,"SELECT * FROM setup_matkul WHERE id_matkul='$id_matkul'");

$result3 = mysqli_fetch_array($query3);



$id_kelas= $_GET['id_kelas'];

$query2 = mysqli_query($koneksi,"SELECT * FROM setup_kelas WHERE id_kelas='$id_kelas'");

$result2 = mysqli_fetch_array($query2);



if(isset($_POST['edit'])){
  $id_pengampu=($_GET['id_pengampu']);
  
  $id_matkul=ucwords(htmlentities($_POST['id_matkul']));
  $qry2 = mysqli_query($koneksi,"SELECT * FROM setup_matkul WHERE id_matkul='$id_matkul'");
  $data2 = mysqli_fetch_array($qry2);

  $id_kelas=ucwords(htmlentities($_POST['id_kelas']));
  $qry = mysqli_query($koneksi,"SELECT * FROM setup_kelas WHERE id_kelas='$id_kelas'");
  $data1 = mysqli_fetch_array($qry);

  $query=mysqli_query($koneksi,"UPDATE data_pengampu set id_kelas='$data1[id_kelas]', id_matkul='$data2[id_matkul]' where id_pengampu='$id_pengampu'");
  if($query){
    ?><script language="javascript">document.location.href="?page=data_pengampu&status=31";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_pengampu&status=32";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Edit Data Pengampu</h3> 
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
                      <th valign="top">Nama Dosen</th>
                      <td><input type="text" class="form-control" name="nama_dosen" value="<?php echo $result1['nama_dosen']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">NIP</th>
                      <td><input type="text" class="form-control" name="NIP" value="<?php echo $result1['nip']; ?>"/></td>
                      <td></td>
                    </tr>

                    <tr>
                      <th>Mata Kuliah</th>
                      <td><select name="id_matkul"  class="form-control">

                          <?php
              $matkul=mysqli_query($koneksi,"select * from setup_matkul order by nama_matkul asc");
              while($row2=mysqli_fetch_array($matkul)){
              ?>
                <option value="<?php echo $row2['id_matkul'];?>"><?php echo $row2['nama_matkul'];?></option>
              <?php
              }
              ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th valign="top">Kelas</th>
                      <td><select name="id_kelas"  class="form-control">

                      <?php
              $kelas=mysqli_query($koneksi,"select * from setup_kelas order by nama_kelas asc");
              while($row4=mysqli_fetch_array($kelas)){
              ?>
                <option value="<?php echo $row4['id_kelas'];?>"><?php echo $row4['nama_kelas'];?></option>
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
