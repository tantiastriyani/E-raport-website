<?php
session_start();

require('fpdf17/fpdf.php');


include 'conn.php';

$id_dosen = $_SESSION['id_dosen'];
                    
$result=mysqli_query($koneksi,"SELECT * FROM tbl_nilai nilai, data_mahasiswa mahasiswa, setup_matkul matkul, setup_kelas kelas, tbl_tugas tugas, data_dosen dosen WHERE tugas.id_dosen=dosen.id_dosen and nilai.id_dosen=dosen.id_dosen and tugas.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_mahasiswa=mahasiswa.id_mahasiswa and nilai.id_kelas=kelas.id_kelas and nilai.id_matkul=matkul.id_matkul and nilai.id_dosen='$id_dosen' order by mahasiswa.nama_mahasiswa asc") or die(mysql_error());



    



$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Image('images/POLINDRA.png',3,3,28);
$pdf->Cell(270,7,'Laporan Penliaaan Mahasiswa',0,1,'C');
$pdf->Cell(190,7,'                                                                                                               _______________________________________________________________________________________________________',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(270,7,'Teknik Informatika Politeknik Negeri Indramayu',0,1,'C');



 

$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,6,'NAMA',1,0);
$pdf->Cell(20,6,'NIM',1,0);
$pdf->Cell(20,6,'KELAS',1,0);
$pdf->Cell(35,6,'MATKUL',1,0);
$pdf->Cell(25,6,'KEHADIRAN',1,0);
$pdf->Cell(20,6,'TUGAS',1,0);
$pdf->Cell(20,6,'PROJECT',1,0);
$pdf->Cell(20,6,'UTS',1,0);
$pdf->Cell(20,6,'UAS',1,0);
$pdf->Cell(20,6,'Akhir',1,1);
 
$pdf->SetFont('Arial','',10);
 


while ($row = mysqli_fetch_array($result)){


    $pdf->Cell(60,6,$row['nama_mahasiswa'],1,0);
    $pdf->Cell(20,6,$row['nim'],1,0);
    $pdf->Cell(20,6,$row['nama_kelas'],1,0);
     $pdf->Cell(35,6,$row['nama_matkul'],1,0);
    $pdf->Cell(25,6,$row['kehadiran'],1,0); 
    $pdf->Cell(20,6,(0.2*$row['tugas_1']) + (0.2*$row['tugas_2']) + (0.2*$row['tugas_3']) + (0.2*$row['tugas_4']) + (0.2*$row['tugas_5']),1,0);
    $pdf->Cell(20,6,$row['project'],1,0);
    $pdf->Cell(20,6,$row['uts'],1,0);
    $pdf->Cell(20,6,$row['uas'],1,0);
    $pdf->Cell(20,6,$total=(0.1*$row['kehadiran']) + (0.2*$row['tugas']) + (0.3*$row['project']) + (0.2*$row['uts']) + (0.2*$row['uas']),1,1);

                            
   
}

$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFillColor(255,255,255);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(40,8,'Ka. Jurusan Teknik Informatika,',0,0,'L',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(40,8,'A Sumarudin S.Pd,MT,M.Sc',0,0,'L',1);
$pdf->Ln();

$pdf->Cell(53,8,'NIP : 9098630',0,0,'L',1);
$pdf->Output();

?>