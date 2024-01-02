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
$sqls = "select * from skkb where id='$id'";
$querys = $connect->query($sqls);
$sk=$querys->fetch_assoc();
$tgl=$sk['tanggal'];
$idptk=$sk['peserta_didik_id'];
$sqln = "select * from siswa where peserta_didik_id='$idptk'";
$queryn = $connect->query($sqln);
$ptk=$queryn->fetch_assoc();
 $pdf=new exFPDF('P','mm','A4');
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table1=new easyTable($pdf, 1);
 $table1->easyCell('', 'img:kop.jpg, w280, h20 align:R;');
 $table1->printRow();
 $table1->endTable();
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('SURAT KETERANGAN BERKELAKUAN BAIK','align:C;font-style:UB');
 $table2->printRow();
 $table2->easyCell('Nomor : '.$sk['no_surat'],'align:C;font-style:B');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Yang bertanda tangan di bawah ini Kepala Sekolah Dasar Islam Al-Jannah Kecamatan Gabuswetan Kabupaten Indramayu, menerangkan dengan sesungguhnya bahwa:');
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, '{60,5,115}');
 $table2->easyCell('Nama');
 $table2->easyCell(':');
 $table2->easyCell($ptk['nama']);
 $table2->printRow();
 $table2->easyCell('Tempat Tanggal Lahir');
 $table2->easyCell(':');
 $table2->easyCell($ptk['tempat'].', '.TanggalIndo($ptk['tanggal']));
 $table2->printRow();
 $table2->easyCell('NIS / NISN');
 $table2->easyCell(':');
 $table2->easyCell($ptk['nis'].' / '.$ptk['nisn']);
 $table2->printRow();
 $table2->endTable(5);
 
 $table2=new easyTable($pdf, 1);
 $table2->easyCell('Nama tersebut di atas selama menjadi siswa pada SD Islam Al-Jannah Gabuswetan Indramayu berkelakuan baik, tidak  terlibat pada Miras, Narkoba dan tidak pernah  terlibat dalam tindakan kriminal, tawuran dan kenakalan remaja lainnya yang melanggar hukum.');
 $table2->printRow();
 $table2->endTable(3);
 
 if(empty($sk['keterangan'])){
	$table2=new easyTable($pdf, 1);
	$table2->easyCell('Demikianlah surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.');
	$table2->printRow();
	$table2->endTable(5); 
 }else{
	$table2=new easyTable($pdf, 1);
	$table2->easyCell('Demikianlah surat keterangan ini dibuat untuk '.$sk['keterangan']);
	$table2->printRow();
	$table2->endTable(5); 
 };
 
 
 $table1=new easyTable($pdf, '{110,70}');
 $table1->easyCell('');
 $table1->easyCell("Gabuswetan, ".TanggalIndo($tgl)."\nKepala SD Islam Al-Jannah\n\n\n\n\n<b>UMAR ALI, BA.</b>\nNIP.");
 $table1->printRow();
 $table1->endTable(5);
 
 $pdf->Output(); 


 

?>