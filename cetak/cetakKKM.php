<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
$namafile="contoh";
$kelas=$_GET['kelas'];
$ab=substr($kelas, 0, 1);
$mpid=$_GET['mapel'];
$tapel=$_GET['tapel'];
$sqlp = "select * from mapel where id_mapel='$mpid'";
$queryp = $connect->query($sqlp);
$mp=$queryp->fetch_assoc();
$sql = "select * from kd where kelas='$ab' and mapel='$mpid' order by kd asc";
$query = $connect->query($sql);
$namafilenya="KKM Mata Pelajaran ".$mp['nama_mapel']." Kelas ".$kelas.".pdf";
 $pdf=new exFPDF();
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table1=new easyTable($pdf, '{30,150}');
 $table1->easyCell('', 'img:logo.jpg, align:R;rowspan:3');
 $table1->easyCell("PEMERINTAH DAERAH KABUPATEN INDRAMAYU\nDINAS PENDIDIKAN", 'align:C;font-size:14;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->easyCell('SD ISLAM AL-JANNAH', 'align:C;font-size:20;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->easyCell("Jalan Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan Kab. Indramayu 45263\nTelp. (0234)5508501 Email : sdi.aljannah@gmail.com Web: www.sdi-aljannah.web.id", 'align:C;font-size:8;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->rowStyle('min-height:1;bgcolor:#000;paddingY:0.2;');
 $table1->easyCell('', 'colspan:2');
 $table1->printRow();
 $table1->endTable();
 
 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('Kriteria Ketuntasan Minimal (KKM)', 'align:C;');
 $table2->printRow();
 $table2->endTable();
 
 $table3=new easyTable($pdf, '{60, 10, 100}','align:L');
 $table3->rowStyle('font-size:12; font-style:B;');
 $table3->easyCell('Muatan Mata Pelajaran');
 $table3->easyCell(':');
 $table3->easyCell($mp['nama_mapel']);
 $table3->printRow();
 $table3->rowStyle('font-size:12; font-style:B;');
 $table3->easyCell('Kelas');
 $table3->easyCell(':');
 $table3->easyCell($kelas);
 $table3->printRow();
 $table3->endTable();
 
 

//====================================================================

 $table=new easyTable($pdf, '{15, 120, 45, 45, 45, 30}','align:{CCCCCC};border:1; border-color:#a1a1a1;font-size:10 ');

 $table->rowStyle('align:{CCCCCC};valign:M;font-family:times; font-style:B;');
 $table->easyCell('Kompetensi Dasar','rowspan:2;colspan:2');
 $table->easyCell('Karakteristik Muatan/Mata Pelajaran (Kompleksitas)');
 $table->easyCell('Karakteristik Peserta Didik (Intake)');
 $table->easyCell('Kondisi Satuan Pendidikan');
 $table->easyCell('KKM per KD','rowspan:2;colspan:2');
 $table->printRow();
 $table->rowStyle('align:{CCC};valign:M;font-family:times; font-style:B;');
 $table->easyCell('0 - 100');
 $table->easyCell('0 - 100');
 $table->easyCell('0 - 100');
 $table->printRow(true);
 while($s=$query->fetch_assoc()) {
 $kda=$s['kd'];
$namakd1=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis='1'")->fetch_assoc();
$namakd2=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis='2'")->fetch_assoc();
$namakd3=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid' and kd='$kda' and jenis='3'")->fetch_assoc();
$namakd4=$connect->query("select avg(nilai) as ratarata from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mpid' and kd='$kda'")->fetch_assoc();
$cr1=$namakd1['nilai'];
$cr2=$namakd2['nilai'];
$cr3=$namakd3['nilai'];
$cr4=$namakd4['ratarata'];
$table->rowStyle('align:{CLCCCC};valign:M;font-family:times;font-size:10');
$table->easyCell($s['kd']);
$table->easyCell($s['nama_kd']);
$table->easyCell($cr1);
$table->easyCell($cr2);
$table->easyCell($cr3);
$table->easyCell(number_format($cr4,0));
$table->printRow();
 };
$kkmmp=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$mpid'")->fetch_assoc();
$table->rowStyle('align:{RCCCCC};valign:M;font-family:times; font-style:B;');
$table->easyCell('KKM MUATAN MATA PELAJARAN '.$mp['nama_mapel'],'colspan:5'); 
$table->easyCell($kkmmp['nilai']); 
$table->printRow();
 $table->endTable();
//------------------------------------------------------
$adawali=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'")->num_rows;
if($adawali>0){
$namawali=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
$idwali=$namawali['wali_kelas'];
$namaguru=$connect->query("select * from ptk where ptk_id='$idwali'")->fetch_assoc();
$namagk=$namaguru['nama'];
}else{
	$namagk="";
};
$ttd=new easyTable($pdf, 2);
$ttd->rowStyle('font-size:11');
$ttd->easyCell('','align:C; valign:T');
if($mpid==1 or $mpid==8 or $mpid==10){
    $ttd->easyCell("Indramayu, ........................ 20.....\nGuru Mata Pelajaran,\n\n\n\n\n\n...................................\n NIP...................................",'align:C; valign:T');
}else{
    $ttd->easyCell("Indramayu, ........................ 20.....\nGuru Kelas,\n\n\n\n\n\n".$namagk."\n NIP...................................",'align:C; valign:T');
}
$ttd->printRow();
$ttd->endTable();

 $pdf->Output(); 


 

?>