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
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel'")->fetch_assoc();
$namafilenya=$siswa['peserta_didik_id'].".pdf";
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
			$isi_teks = "https://apins.sdi-aljannah.web.id/cetak/raport.php?idp=".$idp."&kelas=".$kelas."&tapel=".$tapel."&smt=".$smt;
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
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/$id_kab/kecamatan",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
));
$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
for ($i=0; $i < count($data['kecamatans']); $i++) {
	if($siswa['kecamatan']==$data['kecamatans'][$i]['id']){ 
		$namakec=$data['kecamatans'][$i]['nama'];
	}
};

$id_kec=$siswa['kecamatan'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/$id_kec/desa",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
));
$response = curl_exec($curl);
$err = curl_error($curl);
$data = json_decode($response, true);
for ($i=0; $i < count($data['desas']); $i++) {
	if($siswa['kelurahan']==$data['desas'][$i]['id']){ 
		$namadesa=$data['desas'][$i]['nama'];
	}
};



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
 $table3->easyCell($namadesa,'border:B;font-style:B');
 $table3->printRow();
 
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Kecamatan');
 $table3->easyCell(':');
 $table3->easyCell('');
 $table3->easyCell($namakec,'border:B;font-style:B');
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

 

//halaman 3
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('RAPOR PESERTA DIDIK DAN PROFIL PESERTA DIDIK', 'align:C;');
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
 $table3->easyCell('NISN/NIS');
 $table3->easyCell(':');
 $table3->easyCell($siswa['nisn'].'/'.$siswa['nis']);
 $table3->easyCell('Semester');
 $table3->easyCell(':');
 $table3->easyCell($smt);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Sekolah');
 $table3->easyCell(':');
 $table3->easyCell('SD ISLAM AL-JANNAH');
 $table3->easyCell('Tahun Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($tapel);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat Sekolah');
 $table3->easyCell(':');
 $table3->easyCell('Jl. Raya Gabuswetan No. 1 Gabuswetan Indramayu','colspan:4');
 $table3->printRow();
 $table3->endTable(10);
 
//====================================================================
$table4=new easyTable($pdf, '{8,100}', 'align:L');
$table4->rowStyle('font-size:12; font-style:B;');
$table4->easyCell('A.');
$table4->easyCell('Sikap');
$table4->printRow();
$table4->endTable(3);

// Sikap spiritual
$adasp=$connect->query("select * from deskripsi_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k1'")->num_rows;
if($adasp>0){
$nsp=$connect->query("select * from deskripsi_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k1'")->fetch_assoc();
$nilaisp=$nsp['deskripsi'];
}else{
	$nilaisp="";
};
$adaso=$connect->query("select * from deskripsi_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k2'")->num_rows;
if($adaso>0){
$nso=$connect->query("select * from deskripsi_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k2'")->fetch_assoc();
$nilaiso=$nso['deskripsi'];
}else{
	$nilaiso="";
};
$sikap=new easyTable($pdf,'{60,150}', 'border:1');
$sikap->rowStyle('font-size:14; font-style:B; bgcolor:#BEBEBE');
$sikap->easyCell('Deskripsi','colspan:2; align:C');
$sikap->printRow();
$sikap->rowStyle('font-size:12; min-height:35');
$sikap->easyCell("1. Sikap Spiritual",'valign:T');
$sikap->easyCell($nilaisp,'valign:T');
$sikap->printRow();
$sikap->rowStyle('font-size:12; min-height:35');
$sikap->easyCell("2. Sikap Sosial",'valign:T');
$sikap->easyCell($nilaiso,'valign:T');
$sikap->printRow();
$sikap->endTable(10);

//Isi KKM
$kkm=$connect->query("select min(nilai) as kkmsekolah from kkm where tapel='$tapel'")->fetch_assoc();
if(empty($kkm['kkmsekolah'])){
	$kkmsaya=0;
}else{
	$kkmsaya=$kkm['kkmsekolah'];
};
$table5=new easyTable($pdf, '{8,100}', 'align:L');
$table5->rowStyle('font-size:12; font-style:B;');
$table5->easyCell('B.');
$table5->easyCell('Pengetahuan dan Ketrampilan');
$table5->printRow();
$table5->easyCell(' ');
$table5->easyCell('KKM Satuan Pendidikan : '.$kkmsaya);
$table5->printRow();
$table5->endTable(3);
//Isi Raport
$rapo=new easyTable($pdf, '{10, 50, 15, 15, 60, 15, 15, 60}', 'border:1');
$rapo->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE');
$rapo->easyCell('No','rowspan:2; align:C; valign:M');
$rapo->easyCell('Muatan Pelajaran','rowspan:2; align:C; valign:M');
$rapo->easyCell('Pengetahuan','colspan:3; align:C; valign:M');
$rapo->easyCell('Ketrampilan','colspan:3; align:C; valign:M');
$rapo->printRow();
$rapo->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE');
$rapo->easyCell('Nilai','align:C; valign:M');
$rapo->easyCell('Pred','align:C; valign:M');
$rapo->easyCell('Deskripsi','align:C; valign:M');
$rapo->easyCell('Nilai','align:C; valign:M');
$rapo->easyCell('Pred','align:C; valign:M');
$rapo->easyCell('Deskripsi','align:C; valign:M');
$rapo->printRow(true);
//mulai cetak PAI
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='1' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};
$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('1','align:C; valign:T');
$rapo->easyCell('Pendidikan Agama dan Budi Pekerti','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();

//mulai cetak PKn
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='2' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('2','align:C; valign:T');
$rapo->easyCell('Pendidikan Pancasila dan Kewarganegaraan','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();

//mulai cetak Bahasa Indonesia
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='3' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};
$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('3','align:C; valign:T');
$rapo->easyCell('Bahasa Indonesia','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();

//mulai cetak Matematika
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='4' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('4','align:C; valign:T');
$rapo->easyCell('Matematika','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();

if($ab>3){
	//mulai cetak IPA
	$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='k3'")->num_rows;
	if($adape>0){
	$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='k3'")->fetch_assoc();
	$nilaipe=$npe['nilai'];
	$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
	};
	$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='k4'")->num_rows;
	if($adake>0){
	$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='5' and jns='k4'")->fetch_assoc();
	$nilaike=$nke['nilai'];
	$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
	};
	$rapo->rowStyle('font-size:10; min-height:75');
	$rapo->easyCell('5','align:C; valign:T');
	$rapo->easyCell('Ilmu Pengetahuan Alam','valign:T');
	$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
	$rapo->easyCell($predikat1,'align:C; valign:T');
	$rapo->easyCell($deskripsi1,'valign:T');
	$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
	$rapo->easyCell($predikat,'align:C; valign:T');
	$rapo->easyCell($deskripsi,'valign:T');
	$rapo->printRow();
	//mulai cetak IPS
	$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='k3'")->num_rows;
	if($adape>0){
	$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='k3'")->fetch_assoc();
	$nilaipe=$npe['nilai'];
	$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
	};
	$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='k4'")->num_rows;
	if($adake>0){
	$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='6' and jns='k4'")->fetch_assoc();
	$nilaike=$nke['nilai'];
	$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
	};
	$rapo->rowStyle('font-size:10; min-height:75');
	$rapo->easyCell('6','align:C; valign:T');
	$rapo->easyCell('Ilmu Pengetahuan Sosial','valign:T');
	$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
	$rapo->easyCell($predikat1,'align:C; valign:T');
	$rapo->easyCell($deskripsi1,'valign:T');
	$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
	$rapo->easyCell($predikat,'align:C; valign:T');
	$rapo->easyCell($deskripsi,'valign:T');
	$rapo->printRow();
};
//mulai cetak SBK
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='7' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
if($ab>3){
	$rapo->easyCell('7','align:C; valign:T');
}else{
	$rapo->easyCell('5','align:C; valign:T');
};
$rapo->easyCell('Seni Budaya dan Prakarya','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();	
//mulai cetak PJOK
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='8' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
if($ab>3){
	$rapo->easyCell('8','align:C; valign:T');
}else{
	$rapo->easyCell('6','align:C; valign:T');
};
$rapo->easyCell('Pendidikan Jasmani, Olahraga dan Kesehatan','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();
//MULOK
$rapo->rowStyle('font-size:10');
if($ab>3){
	$rapo->easyCell('9','align:C; valign:T');
}else{
	$rapo->easyCell('7','align:C; valign:T');
};
$rapo->easyCell('Muatan Lokal','colspan:7; valign:T');
$rapo->printRow();

//mulai cetak Pendidikan Budi Pekerti
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='11' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('','align:C; valign:T');
$rapo->easyCell('a. Pendidikan Budi Pekerti','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();
//mulai cetak Bahasa Indramayu
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='9' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('','align:C; valign:T');
$rapo->easyCell('b. Bahasa Indramayu','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();
//mulai cetak Bahasa Inggris
$adape=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='k3'")->num_rows;
if($adape>0){
$npe=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='k3'")->fetch_assoc();
$nilaipe=$npe['nilai'];
$predikat1=$npe['predikat'];
$deskripsi1=$npe['deskripsi'];
}else{
	$nilaipe=0;
	$predikat1="";
	$deskripsi1="";
};
$adake=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='k4'")->num_rows;
if($adake>0){
$nke=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='10' and jns='k4'")->fetch_assoc();
$nilaike=$nke['nilai'];
$predikat=$nke['predikat'];
$deskripsi=$nke['deskripsi'];
}else{
	$nilaike=0;
	$predikat="";
	$deskripsi="";
};$rapo->rowStyle('font-size:10; min-height:75');
$rapo->easyCell('','align:C; valign:T');
$rapo->easyCell('c. Bahasa Inggris','valign:T');
$rapo->easyCell(number_format($nilaipe,0),'align:C; valign:T');
$rapo->easyCell($predikat1,'align:C; valign:T');
$rapo->easyCell($deskripsi1,'valign:T');
$rapo->easyCell(number_format($nilaike,0),'align:C; valign:T');
$rapo->easyCell($predikat,'align:C; valign:T');
$rapo->easyCell($deskripsi,'valign:T');
$rapo->printRow();
$rapo->endTable(5);

$pdf->AddPage();
//Ekstrakurikuler
$table6=new easyTable($pdf, '{8,100}', 'align:L');
$table6->rowStyle('font-size:12; font-style:B;');
$table6->easyCell('C.');
$table6->easyCell('Ekstra Kurikuler');
$table6->printRow();
$table6->endTable(3);

$eks=new easyTable($pdf, '{20, 100, 200}', 'border:1');
$eks->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:10');
$eks->easyCell('No.','align:C; valign:M');
$eks->easyCell('Kegiatan Ekstrakurikuler','align:C; valign:M');
$eks->easyCell('Keterangan','align:C; valign:M');
$eks->printRow();
$eks->rowStyle('font-size:12; min-height:15');
$cekrow = $connect->query("select * from data_ekskul where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel' and id_ekskul=1")->num_rows;
if($cekrow>0){
	$rowed = $connect->query("select * from data_ekskul where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel' and id_ekskul=1")->fetch_assoc();
	$pramu=$rowed['keterangan'];
}else{
	$pramu="";
};
$eks->easyCell('1.');
$eks->easyCell('Praja Muda Karana (Pramuka)');
$eks->easyCell($pramu);
$eks->printRow();
$ekstra = "select * from data_ekskul where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel' and id_ekskul!=1 order by id_ekskul asc";
$queryed = $connect->query($ekstra);
$oke = $queryed->num_rows;
if($oke>0){
	$nomor=2;
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
$eks->easyCell('4.');
$eks->easyCell('');
$eks->easyCell('');
$eks->printRow();
}else{
};
$eks->endTable();

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
$table7->easyCell('D.');
$table7->easyCell('Saran-saran');
$table7->printRow();
$table7->endTable(3);
$srn=new easyTable($pdf, 1, 'border:1');
$srn->rowStyle('font-size:12; min-height:35');
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
	$tinggi1=$tbb1['tinggi'];
};
if($tbb1['berat']=='0'){
	$berat1="";
}else{
	$berat1=$tbb1['berat'];
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
	$tinggi2=$tbb2['tinggi'];
};
if($tbb2['berat']=='0'){
	$berat2="";
}else{
	$berat2=$tbb2['berat'];
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
$table8->easyCell('E.');
$table8->easyCell('Tinggi dan Berat Badan');
$table8->printRow();
$table8->endTable(3);
$tbn=new easyTable($pdf, '{20, 100, 50, 50}', 'border:1');
$tbn->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$tbn->easyCell('No.','rowspan:2;align:C; valign:M');
$tbn->easyCell('Aspek yang Dinilai','rowspan:2;align:C; valign:M');
$tbn->easyCell('Semester','colspan:2; align:C; valign:M');
$tbn->printRow();

$tbn->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$tbn->easyCell('1','align:C; valign:M');
$tbn->easyCell('2','align:C; valign:M');
$tbn->printRow();

$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('1.','align:L; valign:T');
$tbn->easyCell('Tinggi Badan','align:L; valign:T');
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

$tbn->rowStyle('font-size:12; min-height:10');
$tbn->easyCell('2.','align:L; valign:T');
$tbn->easyCell('Berat Badan','align:L; valign:T');
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
$tbn->endTable(5);
//Kesehatan
$table9=new easyTable($pdf, '{8,100}', 'align:L');
$table9->rowStyle('font-size:12; font-style:B;');
$table9->easyCell('F.');
$table9->easyCell('Kesehatan');
$table9->printRow();
$table9->endTable(3);
$kes=new easyTable($pdf, '{20, 100, 100}', 'border:1');
$kes->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$kes->easyCell('No.','align:C; valign:M');
$kes->easyCell('Aspek Fisik','align:C; valign:M');
$kes->easyCell('Keterangan','align:C; valign:M');
$kes->printRow();

$kes->rowStyle('font-size:12; min-height:15');
$kes->easyCell('1.','align:L; valign:T');
$kes->easyCell('Pendengaran','align:L; valign:T');
$kes->easyCell($prokes['pendengaran'],'align:C; valign:M');
$kes->printRow();
$kes->rowStyle('font-size:12; min-height:15');
$kes->easyCell('2.','align:L; valign:T');
$kes->easyCell('Penglihatan','align:L; valign:T');
$kes->easyCell($prokes['penglihatan'],'align:C; valign:M');
$kes->printRow();
$kes->rowStyle('font-size:12; min-height:15');
$kes->easyCell('3.','align:L; valign:T');
$kes->easyCell('Gigi','align:L; valign:T');
$kes->easyCell($prokes['gigi'],'align:C; valign:M');
$kes->printRow();
$kes->endTable(5);

$pdf->AddPage();

//Prestasi
$adaprest=$connect->query("select * from data_prestasi where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->num_rows;
if($adaprest>0){
$prest=$connect->query("select * from data_prestasi where peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
$kesenian=$prest['kesenian'];
$olahraga=$prest['olahraga'];
$akademik=$prest['akademik'];
}else{
	$kesenian="";
$olahraga="";
$akademik="";
};
$table10=new easyTable($pdf, '{8,100}', 'align:L');
$table10->rowStyle('font-size:12; font-style:B;');
$table10->easyCell('G.');
$table10->easyCell('Prestasi');
$table10->printRow();
$table10->endTable(3);
$pres=new easyTable($pdf, '{20, 75, 125}', 'border:1');
$pres->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE; min-height:7');
$pres->easyCell('No.','align:C; valign:M');
$pres->easyCell('Jenis Prestasi','align:C; valign:M');
$pres->easyCell('Keterangan','align:C; valign:M');
$pres->printRow();

$pres->rowStyle('font-size:12; min-height:15');
$pres->easyCell('1.','align:L; valign:T');
$pres->easyCell('Kesenian','align:L; valign:T');
$pres->easyCell($kesenian,'align:L; valign:T');
$pres->printRow();
$pres->rowStyle('font-size:12; min-height:15');
$pres->easyCell('2.','align:L; valign:T');
$pres->easyCell('Olahraga','align:L; valign:T');
$pres->easyCell($olahraga,'align:L; valign:T');
$pres->printRow();
$pres->rowStyle('font-size:12; min-height:15');
$pres->easyCell('3.','align:L; valign:T');
$pres->easyCell('Akademik','align:L; valign:T');
$pres->easyCell($akademik,'align:L; valign:T');
$pres->printRow();
$pres->endTable(5);

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
	$table11->easyCell('H.');
	$table11->easyCell('Ketidakhadiran');
	$table11->printRow();
	$table11->endTable(3);
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
	$hadir->endTable(10);
}else{
	//Absensi
	$table11=new easyTable($pdf, '{8,100}', 'align:L');
	$table11->rowStyle('font-size:12; font-style:B;');
	$table11->easyCell('H.');
	$table11->easyCell('Ketidakhadiran');
	$table11->printRow();
	$table11->endTable(3);
	$hadir=new easyTable($pdf, '{50, 10, 20, 100}', 'split-row:true; align:L; border:1');
	$hadir->easyCell('Sakit','align:L; border:0;');
	$hadir->easyCell(':','align:L; border:0;');
	$hadir->easyCell($sakit.' Hari','align:L; border:0;');
	if($ab==6){
		$hadir->easyCell("Keputusan:\nBerdasarkan Pencapaian seluruh Kompetensi,\npeserta didik dinyatakan:\n\nLulus/Tidak Lulus dari SD Islam Al-Jannah\n\n*) Coret yang tidak perlu.",'rowspan:5; align:L; valign:T');
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
	$hadir->endTable(10);	
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
    if($ab==="6"){
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
$ttd->easyCell($namawali,'align:C; border:B;');
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
$ttd1->easyCell('UMAR ALI, S.Pd.','align:C; border:B;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->rowStyle('font-size:12');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->easyCell('NIP. -','align:L; border:0;');
$ttd1->easyCell('','align:L; border:0;');
$ttd1->printRow();
$ttd1->endTable(5);


 $pdf->Output('F',$namafilenya);
 //$pdf->Output();


 

?>