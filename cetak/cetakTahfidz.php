<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
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
$ab=substr($kelas, 0, 1);
$tapel=$_GET['tapel'];
$sqls = "select * from siswa where peserta_didik_id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel'")->fetch_assoc();
$namafilenya="Raport Tahfidz ".$siswa['nama']." Semester ".$smt.".pdf";
 $pdf=new exFPDF('L','mm',array(330,215));
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',8);

 $table2=new easyTable($pdf, '{40,5,110,5,80,40,5,30}');
 $table2->easyCell('Nama Siswa', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell($siswa['nama'], 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('Kelas', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell($rombs['rombel'], 'align:L;');
 $table2->printRow();
 $table2->easyCell('Nomor Induk', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell($siswa['nis'], 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('Semester', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell($smt, 'align:L;');
 $table2->printRow();
 $table2->easyCell('Nama Sekolah', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell('SD ISLAM AL-JANNAH', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('Tahun Pelajaran', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell($tapel, 'align:L;');
 $table2->printRow();
 $table2->easyCell('Alamat', 'align:L;');
 $table2->easyCell(':', 'align:L;');
 $table2->easyCell('Jl. Raya Gabuswetan Desa Gabuswetan Kec. Gabuswetan', 'colspan:3;align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->easyCell('', 'align:L;');
 $table2->printRow();
 $table2->endTable();
 
 $table2=new easyTable($pdf, '{40,15,2,40,15,2,25,15,3,63,15,2,63,15}','border:1');
 $table2->easyCell('NAMA SURAT', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA SURAT', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NOMOR HADITS', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA DOA', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA DOA', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->printRow();

 $table2->easyCell('AL FATIHAH', 'align:L;');
 $juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
 if($empty($juz1)){
 $table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 }else{
	$table2->easyCell($juz1['nilai'], 'align:C');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL ALAQ', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 1', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN TIDUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ADA ANGIN KENCANG', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AN NAS', 'align:L;');
 $juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
 if($empty($juz1)){
 $table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 }else{
	$table2->easyCell($juz1['nilai'], 'align:C');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ATTIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 3', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BANGUN TIDUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA MARAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL FALAQ', 'align:L;');
 $juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
 if($empty($juz1)){
 $table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 }else{
	$table2->easyCell($juz1['nilai'], 'align:C');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INSYIRAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 5', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN MAKAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA KAGUM', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL IKHLAS', 'align:L;');
 $juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
 if($empty($juz1)){
 $table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 }else{
	$table2->easyCell($juz1['nilai'], 'align:C');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AD DHUHA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 7', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH MAKAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH ADZAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL LAHAB', 'align:L;');
 $juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
 if($empty($juz1)){
 $table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 }else{
	$table2->easyCell($juz1['nilai'], 'align:C');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL LAIL', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 8', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERCERMIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ZIARAH KUBUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AN NASR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ASY SYAMS', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 9', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH WUDHU', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('TURUN HUJAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL KAFIRUUN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL BALAD', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 11', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MENDOAKAN ORANG TUA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MINTA HUJAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL KAUTSAR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL FAJR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 12', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MENJENGUK ORANG SAKIT', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('TERTIMPA MUSIBAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL MAUN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL GHOSIYAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 13', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MASUK MASJID', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA MENDENGAR PETIR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL QURAISY', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL ALA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 14', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KELUAR MASJID', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('PENUTUP MAJELIS', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL FIIL', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AT TARIQ', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 15', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BELAJAR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MOHON AMPUN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL HUMAZAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL BURUUJ', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 17', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERBUKA PUASA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KALIMAT TAYYIBAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL ASR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INSYIQOQ', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 18', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERPAKAIAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MELEPAS PAKAIAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AT TAKATSUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL MUTAFFIFIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 20', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MASUK KAMAR MANDI', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('PEMBUKA HATI', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL QORIAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INFITAR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 21', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KELUAR KAMAR MANDI', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SAYYIDUL ISTIGFAR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL ADIYAT', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AT TAKWIR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('KELUAR RUMAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 1', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL ZALZALAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ABATSA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('KEBAIKAN DUNIA AKHIRAT', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 2', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL BAYINAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AN NAZIAT', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('NAIK KENDARAAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 3', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL QODR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AN NABA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('BERSIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->printRow();
 $table2->endTable();
 
 $table2=new easyTable($pdf, '{40,15,2,40,15,2,25,15,3,63,15,2,63,15}','border:1');
 $table2->easyCell('NAMA SURAT', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA SURAT', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NOMOR HADITS', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA DOA', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('NAMA DOA', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 1-8', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AR RAHMAN 1-6', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 1', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN TIDUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ADA ANGIN KENCANG', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AN NAS', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ATTIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 3', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BANGUN TIDUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA MARAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL FALAQ', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INSYIRAH', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 5', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN MAKAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA KAGUM', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL IKHLAS', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AD DHUHA', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 7', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH MAKAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH ADZAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AL LAHAB', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL LAIL', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 8', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERCERMIN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ZIARAH KUBUR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 $table2->easyCell('AN NASR', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ASY SYAMS', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 9', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH WUDHU', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('TURUN HUJAN', 'align:L;');
 $table2->easyCell('', 'align:C;');
 $table2->printRow();
 
 
 $table2->endTable();

 //$pdf->Output();
 $pdf->Output('D',$namafilenya);


 

?>