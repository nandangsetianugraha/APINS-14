<?php
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
use setasign\Fpdi\Fpdi;
require_once('fpdf/fpdf.php');
require_once('fpdi2/autoload.php');
include '../config/db_connect.php';
$idp=$_GET['idp'];
$sqls = "select * from siswa where peserta_didik_id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
if($siswa['jk']==='P'){
	$jk="Perempuan";
}else{
	$jk="Laki-laki";
};
//$usbn=$connect->query("select * from pesertaun where peserta_didik_id='$ids'")->fetch_assoc();
if(file_exists("../images/siswa/".$siswa['avatar'])){
		$gbr="../images/siswa/".$siswa['avatar'];
	}else{
	
	};
// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('kiss.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx,0,0,210);
// now write some text above the imported page
$pdf->SetFont('Times','',9);
//$pdf->SetTextColor(255, 0, 0);
//NOMOR PESERTA
$pdf->SetXY(38, 22.5);
$pdf->Write(0, $siswa['nisn']);
$pdf->SetXY(38, 26.5);
$pdf->Write(0, $siswa['nama']);
$pdf->SetXY(38, 31);
$pdf->Write(0, $siswa['tempat'].', '.TanggalIndo($siswa['tanggal']));
//sekolah asal
if($siswa['jk']=='L'){$jenis='Laki-laki';}else{$jenis='Perempuan';};
$pdf->SetXY(38, 35);
$pdf->Write(0, $jenis);
$pdf->SetXY(38, 37.5);
$pdf->MultiCell(48,3.4,$siswa['alamat'],0,'L');
$pdf->SetXY(38, 37.5);
$pdf->Image('../images/siswa/'.$siswa['avatar'], 16.5, 42.5,17,22.5);

//$pdf->Output();
$pdf->Output('F',$siswa['nisn'].'.pdf');