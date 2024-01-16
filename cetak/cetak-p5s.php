<?php
 use setasign\Fpdi\Fpdi;
 require_once('fpdf/fpdf.php');
 require_once('fpdi2/autoload.php');
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
$proyek=$_GET['proyek'];
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
$namafilenya="Raport ".$siswa['nama']." - ".$tahun1."".$tahun2."-".$smts.".pdf";
$ks=$connect->query("select * from ptk where jenis_ptk_id='99'")->fetch_assoc();
if($ks['gelar']==' '){
	$namaks=strtoupper($ks['nama']);
}else{
	$namaks=strtoupper($ks['nama']).', '.$ks['gelar'];
};
 $pdf=new exFPDF();
//halaman 3
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',11);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:14; font-style:B;');
 $table2->easyCell('RAPOR PROJEK PENGUATAN', 'align:C;');
 $table2->printRow();
 $table2->rowStyle('font-size:14; font-style:B;');
 $table2->easyCell('PROFIL PELAJAR PANCASILA', 'align:C;');
 $table2->printRow();
 $table2->endTable();
 
 $table3=new easyTable($pdf, '{80, 8, 140, 70, 8, 60}','align:L');
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Nama Peserta Didik');
 $table3->easyCell(':');
 $table3->easyCell($siswa['nama']);
 $table3->easyCell('Kelas');
 $table3->easyCell(':');
 $table3->easyCell($rombs['rombel']);
$namafile=$rombs['rombel']."-".$siswa['nama'].".pdf";
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
 $table3->easyCell(strtoupper($cfg['nama_sekolah']));
 $table3->easyCell('Semester');
 $table3->easyCell(':');
 $table3->easyCell($smt);
 $table3->printRow();
 $table3->rowStyle('font-size:11');
 $table3->easyCell('Alamat Sekolah');
 $table3->easyCell(':');
 $table3->easyCell($cfg['alamat_sekolah']);
 $table3->easyCell('Tahun Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($tapel);
 $table3->printRow();
 $table3->endTable();
 
 $npro=$connect->query("select * from data_proyek where kelas='$kelas' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:12; font-style:B;');
 $table2->easyCell($npro['nama_proyek'], 'border:LTR;align:L;');
 $table2->printRow();
 $table2->rowStyle('font-size:11;');
 $table2->easyCell($npro['deskripsi_proyek'], 'border:LBR;');
 $table2->printRow();
 $table2->endTable();
 
//====================================================================
//Isi Raport
$sql = "select * from pemetaan_proyek where proyek='$proyek' order by dimensi asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$iddimensi=$s['dimensi'];
	$ndimensi=$connect->query("select * from dimensi_proyek where id_dimensi='$iddimensi'")->fetch_assoc();
	$nomor=1;
	$table4=new easyTable($pdf, '{30,210}', 'align:L');
	$table4->rowStyle('font-size:11; font-style:B;');
	$table4->easyCell('Dimensi : ');
	$table4->easyCell($ndimensi['nama_dimensi']);
	$table4->printRow();
	$table4->endTable();
	
	$rapo=new easyTable($pdf, '{15, 125, 25, 25, 25, 25}', 'border:1');
	$rapo->rowStyle('font-size:11; font-style:B; bgcolor:#BEBEBE;min-height:8');
	$rapo->easyCell('No','rowspan:2;align:C; valign:M');
	$rapo->easyCell('Dimensi dan Sub Elemen','rowspan:2;align:C; valign:M');
	$rapo->easyCell('Asesmen','colspan:4;align:C; valign:M');
	$rapo->printRow();
	$rapo->easyCell('BB','align:C; valign:M');
	$rapo->easyCell('MB','align:C; valign:M');
	$rapo->easyCell('BSH','align:C; valign:M');
	$rapo->easyCell('BSB','align:C; valign:M');
	$rapo->printRow(true);
	
	$sql1 = "select * from elemen_proyek where dimensi='$iddimensi' and fase='$vase'";
	$query1 = $connect->query($sql1);
	while($n=$query1->fetch_assoc()) {
		$idel=$n['id_elemen'];
		$ada = $connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$iddimensi'")->num_rows;
		if($ada>0){
			$utt=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND proyek='$proyek' and id_elemen='$idel' and dimensi='$iddimensi'")->fetch_assoc();
			$ncek=$utt['nilai'];
			if($ncek==0){
				$stat1='img:checklist.jpg,w7;';
				$stat2='';
				$stat3='';
				$stat4='';
			}elseif($ncek==1){
				$stat1='';
				$stat2='img:checklist.jpg,w7;';
				$stat3='';
				$stat4='';
			}elseif($ncek==2){
				$stat1='';
				$stat2='';
				$stat3='img:checklist.jpg,w7;';
				$stat4='';
			}else{
				$stat1='';
				$stat2='';
				$stat3='';
				$stat4='img:checklist.jpg,w7;';
			};
		}else{
			$stat1='';
			$stat2='';
			$stat3='';
			$stat4='';
		};
		$rapo->rowStyle('font-size:11');
		//$rapo->easyCell(iconv("UTF-8", "ENCODE",'Hello World'), 'font-color:#66686b;');
		$rapo->easyCell($nomor,'align:C; valign:M');
		$rapo->easyCell("<b>".$n['sub_elemen']."</b>:\n".$n['capaian'],'align:L;valign:M');
		$rapo->easyCell('',$stat1.'align:C; valign:M');
		$rapo->easyCell('',$stat2.'align:C; valign:M');
		$rapo->easyCell('',$stat3.'align:C; valign:M');
		$rapo->easyCell('',$stat4.'align:C; valign:M');
		$rapo->printRow();
		
		$nomor=$nomor+1;
	};
	$promin=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' and kelas='$kelas' and tapel='$tapel' and smt='$smt' and proyek='$proyek' and dimensi='$iddimensi' ORDER BY nilai desc LIMIT 1")->fetch_assoc();
	$promax=$connect->query("select * from penilaian_proyek where peserta_didik_id='$idp' and kelas='$kelas' and tapel='$tapel' and smt='$smt' and proyek='$proyek' and dimensi='$iddimensi' ORDER BY nilai asc LIMIT 1")->fetch_assoc();
	$elmin=$promin['id_elemen'];
	$elmax=$promax['id_elemen'];
	$nmin=$connect->query("select * from elemen_proyek where id_elemen='$elmin'")->fetch_assoc();
	$nmax=$connect->query("select * from elemen_proyek where id_elemen='$elmax'")->fetch_assoc();
	if(empty($elmin) or empty($elmax)){
		$proses="";
	}else{
	$proses="Ananda ".$siswa['nama']." berkembang sangat baik dalam ".$nmax['capaian'].". Namun masih butuh bimbingan dalam ".$nmin['capaian'];
	};
	$rapo->rowStyle('font-size:11');
	$rapo->easyCell("<b>Catatan Proses :</b> ".$proses,'colspan:6;align:L; valign:T');
	$rapo->printRow();
	
	//akhir tabel rapor
	$rapo->endTable(5);
	//$pdf->AddPage(); 
}
//$pdf->AddPage();
$table6=new easyTable($pdf, '{20,40,5,20,60}', 'align:L');
$table6->rowStyle('font-size:12; font-style:B;');
$table6->easyCell('Keterangan Asesmen :','colspan:5;align:L; valign:M');
$table6->printRow();
$table6->rowStyle('font-size:8;');
$table6->easyCell('BB');
$table6->easyCell(': Belum Berkembang');
$table6->easyCell('');
$table6->easyCell('BSH');
$table6->easyCell(': Berkembang Sesuai Harapan');
$table6->printRow();
$table6->rowStyle('font-size:8;');
$table6->easyCell('MB');
$table6->easyCell(': Mulai Berkembang');
$table6->easyCell('');
$table6->easyCell('BSB');
$table6->easyCell(': Berkembang Sangat Baik');
$table6->printRow();
$table6->endTable(5);

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
      $ttd->easyCell($tmr['tempat'].', '.TanggalIndo($tmr['tanggal2']),'align:C; border:0;');
    }else{
	  $ttd->easyCell($tmr['tempat'].', '.TanggalIndo($tmr['tanggal']),'align:C; border:0;');
    }
}else{
	$ttd->easyCell('............, ........................ 20.....','align:C; border:0;');
};
$ttd->easyCell('','align:L; border:0;');
$ttd->printRow();
$ttd->rowStyle('font-size:12');
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


$nromb=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
$idwks=$nromb['wali_kelas'];
$wks=$connect->query("select * from ptk where ptk_id='$idwks'")->fetch_assoc();
if($wks['gelar']==''){
	$namawali=strtoupper($wks['nama']);
}else{
	$namawali=strtoupper($wks['nama']).', '.$wks['gelar'];
};
$ttd->rowStyle('font-size:12');
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





 //$pdf->Output('D',$namafile);
 $pdf->Output();
 //$pdf->Output('F','rapor-p5.pdf');
 
?>