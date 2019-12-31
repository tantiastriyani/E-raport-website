<?php

include "conn.php";

if(isset($_POST['submit'])){

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

  $sql_script= "INSERT into user(username,password,level) values('$username','$password','siswa')";
  $qry = mysqli_query($koneksi, $sql_script);
  $id_user = mysqli_insert_id($koneksi);
  if($qry){
    if(move_uploaded_file($tmp, $path)){
      $sql= "INSERT into siswa(id_user,kode_kelas,nis,nama_siswa,kelamin,agama,tempat_lahir,alamat,no_tlp,foto,tahun_angkatan,semester,status) values('$id_user','$kelas_siswa','$nis','$nama_siswa','$kelamin', '$agama','$tempatlahir','$alamat','$notelp','$fotobaru','$tahunangkatan','$semester','$status')";
        $query = mysqli_query($koneksi, $sql);
      if($query){
        ?><script language="javascript">document.location.href="?page=data_siswa&status=1";</script><?php
      }else{
        ?><script language="javascript">document.location.href="?page=data_siswa&status=2";</script><?php
      }
    }
  }

  
}else{
  unset($_POST['submit']);
}

if ($_GET['mode']=='delete') {
  $username=$_GET['username'];
  $id_user=$_GET['id_user'];

  $query1 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_user='$id_user'");
$row = mysqli_fetch_array($query1); 


if(is_file("gambar/".$row['foto'])) 
  unlink("gambar/".$row['foto']);

  $query=mysqli_query($koneksi, "DELETE from user where id_user='$id_user'");
  $query=mysqli_query($koneksi, "DELETE from siswa where id_user='$id_user'");

  if($query){
    ?><script language="javascript">document.location.href="?page=data_siswa&status=7";</script><?php
  }else{
    ?><script language="javascript">document.location.href="?page=data_siswa&status=8";</script><?php
  }
}

?>


        
            <?php
      if($_GET['status']=='1'){
      ?>
      
            <div id="message-green">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="green-left">Data berhasil disimpan</td>
                <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
      <?php
      }
      
      if($_GET['status']=='0'){
      ?>

            <div id="message-red">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="red-left">data gagal di simpan</td>
                <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            
      <?php
      }
      ?>


      <div class="row">
            
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Siswa</h3> 
                        </div>

                         
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
        <form action="?page=data_siswa" method="post" enctype="multipart/form-data">
           <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan NIS atau Nama Siswa'/> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='?page=data_siswa' class="btn btn-sm btn-success" >Refresh</i></a><br><br>

          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td>
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th>Nama Siswa </th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="nama_siswa"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>NIS </th>
                      <td><input type="text" class="form-control" name="nis"/></td>
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
                          <option value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['kelas']." ". $row['nama_kelas']; ?></option>
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
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="agama"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Tempat Lahir</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="tempatlahir"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="alamat"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>No Telepon</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="notelp"/></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Tahun Angkatan</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="tahunangkatan"/></td>
                      <td></td>
                    </tr><tr>
                      <th>Semester</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="semester"/></td>
                      <td></td>
                    </tr><tr>
                      <th>Status</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="status"/></td>
                      <td></td>
                    </tr>

                    <tr>
                      <th>Username</th>
                      <td><input style="width: 350px;" type="text" class="form-control" name="username"/></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th>Password</th>
                      <td><input type="password" class="form-control" name="password"/></td>
                      <td></td>
                    </tr>
                    <tr>
                    <th></th>
                    <th>
                    <?php 
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
                      <td><input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                          <input type="reset" value="Reset" class="btn btn-danger"  />
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
      <center>
    <a href="javascript:;"><img src="./images/excel-icon.png" title="Export Data" width="50" height="50" border="0" onClick="window.open('./excel/export_data_mahasiswa.php','scrollwindow','top=200,left=300,width=800,height=500');"></a>
    </center><br>



        <form id="mainform" action="">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            <th width="5%" class="info">Nomor</th>
            <th width="20%" class="info">Nama Siswa</th>
            <th width="10%" class="info">NIS</th>
            <th width="8%" class="info">Kelamin</th>
            <th width="15%" class="info">Kelas</th>
            <th width="10%" class="info">Alamat</th>
            <th width="7%" class="info">No Telepon</th>
             <th width="10%" class="info">Foto</th>
            <th width="15%" class="info">Aksi</th>
        </tr>
        
        
        <?php
                    $query1="select * from siswa join kelas on siswa.kode_kelas = kelas.kode_kelas join user on siswa.id_user = user.id_user order by nama_siswa asc";
                    
                    if(isset($_POST['qcari'])){
                 $qcari=$_POST['qcari'];
                 $query1="SELECT * FROM  siswa
                 join kelas 
                 on siswa.kode_kelas = kelas.kode_kelas
                 join user 
                 on siswa.id_user = user.id_user
                 where siswa.nis like '%$qcari%'
                 or siswa.nama_siswa like '%$qcari%'  ";
                    }
                    $view=mysqli_query($koneksi,$query1) or die(mysqli_error());
                    

    
    $no=0;
    while($row=mysqli_fetch_array($view)){
    ?>  
    <tr>
            <td><?php echo $no=$no+1;?></td>
            <td><?php echo $row['nama_siswa'];?></td>
            <td><?php echo $row['nis'];?></td>
            <td><?php echo $row['kelamin'];?></td>

            <td><?php echo $row['kelas']." ".$row['nama_kelas'];?></td>
            <td><?php echo $row['alamat'];?></td>
            <td><?php echo $row['no_tlp'];?></td>
            <td>
              <?php 
              if(empty($row['foto'])){
                $gambar='nopic.jpg';
              }else{
                $gambar=$row['foto'];
              }
              ?>
              <img src="./gambar/<?php echo $gambar;?>" height="107" width="83">
              </td>
            <td class="options-width">
            <a href="?page=data_siswa&mode=delete&id_user=<?php echo $row['id_user'];?>&username=<?php echo $row['username'];?>" title="Delete"><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
            <a href="?page=form_edit_siswa&mode=update&id_user=<?php echo $row['id_user'];?>&username=<?php echo $row['username'];?>" title="Edit" ><button type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>            
            </td>
        </tr>
    <?php
    }
    ?>
        </table>
        
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>


        
        
  
