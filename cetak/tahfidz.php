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
$namafilenya="Raport Tahfidz ".$siswa['nama']." - ".$tahun1."".$tahun2."-".$smts.".pdf";
 $pdf=new exFPDF('L','mm',array(330,215));
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',11);

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
 $table2->easyCell('DOA HARIAN', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DOA HARIAN', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->printRow();
 
 $table2->easyCell('AL FATIHAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL ALAQ', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 1', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN TIDUR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ADA ANGIN KENCANG', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AN NAS', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ATTIN', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 3', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BANGUN TIDUR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA MARAH', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL FALAQ', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INSYIRAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 5', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AKAN MAKAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA KAGUM', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL IKHLAS', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AD DHUHA', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 7', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH MAKAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH ADZAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL LAHAB', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL LAIL', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 8', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERCERMIN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ZIARAH KUBUR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AN NASR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ASY SYAMS', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 9', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESUDAH WUDHU', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('TURUN HUJAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL KAFIRUUN', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL BALAD', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 11', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MENDOAKAN ORANG TUA', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MINTA HUJAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL KAUTSAR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL FAJR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='27'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='27'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 12', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MENJENGUK ORANG SAKIT', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('TERTIMPA MUSIBAH', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='27'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='27'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL MAUN', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL GHOSIYAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='28'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='28'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 13', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MASUK MASJID', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KETIKA MENDENGAR PETIR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='28'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='28'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL QURAISY', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL ALA', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='29'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='29'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 14', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KELUAR MASJID', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('PENUTUP MAJELIS', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='29'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='29'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL FIIL', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AT TARIQ', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='30'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='30'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 15', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BELAJAR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MOHON AMPUN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='30'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='30'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL HUMAZAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL BURUUJ', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='31'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='31'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 17', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERBUKA PUASA', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KALIMAT TAYYIBAH', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='31'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='31'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL ASR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INSYIQOQ', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='32'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='32'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 18', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERPAKAIAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MELEPAS PAKAIAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='32'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='32'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AT TAKATSUR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL MUTAFFIFIN', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='33'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='33'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 20', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MASUK KAMAR MANDI', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('PEMBUKA HATI', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='33'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='33'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL QORIAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL INFITAR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='34'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='34'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ARBAIN 21', 'align:L;');
 $ada1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_arbain where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KELUAR KAMAR MANDI', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SAYYIDUL ISTIGFAR', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='34'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='34'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL ADIYAT', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AT TAKWIR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='35'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='35'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('KELUAR RUMAH', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 1', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='35'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='35'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL ZALZALAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ABATSA', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='36'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='36'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('KEBAIKAN DUNIA AKHIRAT', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 2', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='36'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='36'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL BAYINAH', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AN NAZIAT', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='37'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='37'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('NAIK KENDARAAN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('DZIKIR PAGI HARI 3', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='37'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='37'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL QODR', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AN NABA', 'align:L;');
 $ada1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='38'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from tahfidz where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='38'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };	
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('BERSIN', 'align:L;');
 $ada1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from doa_harian where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->printRow();
 $table2->endTable();
 
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',11);
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
 
 $table2=new easyTable($pdf, '{52,15,2,52,15,3,67,15,2,77,15}','border:1');
 $table2->easyCell('SURAT PILIHAN', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SURAT PILIHAN', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('HADITS TENTANG', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('HADITS TENTANG', 'valign:M;align:C');
 $table2->easyCell('NILAI', 'valign:M;align:C');
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 1-8', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AR RAHMAN 1-6', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SALAT', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='1'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ADAB MAKAN', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='14'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 183', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AR RAHMAN 7-13', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SABAR DAN PEMAAF', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='2'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MALU SEBAGIAN IMAN', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='15'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 255', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL MUKMININ 1-4', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SENYUM SHADAQAH', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='3'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('KEUTAMAAN BELAJAR QURAN', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='16'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 284-286', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL MUKMININ 5-9', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERKATA BAIK', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='4'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ORANG MULIA', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='17'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL BAQARAH 153-157', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('AL MUKMININ 10-11', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SURGA DIBAWAH KAKI IBU', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='5'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('ALLAH SUKA KEINDAHAN', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='18'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('AL LUQMAN 12-19', 'align:L;');
 $ada1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from surah_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:L');
 $table2->easyCell('', 'align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:R');
 $table2->easyCell('KEUTAMAAN SALAM', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='6'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('LARANGAN SOMBONG', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='19'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('MEMUTUS SILATURRAHMI', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='7'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('BERTERIMA KASIH KEPADA SESAMA', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='20'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell("Keterangan Nilai:\n\n A : Sangat Lancar\nB : Lancar\nC : Cukup Lancar\nD : Kurang Lancar\nE : Tidak Hafal", 'rowspan:6;colspan:5;valign:T;align:L;border:0');
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('MASJID RUMAH MUSLIM', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='8'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MENCINTAI SAUDARA', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='21'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('WAJIB MENUNTUT ILMU', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='9'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SESAMA MUSLIM BERSAUDARA', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='22'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('MENUTUP AURAT', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='10'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('SALING MEMBERI HADIAH', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='23'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('KEBERSIHAN', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='11'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('MEMULIAKAN TAMU', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='24'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('BERBUAT BAIK', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='12'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('PENTINGNYA NIAT', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='25'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->easyCell('', 'align:C;border:0');
 $table2->easyCell('JANGAN SUKA MARAH', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='13'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->easyCell('', 'align:C;border:LR');
 $table2->easyCell('LARANGAN MEMBANGKANG', 'align:L;');
 $ada1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->num_rows;
 if($ada1>0){
	$juz1=$connect->query("select * from hadits_pilihan where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and surah='26'")->fetch_assoc();
	$table2->easyCell($juz1['nilai'], 'align:C');
 }else{
	$table2->easyCell('', 'align:C;bgcolor:#acaeaf;');
 };
 $table2->printRow();
 
 $table2->endTable(5);

 $ttd=new easyTable($pdf, 2);
$ttd->rowStyle('font-size:12');
$ttd->easyCell("Mengetahui:\nKepala Sekolah,\n\n\n\n\n\n\n\n___________________________\nNIP. ..................................",'align:C; valign:T');
$ttd->easyCell("Indramayu, ................................ 20.....\nGuru Kelas,\n\n\n\n\n\n\n\n___________________________\n NIP...................................",'align:C; valign:T');
$ttd->printRow();
$ttd->endTable();


 //$pdf->Output();
 $pdf->Output('D',$namafilenya);


 

?>