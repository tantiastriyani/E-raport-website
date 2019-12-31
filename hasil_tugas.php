<?php

include "conn.php";

?>

    	<?php
		
		$id_mahasiswa=$_SESSION['id_mahasiswa'];
		$mahasiswa=mysqli_fetch_array(mysqli_query($koneksi,"select mahasiswa.nama_mahasiswa, mahasiswa.nim, kelas.nama_kelas from tbl_ruangan ruangan, data_mahasiswa mahasiswa, setup_kelas kelas where ruangan.id_mahasiswa=mahasiswa.id_mahasiswa and ruangan.id_mahasiswa='$id_mahasiswa' and ruangan.id_kelas=kelas.id_kelas"));
		
		$nama_mahasiswa=$mahasiswa['nama_mahasiswa'];
		$nim=$mahasiswa['nim'];
		$nama_kelas=$mahasiswa['nama_kelas'];
		
		?>
    
    <div class="row">
          
          <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Hasil Tugas</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
    <div class="form-group">
        <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
          <th>Nama Mahasiswa</th>
          <td><input style="width: 350px;" type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $nama_mahasiswa;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
         <tr>
          <th>NIM</th>
          <td><input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $nim;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
        <tr>
          <th>Kelas</th>
          <td><input type="text" class="form-control" name="nim" value="<?php echo $nama_kelas;?>" disabled="disabled"/></td>
          <td></td>
        </tr>
      </table>
    </div>
      <br />
      
        <form id="mainform" action="home.php?page=input_tugas_mahasiswa" method="post">
        <table border="0" width="48%" cellpadding="0" cellspacing="0" class="table table-hover table table-bordered">
        <tr>
            
             <th width="1%" class="info">Nomor  </th>
            <th width="20%" class="info">Mata Kuliah</th>
            <th width="5%" class="info">Tugas 1</th>
             <th width="5%" class="info">Tugas 2</th>
              <th width="5%" class="info">Tugas 3</th>
               <th width="5%" class="info">Tugas 4</th>
                <th width="5%" class="info">Tugas 5</th>
                 
        </tr>
        
        
        <?php
		$view=mysqli_query($koneksi,"SELECT nama_matkul, tugas_1, tugas_2, tugas_3, tugas_4, tugas_5, tugas_6, tugas_7, tugas_8, tugas_9, tugas_10, tugas_11, tugas_12, tugas_13, tugas_14, tugas_15 FROM tbl_tugas tugas,  setup_matkul matkul WHERE tugas.id_mahasiswa='$id_mahasiswa' and tugas.id_matkul=matkul.id_matkul order by matkul.nama_matkul asc");
		
		$i = 1;
		while($row=mysqli_fetch_array($view)){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row['nama_matkul'];?></td>
				<td><?php echo $row['tugas_1'];?></td>
        <td><?php echo $row['tugas_2'];?></td>
        <td><?php echo $row['tugas_3'];?></td>
        <td><?php echo $row['tugas_4'];?></td>
        <td><?php echo $row['tugas_5'];?></td>
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
      <script type="text/javascript">
  $(document).ready(function () {
    var n=6;
    var r=0;
    $('#tmh_kolom').on('click', function () {
      n++;

      $('#tgs_tbl').find('tr').each(function(){
        console.log(r++);
        $(this).find('td').eq(n).after('<td><input size=10 name=tugas_'+(r-1)+(n-1)+'></input>');
        $(this).find('th').eq(n).after('<th class=info>Tugas '+(n-1)+'</th>');
      });
    });
  })

</script>
		
        
        
	
