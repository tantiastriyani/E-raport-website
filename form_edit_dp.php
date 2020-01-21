<?php

include "conn.php";

$kode_jadwal= $_GET['kode_jadwal'];

$qry=mysqli_query($koneksi,"SELECT * from jadwal JOIN guru ON jadwal.kode_guru = guru.kode_guru JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas JOIN hari ON jadwal.kode_hari = hari.kode_hari JOIN mata_pelajaran ON jadwal.kode_pelajaran = mata_pelajaran.kode_pelajaran WHERE kode_jadwal='$kode_jadwal'");
		
$result1=mysqli_fetch_array($qry);

if(isset($_POST['edit'])){
  $kode_kelas=htmlentities($_POST['kode_kelas']);
	$kode_guru=htmlentities($_POST['kode_guru']);
	$kode_hari=htmlentities($_POST['kode_hari']);
	$kode_pelajaran=htmlentities($_POST['kode_pelajaran']);
	$jam_mulai=htmlentities($_POST['jam_mulai']);
	$jam_selesai=htmlentities($_POST['jam_selesai']);

  $query=mysqli_query($koneksi,"UPDATE jadwal set kode_kelas='$kode_kelas', kode_guru='$kode_guru',kode_hari='$kode_hari', kode_pelajaran='$kode_pelajaran',jam_mulai='$jam_mulai', jam_selesai='$jam_selesai' where kode_jadwal='$kode_jadwal'");
  if($query){
    ?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=31";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=jadwal_pelajaran&status=32";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-bank"></i> Edit Data Jadwal</h3> 
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
                      <th>Kelas</th>
                      <td><select name="kode_kelas"  class="form-control">

                          <?php
						  $kelas=mysqli_query($koneksi,"select * from kelas");
						  while($row3=mysqli_fetch_array($kelas)){
						  ?>
							  <option <?php if($result1["kode_kelas"]==$row3['kode_kelas']){ echo "selected"; } ?> value="<?php echo $row3['kode_kelas'];?>"><?php echo $row3['kelas']." ".$row3['nama_kelas'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th>Guru</th>
                      <td><select name="kode_guru"  class="form-control">
                      
                      <?php
					  $guru=mysqli_query($koneksi,"select * from guru order by nama_guru asc");
					  while($row1=mysqli_fetch_array($guru)){
					  ?>
                          <option <?php if($result1["kode_guru"]==$row1['kode_guru']){ echo "selected"; } ?> value="<?php echo $row1['kode_guru'];?>"><?php echo $row1['nama_guru'];?> [ <?php echo $row1['nip'];?> ] </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>hari</th>
                      <td><select name="kode_hari"  class="form-control">
                      
                      <?php
					  $hari=mysqli_query($koneksi,"select * from hari");
					  while($row0=mysqli_fetch_array($hari)){
					  ?>
                          <option <?php if($result1["kode_hari"]==$row0['kode_hari']){ echo "selected"; } ?> value="<?php echo $row0['kode_hari'];?>"><?php echo $row0['nama_hari'];?> </option>
					  <?php
					  }
					  ?>                          
                          
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Mata Pelajaran</th>
                      <td><select name="kode_pelajaran" class="form-control">

                          <?php
						  $mapel=mysqli_query($koneksi,"select * from mata_pelajaran order by nama_pelajaran asc");
						  while($row2=mysqli_fetch_array($mapel)){
						  ?>
							  <option <?php if($result1["kode_pelajaran"]==$row2['kode_pelajaran']){ echo "selected"; } ?> value="<?php echo $row2['kode_pelajaran'];?>"><?php echo $row2['nama_pelajaran'];?></option>
						  <?php
						  }
						  ?>    
  
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Jam Mulai</th>
                      <td><input type="time" class="form-control" name="jam_mulai" value="<?php echo $result1["jam_mulai"]; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Jam Selesai</th>
                      <td><input type="time" class="form-control" name="jam_selesai" value="<?php echo $result1["jam_selesai"]; ?>"/></td>
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
