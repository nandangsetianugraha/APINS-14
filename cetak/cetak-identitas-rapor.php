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
 



//halaman 2
$id_prov=$siswa['provinsi'];
$id_kab=$siswa['kabupaten'];
$id_kec=$siswa['kecamatan'];
$id_des=$siswa['kelurahan'];
$prov=$connect->query("select * from provinsi where id_prov='$id_prov'")->fetch_assoc();
$nprov=$prov['nama'];
$kab=$connect->query("select * from kabupaten where id='$id_kab'")->fetch_assoc();
$nkab=$kab['nama'];
$kec=$connect->query("select * from kecamatan where id='$id_kec'")->fetch_assoc();
$nkec=$kec['nama'];
$des=$connect->query("select * from desa where id='$id_des'")->fetch_assoc();
$ndes=$des['nama'];

 $pdf->AddPage(); 
 $pdf->AddFont('lato','','Lato-Regular.php');
 $pdf->AddFont('FontUTF8','','Arimo-Regular.php'); 
 $pdf->AddFont('FontUTF8','B','Arimo-Bold.php'); 
 $pdf->AddFont('FontUTF8','BI','Arimo-BoldItalic.php'); 
 $pdf->AddFont('FontUTF8','I','Arimo-Italic.php'); 
 $pdf->SetFont('times','',12);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('IDENTITAS PESERTA DIDIK', 'align:C;');
 $table2->printRow();
 $table2->endTable(10);
 
 $table3=new easyTable($pdf, '{60, 8, 1, 110}','align:L');
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Peserta Didik');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['nama'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('NIS');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['nis'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('NISN');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['nisn'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Tempat, Tanggal Lahir');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['tempat'].', '.TanggalIndo($siswa['tanggal']),'border:B;font-style:B');
 $table3->printRow();
 
 if($siswa['jk']==="L"){
	 $kelam="Laki-laki";
 }else{
	 $kelam="Perempuan";
 };
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Jenis Kelamin');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($kelam,'border:B;font-style:B');
 $table3->printRow();
 
 $idag=$siswa['agama'];
 $pag=$connect->query("select * from agama where id_agama='$idag'")->fetch_assoc();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Agama');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($pag['nama_agama'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Pendidikan Sebelumnya');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['pend_sebelum'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat Peserta Didik');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['alamat'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('.');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('','border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Orang Tua');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Ayah');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['nama_ayah'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Ibu');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['nama_ibu'],'border:B;font-style:B');
 $table3->printRow();
 
 $idpa=$siswa['pek_ayah'];
 $peka=$connect->query("select * from pekerjaan where id_pekerjaan='$idpa'")->fetch_assoc();
 $idpi=$siswa['pek_ibu'];
 $peki=$connect->query("select * from pekerjaan where id_pekerjaan='$idpi'")->fetch_assoc();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Pekerjaan Orang Tua');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Ayah');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($peka['nama_pekerjaan'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Ibu');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($peki['nama_pekerjaan'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat Orang Tua');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Jalan');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($siswa['jalan'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Kelurahan/Desa');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($ndes,'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Kecamatan');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($nkec,'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Kabupaten/Kota');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($nkab,'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Provinsi');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($nprov,'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Wali Peserta Didik');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell('','border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Pekerjaan');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell('','border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell('','border:B;font-style:B');
 $table3->printRow();
 $table3->endTable(15);
 $ks=$connect->query("select * from ptk where jenis_ptk_id='99'")->fetch_assoc();
if($ks['gelar']==' '){
	$namaks=strtoupper($ks['nama']);
}else{
	$namaks=strtoupper($ks['nama']).', '.$ks['gelar'];
};
 $table3=new easyTable($pdf, '{10, 30, 20, 8, 1, 110}','align:L');
 $table3->rowStyle('font-size:12;min-height:40');
 $table3->easyCell('');
 $table3->easyCell("Pas Foto\nUkuran\n3x4",'border:1;align:C;valign:M;font-style:B');
 $table3->easyCell('');
 $table3->easyCell('');
 $table3->easyCell('');
 $ttm=$connect->query("select * from titimangsa where smt='$smt' and tapel='$tapel'")->fetch_assoc();
 $table3->easyCell($ttm['tempat'].", ..........................................\nKepala Sekolah\n\n\n\n\n\n<b>".$namaks."</b>\nNIP. .........................");
 $table3->printRow();
 $table3->endTable(15);



 //$pdf->Output('D',$namafilenya);
 $pdf->Output();
 //$pdf->Output('F',$namafilenya);
