<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include "../modul/qrcode/phpqrcode/qrlib.php";
 include '../function/db_connect.php';
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
$ab=(int)substr($kelas, 0, 1);
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
$namafilenya="Raport ".$siswa['nama']." - ".$tahun1."".$tahun2."-".$smts.".pdf";
 $pdf=new exFPDF();
 
 //Halaman 1
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

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
			$isi_teks = "https://sdi-aljannah.web.id/apins/cetak/cetakNilais.php?idp=".$idp."&kelas=".$kelas."&tapel=".$tapel."&smt=".$smt;
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
$id_kab=$siswa['kabupaten'];
$kab=$connect->query("select * from kabupaten where id='$id_kab'")->fetch_assoc();
$id_kec=$siswa['kecamatan'];
$kec=$connect->query("select * from kecamatan where id='$id_kec'")->fetch_assoc();
$id_desa=$siswa['kelurahan'];
$desa=$connect->query("select * from desa where id='$id_desa'")->fetch_assoc();

$pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

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
if($idpa==1){
  $table3->easyCell('','border:B;font-style:B');
}else{
 $table3->easyCell($peka['nama_pekerjaan'],'border:B;font-style:B');
}
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Ibu');
 $table3->easyCell(':');
 $table3->easyCell('');
 if($idpi==1){
  $table3->easyCell('','border:B;font-style:B');
}else{
 $table3->easyCell($peki['nama_pekerjaan'],'border:B;font-style:B');
}
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
 $table3->easyCell($desa['nama'],'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Kecamatan');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($kec['nama'],'border:B;font-style:B');
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
$rapo=new easyTable($pdf, '{15, 70, 25, 130}', 'border:1');
$rapo->rowStyle('font-size:14; font-style:B; bgcolor:#BEBEBE;min-height:19');
$rapo->easyCell('No','align:C; valign:M');
$rapo->easyCell('Muatan Pelajaran','align:C; valign:M');
$rapo->easyCell('Nilai Akhir','align:C; valign:M');
$rapo->easyCell('Catatan Kompetensi','align:C; valign:M');
$rapo->printRow(true);
//PAI
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
$rapo->rowStyle('font-size:12;min-height:25');
$rapo->easyCell('1','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//Pancasila
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
$rapo->rowStyle('font-size:12;min-height:25');
$rapo->easyCell('2','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//Bahasa Indonesia
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
$rapo->rowStyle('font-size:12;min-height:25');
$rapo->easyCell('3','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

//Matematika
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
$rapo->rowStyle('font-size:12;min-height:25');
$rapo->easyCell('4','align:C; valign:T');
$rapo->easyCell($mpl['nama_mapel'],'valign:T');
$rapo->easyCell($nilaipe,'align:C; valign:T');
$rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
$rapo->printRow();

if($ab>1){
  //IPAS
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('5','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //PJOK
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('6','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Seni Rupa
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('7','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Bahasa Inggris
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('8','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Bahasa Indramayu
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('9','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
}else{
  //PJOK
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('5','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Seni Rupa
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('6','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Bahasa Inggris
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('7','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
  
  //Bahasa Indramayu
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
  $rapo->rowStyle('font-size:12;min-height:25');
  $rapo->easyCell('8','align:C; valign:T');
  $rapo->easyCell($mpl['nama_mapel'],'valign:T');
  $rapo->easyCell($nilaipe,'align:C; valign:T');
  $rapo->easyCell($kelebihan."\n".$kelemahan,'valign:T');
  $rapo->printRow();
};
$rapo->endTable(5);

if($ab>1){
  //Ekstrakurikuler
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
          $eks->rowStyle('font-size:12; min-height:15');
          $eks->easyCell($nomor.'.');
          $eks->easyCell($neks['nama_ekskul']);
          $eks->easyCell($rowed['keterangan']);
          $eks->printRow();
          $nomor=$nomor+1;
      };
  };
  if($oke==0){
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('1.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('2.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('3.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('4.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  }elseif($oke==1){
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('2.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('3.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('4.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  }elseif($oke==2){
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('3.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('4.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  }else{
  $eks->rowStyle('font-size:12; min-height:15');
  $eks->easyCell('4.');
  $eks->easyCell('');
  $eks->easyCell('');
  $eks->printRow();
  };
  $eks->endTable(10);

  $pdf->AddPage(); 
  //Kesehatan
  $prokes=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
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
  $tbn->rowStyle('font-size:12; min-height:5');
  $tbn->easyCell('1.','align:L; valign:M');
  $tbn->easyCell('Tinggi Badan','align:L; valign:M');
  if($smt==1){
  $tbn->easyCell($prokes['tinggi']." cm",'align:C; valign:M');
  $tbn->easyCell('','align:C; valign:M');
  }else{
  $prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
  $prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
  $tbn->easyCell($prokes21['tinggi']." cm",'align:C; valign:M');
  $tbn->easyCell($prokes22['tinggi']." cm",'align:C; valign:M');
  };
  $tbn->printRow();

  //berat badan
  $tbn->rowStyle('font-size:12; min-height:5');
  $tbn->easyCell('2.','align:L; valign:M');
  $tbn->easyCell('Berat Badan','align:L; valign:M');
  if($smt==1){
  $tbn->easyCell($prokes['berat']." Kg",'align:C; valign:M');
  $tbn->easyCell('','align:C; valign:M');
  }else{
  $prokes21=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='1' and tapel='$tapel'")->fetch_assoc();
  $prokes22=$connect->query("select * from data_kesehatan where peserta_didik_id='$idp' and smt='2' and tapel='$tapel'")->fetch_assoc();
  $tbn->easyCell($prokes21['berat']." Kg",'align:C; valign:M');
  $tbn->easyCell($prokes22['berat']." Kg",'align:C; valign:M');
  };
  $tbn->printRow();

  //pendengaran 
  $tbn->rowStyle('font-size:12; min-height:5');
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
  $tbn->rowStyle('font-size:12; min-height:5');
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
  $tbn->rowStyle('font-size:12; min-height:5');
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
  $tbn->endTable(10);
};

//Saran
$adasaran=$connect->query("select * from saran where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
if($adasaran>0){
$sarane=$connect->query("select * from saran where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
$saranku=$sarane['saran'];
}else{
	$saranku="";
};
$srn=new easyTable($pdf, 1, 'border:1');
$srn->rowStyle('font-size:12; min-height:25');
$srn->easyCell("<b>Catatan Guru :</b>\n".$saranku);
$srn->printRow();
$srn->endTable(10);

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
	$hadir=new easyTable($pdf, '{50, 10, 20}', 'align:L');
	$hadir->rowStyle('font-size:12; min-height:7;font-style:B; bgcolor:#BEBEBE;border:1');
	$hadir->easyCell('Kehadiran','colspan:3;align:C');
	$hadir->printRow();
  	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Sakit','align:L;border:LBR');
	$hadir->easyCell($sakit,'align:C;border:B');
	$hadir->easyCell(' Hari','align:L;border:BR');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Ijin','align:L;border:LBR');
	$hadir->easyCell($ijin,'align:C;border:B');
	$hadir->easyCell(' Hari','align:L;border:BR');
	$hadir->printRow();
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Tanpa Keterangan','align:L;border:LBR');
	$hadir->easyCell($alfa,'align:C;border:B');
	$hadir->easyCell(' Hari','align:L;border:BR');
	$hadir->printRow();
}else{
	$hadir=new easyTable($pdf, '{50, 10, 20,10,100}', 'split-row:true; align:L');
  	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Kehadiran','colspan:3;align:C;bgcolor:#BEBEBE;border:LBTR;font-style:B');
  	$hadir->easyCell('','align:L');
  	if($ab==6){
		$hadir->easyCell("Keputusan:\nBerdasarkan Pencapaian seluruh Kompetensi,\npeserta didik dinyatakan:\n\nLulus/Tidak Lulus dari SD ......................................\n\n*) Coret yang tidak perlu.",'rowspan:4; align:L; valign:T;border:LTBR');
	}
	else{
		$hadir->easyCell("Keputusan:\nBerdasarkan Pencapaian seluruh Kompetensi,\npeserta didik dinyatakan:\n\nNaik/Tinggal*) Kelas ....... (............)\n\n*) Coret yang tidak perlu.",'rowspan:4; align:L; valign:T;border:LTBR');
	};
	$hadir->printRow();
  	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Sakit','align:L;border:LBR;valign:M');
	$hadir->easyCell($sakit,'align:C;border:B;valign:M');
	$hadir->easyCell(' Hari','align:L;border:BR;valign:M');
  	$hadir->easyCell('','align:L');
  	$hadir->printRow();
  
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Ijin','align:L;border:LBR;valign:M');
	$hadir->easyCell($ijin,'align:C;border:B;valign:M');
	$hadir->easyCell(' Hari','align:L;border:BR;valign:M');
  	$hadir->easyCell('','align:L');
	$hadir->printRow();
  
	$hadir->rowStyle('font-size:12; min-height:7');
	$hadir->easyCell('Tanpa Keterangan','align:L;border:LBR;valign:M');
	$hadir->easyCell($alfa,'align:C;border:B;valign:M');
	$hadir->easyCell(' Hari','align:L;border:BR;valign:M');
  	$hadir->easyCell('','align:L');
	$hadir->printRow();	
};
$hadir->endTable(10);

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
$ttd->endTable(5);

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
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
//Kepala Sekolah
$ks=$connect->query("select * from ptk where jenis_ptk_id='99'")->fetch_assoc();
if($ks['gelar']==' '){
	$namaks=strtoupper($ks['nama']);
}else{
	$namaks=strtoupper($ks['nama']).', '.$ks['gelar'];
};
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
$ttd1->endTable(5);

 $pdf->Output('D',$namafilenya);
 //$pdf->Output();
 //$pdf->Output('F','rapor-ikm.pdf');
