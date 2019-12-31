<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 




    include "conn.php";
?>


      
        <div class="row">
                  <div class="col-lg-9 main-chart">
                   
                    <div class="row mtbox">
                    
                    <?php $tampil=mysqli_query($koneksi,"select * from guru order by kode_guru desc");
                        $total=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=data_guru" class="btn btn-lg btn-danger">Guru</a></h3>
                                <span class="glyphicon glyphicon-list-alt"></span>
                                <h3><?php echo "$total"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total"; ?> Guru </p>
                        </div>
                        
                        <?php $tampil=mysqli_query($koneksi,"select * from siswa order by kode_siswa desc");
                        $total_siswa=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=data_siswa" class="btn btn-lg btn-primary">Siswa</a></h3>
                                <span class="glyphicon glyphicon-user"></span>
                                <h3><?php echo "$total_siswa"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_siswa"; ?> Siswa</p>
                        </div>
                        <?php $tampil=mysqli_query($koneksi,"select * from mata_pelajaran order by kode_pelajaran desc");
                        $total_mapel=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=setup_mapel" class="btn btn-lg btn-info">Mapel</a></h3>
                                <span class="glyphicon glyphicon-book"></span>
                                <h3><?php echo "$total_mapel"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_mapel"; ?> Mata Pelajaran</p>
                        </div>
                        <?php $tampil=mysqli_query($koneksi,"select * from kelas order by kode_kelas desc");
                        $total_kelas=mysqli_num_rows($tampil);
                    ?>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <h3><a href="home.php?page=setup_kelas" class="btn btn-lg btn-warning">Kelas</a></h3>
                                <span class="glyphicon glyphicon-home"></span>
                                <h3><?php echo "$total_kelas"; ?></h3>
                            </div>
                                <p>Terdapat <?php echo "$total_kelas"; ?> Kelas</p>
                        </div>
                        

             </div>
         </div>
     </div>
 
