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

 $table1=new easyTable($pdf, '{90,90}');
 $table1->easyCell('');
 $table1->easyCell("Gabuswetan, ".TanggalIndo($ttm)."\nKepada Yth:\nKepala SD Islam Al-Jannah\ndi-\nTempat");
 $table1->printRow();
 $table1->endTable(25);

 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Yang bertanda tangan di bawah ini:');
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
 $table2->easyCell('dengan ini mengajukan permintaan cuti diluar tanggungan Yayasan selama '.$perbedaan.' Hari,');
 $table2->printRow();
 $table2->endTable(3);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('terhitung mulai tanggal '.TanggalIndo($tglawal).' s/d '.TanggalIndo($tglakhir).' dengan alasan sebagai berikut : ');
 $table2->printRow();
 $table2->endTable(3);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell($sk['alasan']);
 $table2->printRow();
 $table2->endTable(3);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Demikianlah surat permintaan ini saya buat untuk dapat dipertimbangkan sebagaimana mestinya.');
 $table2->printRow();
 $table2->endTable(5);
 
 $table1=new easyTable($pdf, '{130,50}');
 $table1->easyCell('');
 $table1->easyCell("Hormat Saya,\n\n\n\n\n".$ptk['nama']);
 $table1->printRow();
 $table1->endTable(5);
 
 $table1=new easyTable($pdf, '{90,90}','border:1');
 $table1->rowStyle('font-size:12; min-height:45');
 $table1->easyCell("CATATAN:\n\nCuti yang telah diambil dalam Tahun bersangkutan:\n\n1. Cuti Tahunan\n2. Cuti Besar\n3. Cuti Sakit\n4. Cuti Bersalin\n5. Cuti Karena Alasan Penting\n6. Keterangan lain-lain.",'rowspan:2;valign:T');
 $table1->easyCell("CATATAN/PERTIMBANGAN ATASAN LANGSUNG:\n\n\n\n\n\n\n");
 $table1->printRow();
 $table1->rowStyle('font-size:12; min-height:45');
 $table1->easyCell("Usulan ini disetujui oleh:\nKepala Sekolah\n\n\n\n\nUMAR ALI, BA.\nNIP. ..............",'align:C');
 $table1->printRow();
 $table1->endTable(5);
 
 $pdf->Output(); 


 

?>