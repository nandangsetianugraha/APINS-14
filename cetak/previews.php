<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include "../modul/qrcode/phpqrcode/qrlib.php";
 include 'db_connect.php';
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
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel'")->fetch_assoc();
$namafilenya=$idp.".pdf";
 
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
 $isi_teks = "https://sdi-aljannah.web.id/rapor/".$tahun1.$tahun2.$smt."-".$idp.".pdf";
 $namafile = $idp.".png";
 $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
 $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
 $padding = 2;
 QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
 $table2->rowStyle('font-size:20; font-style:B;');
 $table2->easyCell('','img:../modul/qrcode/temp/'.$namafile.',w35;align:C');
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

//halaman 2
$id_prov=$siswa['provinsi'];
$id_kab=$siswa['kabupaten'];
$id_kec=$siswa['kecamatan'];
$id_des=$siswa['kelurahan'];
$prov=$connect->query("select * from provinsi where id_prov='$id_prov'")->fetch_assoc();
$kab=$connect->query("select * from kabupaten where id='$id_kab'")->fetch_assoc();
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
 $table3->easyCell('Indramayu','border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Provinsi');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell('Jawa Barat','border:B;font-style:B');
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
 $table3->easyCell("Gabuswetan, ..........................................\nKepala Sekolah\n\n\n\n\n\n<b>UMAR ALI, S.Pd.</b>\nNIP. .........................");
 $table3->printRow();
 $table3->endTable(15);

//halaman 3
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('LAPORAN HASIL BELAJAR (RAPOR)', 'align:C;');
 $table2->printRow();
 $table2->endTable(5);
 
 $table3=new easyTable($pdf, '{80, 8, 140, 70, 8, 60}','align:L');
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Peserta Didik');
 $table3->easyCell(':');
 $table3->easyCell($siswa['nama']);
 $table3->easyCell('Kelas');
 $table3->easyCell(':');
 $table3->easyCell($rombs['rombel']);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('NISN / NIS');
 $table3->easyCell(':');
 $table3->easyCell($siswa['nisn'].' / '.$siswa['nis']);
 $table3->easyCell('Fase');
 $table3->easyCell(':');
 if($ab==1 or $ab==2){
	 $vase="A";
 }elseif($ab==3 or $ab==4){
	 $vase="B";
 }else{
	 $vase="C";
 }
 $table3->easyCell($vase);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Sekolah');
 $table3->easyCell(':');
 $table3->easyCell('SD ISLAM AL-JANNAH');
 $table3->easyCell('Semester');
 $table3->easyCell(':');
 $table3->easyCell($smt);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat Sekolah');
 $table3->easyCell(':');
 $table3->easyCell('Jl. Raya Gabuswetan No. 1 Gabuswetan Indramayu');
 $table3->easyCell('Tahun Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($tapel);
 $table3->printRow();
 $table3->endTable(10);
 
//====================================================================
//Isi Raport
$pdf->SetFont('arial','',12);
$rapo=new easyTable($pdf, '{15, 70, 25, 130}', 'border:1');
$rapo->rowStyle('font-size:14; font-style:B; bgcolor:#BEBEBE;min-height:19');
$rapo->easyCell('No','align:C; valign:M');
$rapo->easyCell('Muatan Pelajaran','align:C; valign:M');
$rapo->easyCell('Nilai Akhir','align:C; valign:M');
$rapo->easyCell('Catatan Kompetensi','align:C; valign:M');
$rapo->printRow(true);
//mulai cetak PAI
$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='1'")->num_rows;
if($adape>0){
	$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='1'")->fetch_assoc();
	$nilaipe=number_format($npe['nilai'],0);
	$data = explode("|" , $npe['deskripsi']);
	$kelebihan=$data[0];
	$kelemahan=$data[1];
	$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe="";
	$kelebihan="";
	$kelemahan="";
};
$mpl=$connect->query("select * from mata_pelajaran where id_mapel='1'")->fetch_assoc();
$rapo->rowStyle('font-size:12;min-height:30');
$rapo->easyCell('1','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//mulai cetak Pendidikan Pancasila
$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='2'")->num_rows;
if($adape>0){
	$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='2'")->fetch_assoc();
	$nilaipe=number_format($npe['nilai'],0);
	$data = explode("|" , $npe['deskripsi']);
	$kelebihan=$data[0];
	$kelemahan=$data[1];
	$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe="";
	$kelebihan="";
	$kelemahan="";
};
$mpl=$connect->query("select * from mata_pelajaran where id_mapel='2'")->fetch_assoc();
$rapo->rowStyle('font-size:12;min-height:30');
$rapo->easyCell('2','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//mulai cetak Bahasa Indonesia
$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='3'")->num_rows;
if($adape>0){
	$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='3'")->fetch_assoc();
	$nilaipe=number_format($npe['nilai'],0);
	$data = explode("|" , $npe['deskripsi']);
	$kelebihan=$data[0];
	$kelemahan=$data[1];
	$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe="";
	$kelebihan="";
	$kelemahan="";
};
$mpl=$connect->query("select * from mata_pelajaran where id_mapel='3'")->fetch_assoc();
$rapo->rowStyle('font-size:12;min-height:30');
$rapo->easyCell('3','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//mulai cetak Matematika
$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='4'")->num_rows;
if($adape>0){
	$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='4'")->fetch_assoc();
	$nilaipe=number_format($npe['nilai'],0);
	$data = explode("|" , $npe['deskripsi']);
	$kelebihan=$data[0];
	$kelemahan=$data[1];
	$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe="";
	$kelebihan="";
	$kelemahan="";
};
$mpl=$connect->query("select * from mata_pelajaran where id_mapel='4'")->fetch_assoc();
$rapo->rowStyle('font-size:12;min-height:30');
$rapo->easyCell('4','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

if($ab>1){
	//mulai cetak IPAS
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='5'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='5'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='5'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('5','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();
	
	//mulai cetak PJOK
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='6'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('6','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();


	//mulai cetak Seni Rupa
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='7'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('7','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();

	//mulai cetak Bahasa Inggris
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='8'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('8','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();

	//mulai cetak Bahasa Indramayu
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='9'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('9','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();

}else{

	//mulai cetak PJOK
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='6'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('5','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();


	//mulai cetak Seni Rupa
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='7'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('6','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();


	//mulai cetak Bahasa Inggris
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='8'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('7','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();


	//mulai cetak Bahasa Indramayu
	$adape=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->num_rows;
	if($adape>0){
		$npe=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->fetch_assoc();
		$nilaipe=number_format($npe['nilai'],0);
		$data = explode("|" , $npe['deskripsi']);
		$kelebihan=$data[0];
		$kelemahan=$data[1];
		$deskripsi1=$npe['deskripsi'];
	}else{
		$nilaipe="";
		$kelebihan="";
		$kelemahan="";
	};
	$mpl=$connect->query("select * from mata_pelajaran where id_mapel='9'")->fetch_assoc();
	$rapo->rowStyle('font-size:12;min-height:30');
	$rapo->easyCell('8','align:C; valign:T');
	$rapo->easyCell($mpl['nama_mapel'],'valign:T');
	$rapo->easyCell($nilaipe,'align:C; valign:T');
	$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
	$rapo->printRow();

};

//akhir tabel rapor
$rapo->endTable(5);

//Ekstrakurikuler
$table6=new easyTable($pdf, '{8,100}', 'align:L');
$table6->rowStyle('font-size:12; font-style:B;');
$table6->easyCell('B.');
$table6->easyCell('Ekstra Kurikuler');
$table6->printRow();
$table6->endTable();

$eks=new easyTable($pdf, '{20, 100, 200}', 'border:1');
$eks->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:10');
$eks->easyCell('No.','align:C; valign:M');
$eks->easyCell('Kegiatan Ekstrakurikuler','align:C; valign:M');
$eks->easyCell('Keterangan','align:C; valign:M');
$eks->printRow();
$ekstra = "select * from data_ekskul where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel' order by id_ekskul asc";
$queryed = $connect->query($ekstra);
$oke = $queryed->num_rows;
if($oke>0){
	$nomor=1;
	while ($rowed = $queryed->fetch_assoc()) {
		$idekskul=$rowed['id_ekskul'];
		$neks=$connect->query("select * from ekskul where id_ekskul='$idekskul'")->fetch_assoc();
		$eks->rowStyle('font-size:12; min-height:20');
		$eks->easyCell($nomor.'.');
		$eks->easyCell($neks['nama_ekskul']);
		$eks->easyCell($rowed['keterangan'],'align:L; valign:T');
		$eks->printRow();
		$nomor=$nomor+1;
	};
};
if($oke==0){
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('1.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('2.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('3.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
}elseif($oke==1){
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('2.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('3.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
}else{
$eks->rowStyle('font-size:12; min-height:20');
$eks->easyCell('3.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
};
$eks->endTable(5);

$pdf->AddPage(); 
//Saran
$adasaran=$connect->query("select * from saran where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
if($adasaran>0){
$sarane=$connect->query("select * from saran where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
$saranku=$sarane['saran'];
}else{
	$saranku="";
};
$table7=new easyTable($pdf, '{8,100}', 'align:L');
$table7->rowStyle('font-size:12; font-style:B;');
$table7->easyCell('C.');
$table7->easyCell('Catatan Guru');
$table7->printRow();
$table7->endTable();
$srn=new easyTable($pdf, 1, 'border:1');
$srn->rowStyle('font-size:12; min-height:30');
$srn->easyCell($saranku);
$srn->printRow();
$srn->endTable(5);

//Tinggi Berat Badan
$adatb1=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->num_rows;
$adatb2=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->num_rows;
if($adatb1>0){
$tbb1=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
if($tbb1['tinggi']=='0'){
	$tinggi1="";
}else{
	$tinggi1=$tbb1['tinggi']." cm";
};
if($tbb1['berat']=='0'){
	$berat1="";
}else{
	$berat1=$tbb1['berat']." Kg";
};
$keslain=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$pendengaran1=$keslain['pendengaran'];
$penglihatan1=$keslain['penglihatan'];
$gigi1=$keslain['gigi'];
$lainnya1=$keslain['lainnya'];
}else{
	$tinggi1="";
	$berat1="";
	$pendengaran1="";
	$penglihatan1="";
	$gigi1="";
	$lainnya1="";
};
if($adatb2>0){
$tbb2=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
if($tbb2['tinggi']=='0'){
	$tinggi2="";
}else{
	$tinggi2=$tbb2['tinggi']." cm";
};
if($tbb2['berat']=='0'){
	$berat2="";
}else{
	$berat2=$tbb2['berat']." Kg";
};
$keslain2=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$pendengaran2=$keslain2['pendengaran'];
$penglihatan2=$keslain2['penglihatan'];
$gigi2=$keslain2['gigi'];
$lainnya2=$keslain2['lainnya'];
}else{
	$tinggi2="";
	$berat2="";
	$pendengaran2="";
	$penglihatan2="";
	$gigi2="";
	$lainnya2="";
};
//$tbb2=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$prokes=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
$table8=new easyTable($pdf, '{8,100}', 'align:L');
$table8->rowStyle('font-size:12; font-style:B;');
$table8->easyCell('D.');
$table8->easyCell('Tinggi dan Berat Badan');
$table8->printRow();
$table8->endTable();
$tbn=new easyTable($pdf, '{20, 100, 50, 50}', 'border:1');
$tbn->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$tbn->easyCell('No.','rowspan:2;align:C; valign:M');
$tbn->easyCell('Aspek yang Dinilai','rowspan:2;align:C; valign:M');
$tbn->easyCell('Semester','colspan:2; align:C; valign:M');
$tbn->printRow();

$tbn->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$tbn->easyCell('1','align:C; valign:M');
$tbn->easyCell('2','align:C; valign:M');
$tbn->printRow(true);

//tinggi badan
$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('1.','align:L; valign:M');
$tbn->easyCell('Tinggi Badan','align:L; valign:M');
if($smt==1){
$tbn->easyCell($prokes['tinggi'],'align:C; valign:M');
$tbn->easyCell('','align:C; valign:M');
}else{
$prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$tbn->easyCell($prokes21['tinggi'],'align:C; valign:M');
$tbn->easyCell($prokes22['tinggi'],'align:C; valign:M');
};
$tbn->printRow();

//berat badan
$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('2.','align:L; valign:M');
$tbn->easyCell('Berat Badan','align:L; valign:M');
if($smt==1){
$tbn->easyCell($prokes['berat'],'align:C; valign:M');
$tbn->easyCell('','align:C; valign:M');
}else{
$prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$tbn->easyCell($prokes21['berat'],'align:C; valign:M');
$tbn->easyCell($prokes22['berat'],'align:C; valign:M');
};
$tbn->printRow();

//pendengaran 
$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('3.','align:L; valign:M');
$tbn->easyCell('Pendengaran','align:L; valign:M');
if($smt==1){
$tbn->easyCell($prokes['pendengaran'],'align:C; valign:M');
$tbn->easyCell('','align:C; valign:M');
}else{
$prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$tbn->easyCell($prokes21['pendengaran'],'align:C; valign:M');
$tbn->easyCell($prokes22['pendengaran'],'align:C; valign:M');
};
$tbn->printRow();

//penglihatan 
$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('4.','align:L; valign:M');
$tbn->easyCell('Penglihatan','align:L; valign:M');
if($smt==1){
$tbn->easyCell($prokes['penglihatan'],'align:C; valign:M');
$tbn->easyCell('','align:C; valign:M');
}else{
$prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$tbn->easyCell($prokes21['penglihatan'],'align:C; valign:M');
$tbn->easyCell($prokes22['penglihatan'],'align:C; valign:M');
};
$tbn->printRow();

//Gigi
$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('5.','align:L; valign:M');
$tbn->easyCell('Gigi','align:L; valign:M');
if($smt==1){
$tbn->easyCell($prokes['gigi'],'align:C; valign:M');
$tbn->easyCell('','align:C; valign:M');
}else{
$prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
$prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
$tbn->easyCell($prokes21['gigi'],'align:C; valign:M');
$tbn->easyCell($prokes22['gigi'],'align:C; valign:M');
};
$tbn->printRow();
$tbn->endTable(5);

//absensi
$adaabsen=$connect->query("select * from data_absensi where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
if($adaabsen>0){
	$absensi=$connect->query("select * from data_absensi where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
	$sakit=$absensi['sakit'];
	$ijin=$absensi['ijin'];
	$alfa=$absensi['alfa'];
}else{
	$sakit=' ';
	$ijin=' ';
	$alfa=' ';
};
if($smt==1){
	//Absensi
	$table11=new easyTable($pdf, '{8,100}', 'align:L');
	$table11->rowStyle('font-size:12; font-style:B;');
	$table11->easyCell('E.');
	$table11->easyCell('Ketidakhadiran');
	$table11->printRow();
	$table11->endTable();
	$hadir=new easyTable($pdf, '{50, 10, 20}', 'align:L');
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Sakit','align:L');
	$hadir->easyCell(':','align:L');
	$hadir->easyCell($sakit.' Hari','align:L');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Ijin','align:L');
	$hadir->easyCell(':','align:L');
	$hadir->easyCell($ijin.' Hari','align:L');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Tanpa Keterangan','align:L');
	$hadir->easyCell(':','align:L');
	$hadir->easyCell($alfa.' Hari','align:L');
	$hadir->printRow();
	$hadir->endTable(5);
}else{
	//Absensi
	$table11=new easyTable($pdf, '{8,100}', 'align:L');
	$table11->rowStyle('font-size:12; font-style:B;');
	$table11->easyCell('E.');
	$table11->easyCell('Ketidakhadiran');
	$table11->printRow();
	$table11->endTable();
	$hadir=new easyTable($pdf, '{50, 10, 20, 100}', 'split-row:true; align:L; border:1');
	$hadir->easyCell('Sakit','align:L; border:0;');
	$hadir->easyCell(':','align:L; border:0;');
	$hadir->easyCell($sakit.' Hari','align:L; border:0;');
	if($ab==6){
		$hadir->easyCell("Keputusan:\nBerdasarkan Pencapaian seluruh Kompetensi,\npeserta didik dinyatakan:\n\nLulus/Tidak Lulus dari SD ......................................\n\n*) Coret yang tidak perlu.",'rowspan:5; align:L; valign:T');
	}
	else{
		$hadir->easyCell("Keputusan:\nBerdasarkan Pencapaian seluruh Kompetensi,\npeserta didik dinyatakan:\n\nNaik/Tinggal*) Kelas ....... (............)\n\n*) Coret yang tidak perlu.",'rowspan:5; align:L; valign:T');
	};
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Ijin','align:L; border:0;');
	$hadir->easyCell(':','align:L; border:0;');
	$hadir->easyCell($ijin.' Hari','align:L; border:0;');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Tanpa Keterangan','align:L; border:0;');
	$hadir->easyCell(':','align:L; border:0;');
	$hadir->easyCell($alfa.' Hari','align:L; border:0;');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->easyCell('','align:L; border:0;');
	$hadir->printRow();
	$hadir->endTable(5);	
};
//TTD
$ttd=new easyTable($pdf, '{10,60,30,80,10}');
$ttd->rowStyle('font-size:12');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('Mengetahui:','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$cektmr=$connect->query("select * from titimangsa where smt='$smt' and tapel='$tapel'")->num_rows;
if($cektmr>0){
	$tmr=$connect->query("select * from titimangsa where smt='$smt' and tapel='$tapel'")->fetch_assoc();
    if($ab===6){
      $ttd->easyCell('Gabuswetan, '.TanggalIndo($tmr['tanggal2']),'align:C; border:0;');
    }else{
	  $ttd->easyCell('Gabuswetan, '.TanggalIndo($tmr['tanggal']),'align:C; border:0;');
    }
}else{
	$ttd->easyCell('Gabuswetan, ........................ 20.....','align:C; border:0;');
};
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('Orang Tua / Wali,','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('Guru Kelas,','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$nromb=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
$idwks=$nromb['wali_kelas'];
$wks=$connect->query("select * from ptk where ptk_id='$idwks'")->fetch_assoc();
if($wks['gelar']==''){
	$namawali=strtoupper($wks['nama']);
}else{
	$namawali=strtoupper($wks['nama']).', '.$wks['gelar'];
};
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:B;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('<b>'.$namawali.'</b>','align:C; border:B;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('NIP.','align:L; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->endTable();

$ttd1=new easyTable($pdf, '{50,70,50}');
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('Mengetahui:','align:C; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('Kepala Sekolah,','align:C; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
//Kepala Sekolah
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell("<b>".$namaks."</b>",'align:C; border:B;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('NIP. -','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->endTable();


 $pdf->Output('F',$namafilenya);
 //$pdf->Output();
 //$pdf->Output('F',$namafilenya);
