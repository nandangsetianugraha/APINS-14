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
include '../function/db_connect.php';
$idp=$_GET['idp'];
$sqls = "select * from siswa where id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
$ids=$siswa['peserta_didik_id'];
if($siswa['jk']==='P'){
	$jk="Perempuan";
}else{
	$jk="Laki-laki";
};
$usbn=$connect->query("select * from pesertaun where peserta_didik_id='$ids'")->fetch_assoc();
if(file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/1data/images/siswa/".$siswa['avatar'])){
		$gbr="../../images/siswa/".$siswa['avatar'];
	}else{
		if($siswa['jk']==='P'){
	       $gbr="../../images/wanita.png"; 
	    }else{
	       $gbr="../../images/laki.jpg";
	    };
	};
// initiate FPDI
$pdf = new Fpdi();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile('kartu.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx,0,0,200);

// now write some text above the imported page
$pdf->SetFont('Helvetica','',10);
//$pdf->SetTextColor(255, 0, 0);
//KOP Kartu 
$pdf->SetXY(35, 11);
$pdf->Write(0, 'KARTU PESERTA TRY OUT');
$pdf->SetXY(35, 16);
$pdf->Write(0, 'SD ISLAM AL-JANNAH');

$pdf->SetXY(133, 11);
$pdf->Write(0, 'KARTU PESERTA TRY OUT');
$pdf->SetXY(133, 16);
$pdf->Write(0, 'SD ISLAM AL-JANNAH');

$pdf->SetFont('Helvetica','',8);
//$pdf->SetTextColor(255, 0, 0);
//NOMOR PESERTA
$pdf->SetXY(37, 28);
$pdf->Write(0, $usbn['nopes']);
$pdf->SetXY(135, 28);
$pdf->Write(0, $usbn['nopes']);
//NAMA PESERTA
$pdf->SetXY(37, 32);
$pdf->Write(0, $siswa['nama']);
$pdf->SetXY(135, 32);
$pdf->Write(0, $siswa['nama']);
//TEMPAT PESERTA
$pdf->SetXY(37, 36);
$pdf->Write(0, $siswa['tempat'].', '.TanggalIndo($siswa['tanggal']));
$pdf->SetXY(135, 36);
$pdf->Write(0, $siswa['tempat'].', '.TanggalIndo($siswa['tanggal']));
//sekolah asal
$pdf->SetXY(37, 40);
$pdf->Write(0, 'SD ISLAM AL-JANNAH');
$pdf->SetXY(135, 40);
$pdf->Write(0, 'SD ISLAM AL-JANNAH');

$pdf->SetFont('Helvetica','',10);
//Titimangsan Kartu
$pdf->SetXY(54, 51.5);
$pdf->Write(0, '4 Maret 2019');
$pdf->SetXY(152, 51.5);
$pdf->Write(0, '4 Maret 2019');
$pdf->SetXY(38, 69);
$pdf->Write(0, 'UMAR ALI, BA.');
$pdf->SetXY(136, 69);
$pdf->Write(0, 'UMAR ALI, BA.');

$pdf->Output();