<?php 
require_once '../PHPExcel-1.8/Classes/PHPExcel.php';
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}

function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}

function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}

function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}

include "../conn.php";

$queabsdetail = "select * from data_dosen order by nama_dosen asc";
$exequeabsdetail = mysqli_query($koneksi, $queabsdetail);
while($res = mysqli_fetch_array($exequeabsdetail)){	
	
	$data['id_dosen'][] 	 = $res['id_dosen'];
	$data['nama_dosen'][] 	 = $res['nama_dosen'];
	$data['nip'][] 			 = $res['nip'];
	$data['kelamin'][] 		 = $res['kelamin'];
	$data['username'][] 	 = $res['username'];
	$data['password'][] 	 = $res['password'];
	
} 

$jm = sizeof($data['id_dosen']);
header("Pragma: public" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("Content-Type: application/force-download" );
header("Content-Type: application/octet-stream" );
header("Content-Type: application/download" );;
header("Content-Disposition: attachment;filename=Data_dosen.xls " );
header("Content-Transfer-Encoding: binary " );
xlsBOF();

xlsWriteLabel(0,3,"Data Dosen" );

xlsWriteLabel(2,0,"Nomor");
xlsWriteLabel(2,1,"Nama Dosen");
xlsWriteLabel(2,2,"NIP");
xlsWriteLabel(2,3,"Kelamin");
xlsWriteLabel(2,4,"Username");
xlsWriteLabel(2,5,"Password");
			

$xlsRow = 3;

for ($y=0; $y<$jm; $y++) {
	++$i;
	xlsWriteNumber($xlsRow,0,"$i" );
	
	xlsWriteLabel($xlsRow,1,$data['nama_dosen'][$y]);
	xlsWriteLabel($xlsRow,2,$data['nip'][$y]);
	xlsWriteLabel($xlsRow,3,$data['kelamin'][$y]);
	xlsWriteLabel($xlsRow,4,$data['username'][$y]);
	xlsWriteLabel($xlsRow,5,$data['password'][$y]);
	
	
	$xlsRow++;
}
xlsEOF();
exit();