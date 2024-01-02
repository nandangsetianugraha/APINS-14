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
$idp=$_GET['nisn'];
$sqls = "select * from siswa where nisn='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
if($siswa['jk']==='P'){
	$jk="Perempuan";
}else{
	$jk="Laki-laki";
};
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/images/siswa/".$siswa['avatar'])){
		$gbr="../images/siswa/".$siswa['avatar'];
	}else{
	    if($siswa['jk']==='P'){
	       $gbr="../images/wanita.png"; 
	    }else{
	       $gbr="../images/laki.jpg";
	    };
	};
// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('NISN.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx,0,0,200);

// now write some text above the imported page
$pdf->SetFont('Helvetica','',10);
//$pdf->SetTextColor(255, 0, 0);
//Nomor NISN
$pdf->SetXY(36, 9.5);
$pdf->Write(0, $siswa['nisn']);
//Nama
$pdf->SetXY(36, 14.5);
$pdf->Write(0, $siswa['nama']);
//Tempat Lahir
$pdf->SetXY(36, 19.5);
$pdf->Write(0, $siswa['tempat']);
//Tanggal Lahir
$pdf->SetXY(36, 24);
$pdf->Write(0, TanggalIndo($siswa['tanggal']));
//Alamat

if(empty($siswa['kecamatan']) || $siswa['kecamatan']==0){
   $pdf->SetXY(36, 29);
    $pdf->Write(0, ''); 
}else{
    $idkec= $siswa['kecamatan'];
    $kec= $connect->query("select * from kecamatan where id='$idkec'")->fetch_assoc();
    $pdf->SetXY(36, 29);
    $pdf->Write(0, $kec['nama']);
};

//Jenis Kelamin
$pdf->SetXY(36, 34);
$pdf->Write(0, $jk);
//Titimangsan Kartu
$pdf->SetXY(72, 38);
$pdf->Write(0, '16 Juli 2018');
$pdf->Image($gbr,12,40,26,26);

$pdf->Output();