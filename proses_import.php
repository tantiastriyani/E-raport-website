<?php

include "conn.php";

if(isset($_POST['import'])){ 
	require_once 'PHPExcel/PHPExcel.php';
	
	$inputFileType = 'CSV';
	$inputFileName = 'tmp/data.csv';
	
	$reader = PHPExcel_IOFactory::createReader($inputFileType);
	$excel = $reader->load($inputFileName);
	
	
	$sql = $pdo->prepare("INSERT INTO data_dosen VALUES(:nama_dosen,:nip,:kelamin,:alamat,:username,:password)");
	
	$numrow = 1;
	$worksheet = $excel->getActiveSheet();
	foreach ($worksheet->getRowIterator() as $row) {
		
		if($numrow > 1){
			
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); 
			
			$get = array(); 
			foreach ($cellIterator as $cell) {
				array_push($get, $cell->getValue()); 
			}
			
			
							$nama = $get[0]; 
							$nip = $get[1]; 
							$kelamin = $get[2];
							$alamat = $get[3];
							
							$username = $get[4]; 
							$password = $get[5]; 
		
			if(empty($nama) && empty($nim) && empty($kelamin) && empty($alamat) && empty($username) && empty($password))
				continue; 
			
			$sql->bindParam(':nama_dosen', $nama);
			$sql->bindParam(':nip', $nip);
			$sql->bindParam(':kelamin', $kelamin);
		    $sql->bindParam(':alamat', $alamat);
			$sql->bindParam(':username', $username);
			$sql->bindParam(':password', $password);
		    $sql->execute(); 
		}
		
		$numrow++; 
	}
}

header('location: home.php?page=data_dosen'); 
?>
