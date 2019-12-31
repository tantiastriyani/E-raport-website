<?php
include "conn.php";



if (!isset($_GET['id_user'])){
	header( 'Location: home.php?page=data_siswa');
}

$id_user= $_GET['id_user'];

$query = mysqli_query($koneksi,"SELECT * FROM siswa join kelas on siswa.kode_kelas = kelas.kode_kelas join user on siswa.id_user = user.id_user WHERE siswa.id_user='$id_user'");

$result = mysqli_fetch_array($query);

if(mysqli_num_rows($query) < 1){
	
	die("Data tidak ditemukan");
}
if(isset($_POST['edit'])){
  
  $nama_siswa=ucwords(htmlentities($_POST['nama_siswa']));
  $kelas_siswa=ucwords(htmlentities($_POST['kelas_siswa']));
  $nis=htmlentities($_POST['nis']);
  $kelamin=htmlentities($_POST['kelamin']);
  $agama=htmlentities($_POST['agama']);
  $tempatlahir=htmlentities($_POST['tempatlahir']);
  $alamat=htmlentities($_POST['alamat']);
  $notelp=htmlentities($_POST['notelp']);
  $tahunangkatan=htmlentities($_POST['tahunangkatan']);
  $semester=htmlentities($_POST['semester']);
  $status=htmlentities($_POST['status']);

  $username=htmlentities($_POST['username']);
  $password=md5(htmlentities($_POST['password']));
  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];

  $fotobaru = date('dmYHis').$foto;
  $path = "gambar/".$fotobaru;

   
 
  if(move_uploaded_file($tmp, $path))
    $query = mysqli_query($koneksi,"SELECT * FROM siswa WHERE id_user='$id_user'");
    $row = mysqli_fetch_array($query); 

    if(is_file("gambar/".$row['foto'])) 
      unlink("gambar/".$row['foto']); 

  $query1=mysqli_query($koneksi,"UPDATE siswa SET nama_siswa='$nama_siswa', kode_kelas='$kelas_siswa', nis='$nis', kelamin='$kelamin', agama='$agama', alamat='$alamat', tempat_lahir='$tempatlahir', no_tlp='$notelp', tahun_angkatan='$tahunangkatan', semester='$semester', status='$status', foto='$fotobaru' WHERE id_user='$id_user'");
  $query2=mysqli_query($koneksi,"UPDATE user SET username='$username', password='$password' WHERE id_user='$id_user'");
  
  
  if($query1){
    ?><script language="javascript">document.location.href="?page=data_siswa&status=21";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_siswa&status=22";</script><?php
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
                        <h3 class="panel-title"><i class="fa fa-book"></i> Edit Data Siswa</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
  <div class="form-group">
  <div class="form-group">
	<form action="" method="post" enctype="multipart/form-data">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Siswa </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_siswa" value="<?php echo $result['nama_siswa']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIS </th>
                      <td><input type="text" class="form-control" name="nis" value="<?php echo $result['nis']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Kelas</th>
                      <td><select name="kelas_siswa"  class="form-control">
                      <?php 
                       $query_kelas="select * from kelas";
                       $view_kelas=mysqli_query($koneksi,$query_kelas) or die(mysqli_error());
                    
                       while($row=mysqli_fetch_array($view_kelas)){
                      ?>
                          <option <?php if($row['kode_kelas']==$result['kode_kelas']){ echo "selected";} ?> value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['kelas']." ". $row['nama_kelas']; ?></option>
                      <?php
                      }
                      ?>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Kelamin</th>
                      <td><select name="kelamin"  class="form-control">
                          <option <?php if($result['kelamin']=="laki-laki"){ echo "selected";} ?> value="laki-laki">Laki-laki</option>
                          <option <?php if($result['kelamin']=="perempuan"){ echo "selected";} ?> value="perempuan">Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="agama" value="<?php echo $result['agama']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Tempat Lahir</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="tempatlahir" value="<?php echo $result['tempat_lahir']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="alamat" value="<?php echo $result['alamat']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>No Telepon</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="notelp" value="<?php echo $result['no_tlp']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Tahun Angkatan</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="tahunangkatan" value="<?php echo $result['tahun_angkatan']; ?>"/></td>
                      <td></td>
                    </tr><tr>
                      <th>Semester</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="semester" value="<?php echo $result['semester']; ?>"/></td>
                      <td></td>
                    </tr><tr>
                      <th>Status</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="status" value="<?php echo $result['status']; ?>"/></td>
                      <td></td>
                    </tr>

                    <tr>
                      <th>Username</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="username" value="<?php echo $result['username']; ?>"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password" value="<?php echo $result['password']; ?>"/></td>
                      <td></td>
                    </tr>
                    <tr>
                    <th></th>
                    <th>
                    <?php 
                    $gambar = $result["foto"];
                    if(empty($gambar)){
                      $gambar='nopic.jpg';
                    }else{
                      $gambar=$gambar;
                    }
                    ?>
                    <img src="./gambar/<?php echo $gambar;?>" height="101" width="83">
                    </th>
                  </tr>
                    <tr>
                    <th>Photo</th>
                    <td>            
                      <input type="file" name="foto" size="30"/>
                    </td>
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
