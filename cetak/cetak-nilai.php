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
 $table3->easyCell(strtoupper($cfg['nama']));
 $table3->easyCell('Semester');
 $table3->easyCell(':');
 $table3->easyCell($smt);
 $table3->printRow();
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Alamat Sekolah');
 $table3->easyCell(':');
 $table3->easyCell($cfg['alamat_jalan']);
 $table3->easyCell('Tahun Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($tapel);
 $table3->printRow();
 $table3->endTable(5);
 
//====================================================================
//Isi Raport
$pdf->SetFont('arial', '', 12);
$rapo = new easyTable($pdf, '{20, 140, 80}', 'border:1');
$rapo->rowStyle('font-size:14; font-style:B; bgcolor:#BEBEBE;min-height:15');
$rapo->easyCell('No', 'align:C; valign:M');
$rapo->easyCell('Muatan Pelajaran', 'align:C; valign:M');
$rapo->easyCell('Nilai Akhir', 'align:C; valign:M');
$rapo->printRow(true);

$sql1 = "select * from mata_pelajaran order by id_mapel asc";
$query1 = $connect->query($sql1);
$nilaimp = '';
$nomor = 1;

while ($row1 = $query1->fetch_assoc()) {
    $idm = $row1['id_mapel'];
    $adape = $connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->num_rows;

    if ($adape > 0) {
        $npe = $connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->fetch_assoc();
        $nilaipe = number_format($npe['nilai'], 0);
        $data = explode("|", $npe['deskripsi']);
        $kelebihan = $data[0];
        $kelemahan = $data[1];
        $deskripsi1 = $npe['deskripsi'];
    } else {
        // Lewati seluruh baris jika Nilai Akhir dan Catatan Kompetensi tidak tersedia
        continue;
    }

    $mpl = $connect->query("select * from mata_pelajaran where id_mapel='$idm'")->fetch_assoc();

    $rapo->rowStyle('font-size:14;min-height:10');
    $rapo->easyCell($nomor, 'align:C; valign:M');
    $rapo->easyCell($mpl['nama_mapel'], 'valign:M');
    $rapo->easyCell($nilaipe, 'align:C; valign:M; font-style:B');

    $rapo->printRow();
    $nomor = $nomor + 1;
}


//akhir tabel rapor
$rapo->endTable(5);


//TTD
$ttd=new easyTable($pdf, '{10,70,20,80,10}');
$ttd->rowStyle('font-size:14');
$ttd->easyCell('','align:L; border:0;');
$cektmr=$connect->query("select * from titimangsa where smt='$smt' and tapel='$tapel'")->num_rows;
if($cektmr>0){
	$tmr=$connect->query("select * from titimangsa where smt='$smt' and tapel='$tapel'")->fetch_assoc();
    if($ab===6){
      $ttd->easyCell($tmr['tempat'].', '.TanggalIndo($tmr['tanggal2']),'align:C; border:0;');
    }else{
	  $ttd->easyCell($tmr['tempat'].', '.TanggalIndo($tmr['tanggal']),'align:C; border:0;');
    }
}else{
	$ttd->easyCell('............, ........................ 20.....','align:C; border:0;');
};

$ttd->printRow();
$ttd->rowStyle('font-size:14');
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('Guru Kelas,','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('','align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
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
$ttd->easyCell('<b>'.$namawali.'</b>','align:C; border:B;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('NIP.','align:L; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->endTable();


 //$pdf->Output('D',$namafilenya);
 $pdf->Output();
 //$pdf->Output('F',$namafilenya);
