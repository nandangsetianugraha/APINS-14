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
 
 $table3=new easyTable($pdf, '{69, 6, 145, 65, 6, 50}','align:L');
 $table3->rowStyle('font-size:11');
 $table3->easyCell('Nama Peserta Didik');
 $table3->easyCell(':');
 $table3->easyCell($siswa['nama']);
 $table3->easyCell('Kelas');
 $table3->easyCell(':');
 $table3->easyCell($rombs['rombel']);
 $table3->printRow();
 $table3->rowStyle('font-size:11');
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
 $table3->rowStyle('font-size:11');
 $table3->easyCell('Nama Sekolah');
 $table3->easyCell(':');
 $table3->easyCell(strtoupper($cfg['nama']));
 $table3->easyCell('Semester');
 $table3->easyCell(':');
 $table3->easyCell($smt);
 $table3->printRow();
 $table3->rowStyle('font-size:11');
 $table3->easyCell('Alamat Sekolah');
 $table3->easyCell(':');
 $table3->easyCell($cfg['alamat_jalan']);
 $table3->easyCell('Tahun Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($tapel);
 $table3->printRow();
 $table3->endTable(5);
 
//====================================================================
//====================================================================
//Isi Raport
$pdf->SetFont('arial', '', 12);
$rapo = new easyTable($pdf, '{20, 170, 50}', 'border:1');
$rapo->rowStyle('font-size:12; font-style:B; bgcolor:#BEBEBE;min-height:14');
$rapo->easyCell('No', 'align:C; valign:M');
$rapo->easyCell('Muatan Pelajaran', 'align:C; valign:M');
$rapo->easyCell('Nilai Akhir', 'align:C; valign:M');
$rapo->printRow(true);

$sql1 = "select * from kelompok_mapel where kurikulum='Kurikulum Merdeka' order by urut asc";
$query1 = $connect->query($sql1);
$nilaimp='';

while ($kelompokRow = $query1->fetch_assoc()) {
    $kelompokId = $kelompokRow['id_kelompok'];
    
    // Uncomment if you need to fetch kelompok_mapel data
    // $kelompokMapel = $connect->query("SELECT * FROM kelompok_mapel WHERE id_kelompok='$kelompokId'")->fetch_assoc();

    // Set row style for kelompok header
    $rapo->rowStyle('font-size:12;');
    $rapo->easyCell("<b>" . $kelompokRow['urut'] . ". " . $kelompokRow['kelompok'] . "</b>", 'colspan:4;align:L;valign:T');
    $rapo->printRow();

    // Fetch all mata_pelajaran associated with the current kelompok
    $mataPelajaranQuery = "SELECT * FROM mata_pelajaran WHERE kd_kelompok='$kelompokId' ORDER BY urutan ASC";
    $mataPelajaranResult = $connect->query($mataPelajaranQuery);
    $nomor = 1;

    while ($mapelRow = $mataPelajaranResult->fetch_assoc()) {
        $mapelId = $mapelRow['id_mapel'];

        // Check if there are any rapor records for the current mapel
        $raporCount = $connect->query("SELECT * FROM raport_ikm WHERE id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapelId'")->num_rows;

        // Fetch rapor details if records exist
        if ($raporCount > 0) {
            $raporData = $connect->query("SELECT * FROM raport_ikm WHERE id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mapelId'")->fetch_assoc();
            $nilai = number_format($raporData['nilai'], 0);

            // If nilai is 0, set it to an empty string
            if ($nilai == 0) {
                $nilai = '';
            }

            // Extract kelebihan and kelemahan from deskripsi
            $deskripsiData = explode("|", $raporData['deskripsi']);
            $kelebihan = $deskripsiData[0];
            $kelemahan = $deskripsiData[1];

            // Fetch mapel details
            $mapelDetails = $connect->query("SELECT * FROM mata_pelajaran WHERE id_mapel='$mapelId'")->fetch_assoc();

            // Set row style for mapel data
            $rapo->rowStyle('font-size:12;min-height:31');
            $rapo->easyCell($nomor, 'align:C;valign:T');
            $rapo->easyCell($mapelDetails['nama_mapel'], 'valign:T');
            $rapo->easyCell($nilai, 'align:C;valign:T');

            // Print the row
            $rapo->printRow();
            $nomor++;
        }
    }
}
$rapo->endTable(5);

//TTD
$ttd=new easyTable($pdf, '{10,70,20,80,10}');
$ttd->rowStyle('font-size:12');
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
$ttd->rowStyle('font-size:12');
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
	$namawali=ucwords($wks['nama']);
}else{
	$namawali=ucwords($wks['nama']).', '.$wks['gelar'];
};
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell('<b>'.$namawali.'</b>','align:C; border:B;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->easyCell('','align:L; border:0;');
$ttd->easyCell($wks['niy_nigk'],'align:C; border:0;');
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->endTable();

 //$pdf->Output('D',$namafilenya);
 $pdf->Output();
 //$pdf->Output('F',$namafilenya);
