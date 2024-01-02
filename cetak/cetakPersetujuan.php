<?php
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
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
$id=$_GET['id'];
$sqls = "select * from surat_ijin where id='$id'";
$querys = $connect->query($sqls);
$sk=$querys->fetch_assoc();
$tglawal=$sk['tanggal_awal'];
$tglakhir=$sk['tanggal_akhir'];
$tanggal1 = new DateTime($tglawal);
$tanggal2 = new DateTime($tglakhir);
$perbedaan = $tanggal2->diff($tanggal1)->format("%a");
$ttm = date('Y-m-d', strtotime('-3 day', strtotime($tglawal)));
$idptk=$sk['ptk_id'];
$sqln = "select * from ptk where ptk_id='$idptk'";
$queryn = $connect->query($sqln);
$ptk=$queryn->fetch_assoc();
$jb=$ptk['jenis_ptk_id'];
$sqlh = "select * from jenis_ptk where jenis_ptk_id='$jb'";
$queryh = $connect->query($sqlh);
$jns=$queryh->fetch_assoc();
 $pdf=new exFPDF('P','mm','A4');
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table1=new easyTable($pdf, 1);
 $table1->easyCell('', 'img:kop.jpg, w280, h20 align:R;');
 $table1->printRow();
 $table1->endTable();
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('SURAT KETERANGAN DISPENSASI KERJA','align:C;font-style:UB');
 $table2->printRow();
 $table2->easyCell('Nomor : '.$sk['no_surat'],'align:C;font-style:B');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Yang bertanda tangan di bawah ini, Kepala Sekolah Dasar Islam Al-Jannah Kecamatan Gabuswetan Kabupaten Indramayu menerangkan bahwa:');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, '{30,10,140}');
 $table2->easyCell('Nama');
 $table2->easyCell(':');
 $table2->easyCell($ptk['nama']);
 $table2->printRow();
 $table2->easyCell('NIY');
 $table2->easyCell(':');
 $table2->easyCell($ptk['niy_nigk']);
 $table2->printRow();
 $table2->easyCell('Jabatan');
 $table2->easyCell(':');
 $table2->easyCell($jns['jenis_ptk']);
 $table2->printRow();
 $table2->easyCell('Unit Kerja');
 $table2->easyCell(':');
 $table2->easyCell('SD Islam Al-Jannah Gabuswetan');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('telah diberikan dispensasi (keringanan) untuk tidak masuk kerja selama '.$perbedaan.' hari terhitung mulai tanggal '.TanggalIndo($tglawal).' s/d '.TanggalIndo($tglakhir).' dikarenakan '.$sk['alasan'].'.');
 $table2->printRow();
 $table2->endTable(3);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Demikianlah surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.');
 $table2->printRow();
 $table2->endTable(5);
 
 $table1=new easyTable($pdf, '{110,70}');
 $table1->easyCell('');
 $table1->easyCell("Gabuswetan, ".TanggalIndo($tglawal)."\nKepala SD Islam Al-Jannah\n\n\n\n\n<b>UMAR ALI, BA.</b>\nNIP.");
 $table1->printRow();
 $table1->endTable(5);
 
 $pdf->Output(); 


 

?>