<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include "../modul/qrcode/phpqrcode/qrlib.php";
 include '../config/db_connect.php';
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
$idp=$_GET['idp'];
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$ab=substr($kelas, 0, 1);
$tapel=$_GET['tapel'];
$tahun1=substr($tapel,0,4);
$tahun2=substr($tapel,5,4);
if($smt==1){
	$smts="Ganjil";
}else{
	$smts="Genap";
};
$sqls = "select * from siswa where peserta_didik_id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
$namafilenya="Raport ".$siswa['nama']." Semester ".$smt." Tahun ".$tahun1."-".$tahun2.".pdf";
//$namafilenya=$tahun1.$tahun2.$smt."-".$siswa['nama'].".pdf";
 
 $pdf=new exFPDF('P','mm',array(210,297));
 
 //Halaman 1
 $pdf->AddPage(); 
 $pdf->SetFont('Arial','',12);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('','img:tutwuri.jpg,w35;align:C');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('RAPOR', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('PESERTA DIDIK', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('SEKOLAH DASAR', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('(SD)', 'align:C;');
 $table2->printRow(10);
 $tempdir = "../modul/qrcode/temp/";
 if (!file_exists($tempdir)){
	mkdir($tempdir);
 };
 $isi_teks = "https://sdi-aljannah.web.id/rapor/ikm/".$tahun1.$tahun2."/".$smt."/".$idp;
$namafile = $idp.".png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
$padding = 2;
QRcode::png($isi_teks,$namafile,QR_ECLEVEL_L,5,2);
//QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
$QR = imagecreatefrompng($namafile);
$logopng = imagecreatefrompng('../assets/'.$cfgs['image_login']);
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);
$logo_width = imagesx($logopng);
$logo_height = imagesy($logopng);
			
list($newwidth, $newheight) = getimagesize('../assets/'.$cfgs['image_login']);
$out = imagecreatetruecolor($QR_width, $QR_width);
imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
imagecopyresampled($out, $logopng, $QR_width/2.65, $QR_height/2.65, 0, 0, $QR_width/4, $QR_height/4, $newwidth, $newheight);
imagepng($out,$namafile);
imagedestroy($out);
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('','img:'.$namafile.',w35;align:C');
 $table2->printRow();
 $table2->endTable(60);
 
 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:12');
 $table2->easyCell('Nama Peserta Didik', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:16; font-style:B;border:1');
 $table2->easyCell($siswa['nama'], 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:12');
 $table2->easyCell('NIS', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:16; min-height:10;font-style:B;border:1');
 $table2->easyCell($siswa['nis'], 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:12');
 $table2->easyCell('NISN', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:16; min-height:10;font-style:B;border:1');
 $table2->easyCell($siswa['nisn'], 'align:C;');
 $table2->printRow();
 $table2->endTable(20);
 
 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:14; font-style:B;');
 $table2->easyCell('KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:14; font-style:B;');
 $table2->easyCell('REPUBLIK INDONESIA', 'align:C;');
 $table2->printRow();
 $table2->endTable();

 //$pdf->Output('D',$namafilenya);
 $pdf->Output();
 //$pdf->Output('F',$namafilenya);
