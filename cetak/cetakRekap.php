<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
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
$mp=$_GET['mp'];
$ab=substr($kelas, 0, 1);
$tapel=$_GET['tapel'];
$skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$qkl = $connect->query($skl);
while($sis=$qkl->fetch_assoc()){
$idp=$sis['peserta_didik_id'];
$sqls = "select * from siswa where peserta_didik_id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel'")->fetch_assoc();
$nmapel=$connect->query("select * from mapel where id_mapel='$mp'")->fetch_assoc();
$jKD=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta order by nama_peta asc")->num_rows;
$namafilenya="Rekap Nilai ".$nmapel['nama_mapel']." Semester ".$smt.".pdf";
 $pdf=new exFPDF('P','mm',array(215,330));
 //halaman 1
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',10);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:12; font-style:B;');
 $table2->easyCell('REKAP NILAI PENGETAHUAN', 'align:C;');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, '{40,175}');
 $table2->rowStyle('font-size:10; font-style:B;');
 $table2->easyCell('Nama', 'align:L;');
 $table2->easyCell(': '.$siswa['nama'], 'align:L;');
 $table2->printRow();
 $table2->easyCell('Muatan Pelajaran', 'align:L;');
 $table2->easyCell(': '.$nmapel['nama_mapel'], 'align:L;');
 $table2->printRow();
 $table2->easyCell('Kelas/Semester', 'align:L;');
 $table2->easyCell(': '.$ab.'/'.$smt, 'align:L;');
 $table2->printRow();
 $table2->endTable(5);
 
 $jKD=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta order by nama_peta asc")->num_rows;
 $jTema=$connect->query("select * from tema where kelas='$ab' and smt='$smt' group by tema order by tema asc")->num_rows;
 if($smt==1){
	 if($ab>3){
		 $table2=new easyTable($pdf, '{10,30,30,30,30,30,30,30,30,30,30}', 'border:1');
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('No', 'align:C;rowspan:2');
		 $table2->easyCell('KD', 'align:C;rowspan:2');
		 $table2->easyCell('Penilaian Harian', 'align:C;colspan:5');
		 $table2->easyCell('NPH', 'align:C;rowspan:2');
		 $table2->easyCell('NPTS', 'align:C;rowspan:2');
		 $table2->easyCell('NPAS', 'align:C;rowspan:2');
		 $table2->easyCell('Nilai KD', 'align:C;rowspan:2');
		 $table2->printRow();
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('Tema 1', 'align:C;');
		 $table2->easyCell('Tema 2', 'align:C;');
		 $table2->easyCell('Tema 3', 'align:C;');
		 $table2->easyCell('Tema 4', 'align:C;');
		 $table2->easyCell('Tema 5', 'align:C;');
		 $table2->printRow();
	 }else{
		 $table2=new easyTable($pdf, '{10,30,30,30,30,30,30,30,30,30}', 'border:1');
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('No', 'align:C;rowspan:2');
		 $table2->easyCell('KD', 'align:C;rowspan:2');
		 $table2->easyCell('Penilaian Harian', 'align:C;colspan:4');
		 $table2->easyCell('NPH', 'align:C;rowspan:2');
		 $table2->easyCell('NPTS', 'align:C;rowspan:2');
		 $table2->easyCell('NPAS', 'align:C;rowspan:2');
		 $table2->easyCell('Nilai KD', 'align:C;rowspan:2');
		 $table2->printRow();
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('Tema 1', 'align:C;');
		 $table2->easyCell('Tema 2', 'align:C;');
		 $table2->easyCell('Tema 3', 'align:C;');
		 $table2->easyCell('Tema 4', 'align:C;');
		 $table2->printRow();
	 };
 }else{
	 if($ab>3){
		 $table2=new easyTable($pdf, '{10,30,30,30,30,30,30,30,30,30}', 'border:1');
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('No', 'align:C;rowspan:2');
		 $table2->easyCell('KD', 'align:C;rowspan:2');
		 $table2->easyCell('Penilaian Harian', 'align:C;colspan:4');
		 $table2->easyCell('NPH', 'align:C;rowspan:2');
		 $table2->easyCell('NPTS', 'align:C;rowspan:2');
		 $table2->easyCell('NPAS', 'align:C;rowspan:2');
		 $table2->easyCell('Nilai KD', 'align:C;rowspan:2');
		 $table2->printRow();
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('Tema 6', 'align:C;');
		 $table2->easyCell('Tema 7', 'align:C;');
		 $table2->easyCell('Tema 8', 'align:C;');
		 $table2->easyCell('Tema 9', 'align:C;');
		 $table2->printRow();
	 }else{
		 $table2=new easyTable($pdf, '{10,30,30,30,30,30,30,30,30,30}', 'border:1');
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('No', 'align:C;rowspan:2');
		 $table2->easyCell('KD', 'align:C;rowspan:2');
		 $table2->easyCell('Penilaian Harian', 'align:C;colspan:4');
		 $table2->easyCell('NPH', 'align:C;rowspan:2');
		 $table2->easyCell('NPTS', 'align:C;rowspan:2');
		 $table2->easyCell('NPAS', 'align:C;rowspan:2');
		 $table2->easyCell('Nilai KD', 'align:C;rowspan:2');
		 $table2->printRow();
		 $table2->rowStyle('font-size:10;');
		 $table2->easyCell('Tema 5', 'align:C;');
		 $table2->easyCell('Tema 6', 'align:C;');
		 $table2->easyCell('Tema 7', 'align:C;');
		 $table2->easyCell('Tema 8', 'align:C;');
		 $table2->printRow();
	 };
 };
 
 $sql = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta order by nama_peta asc";
 $query = $connect->query($sql);
 $nmr=1;
 $nilaiKD=0;
 while($s=$query->fetch_assoc()) {
	$table2->easyCell($nmr, 'align:C;');
	$nkd=$s['nama_peta'];
	$table2->easyCell($nkd, 'align:C;');
	$sql1 = "select * from tema where kelas='$ab' and smt='$smt' order by tema asc";
	$query1 = $connect->query($sql1);
	$nilait=0;
	while($n=$query1->fetch_assoc()) {
		$ntema = $n['tema'];
		$niTema=$connect->query("select AVG(nilai) as NilaiTema from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$ntema' and kd='$nkd'")->fetch_assoc();
		$nilait=$nilait+$niTema['NilaiTema'];
		$table2->easyCell(number_format($niTema['NilaiTema'],0), 'align:C;');
	};
	$NPH=$connect->query("select AVG(nilai) as NilaiPH from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$nkd'")->fetch_assoc();
	//$NPH=$nilait/4;
	$table2->easyCell(number_format($NPH['NilaiPH'],0), 'align:C;');
	$CNPTS=$connect->query("select nilai from nuts where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$nkd'")->num_rows;
	if($CNPTS>0){
		$NPTS=$connect->query("select nilai from nuts where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$nkd'")->fetch_assoc();
		$NilaiPTS=$NPTS['nilai'];
	}else{
		$NilaiPTS=0;
	};
	$table2->easyCell(number_format($NilaiPTS,0), 'align:C;');
	$CNPAS=$connect->query("select nilai from nats where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$nkd'")->num_rows;
	if($CNPAS>0){
		$NPAS=$connect->query("select nilai from nats where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$nkd'")->fetch_assoc();
		$NilaiPAS=$NPAS['nilai'];
	}else{
		$NilaiPAS=0;
	};
	$table2->easyCell(number_format($NilaiPAS,0), 'align:C;');
	if($NilaiPTS==0){
		$NKD=((2*$NPH['NilaiPH'])+$NilaiPAS)/3;
	}else{
		$NKD=((2*$NPH['NilaiPH'])+$NilaiPTS+$NilaiPAS)/4;
	};
	$table2->easyCell(number_format($NKD,0), 'align:C;');
	$nilaiKD=$nilaiKD+$NKD;
	$table2->printRow();
	$nmr=$nmr+1;
 };
 $table2->rowStyle('font-size:10;');
 if($smt==1){
	 if($ab>3){
		 $table2->easyCell('NILAI AKHIR', 'align:C;colspan:10');
	 }else{
		 $table2->easyCell('NILAI AKHIR', 'align:C;colspan:9');
	 };
 }else{
	 if($ab>3){
		 $table2->easyCell('NILAI AKHIR', 'align:C;colspan:9');
	 }else{
		 $table2->easyCell('NILAI AKHIR', 'align:C;colspan:9');
	 };
 };
 $NA=$nilaiKD/$jKD;
 $table2->easyCell(number_format($NA,0), 'align:C;');
 $table2->printRow();
 $table2->endTable(5);
};
 $pdf->Output();
?>