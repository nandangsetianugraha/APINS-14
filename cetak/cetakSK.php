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
 include '../config/db_connect.php';
$id=$_GET['id'];
$sqls = "select * from sk where id_sk='$id'";
$querys = $connect->query($sqls);
$sk=$querys->fetch_assoc();
$idptk=$sk['ptk_id'];
$sqln = "select * from ptk where ptk_id='$idptk'";
$queryn = $connect->query($sqln);
$ptk=$queryn->fetch_assoc();
 $pdf=new exFPDF('P','mm','Legal');
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table1=new easyTable($pdf, '{30,150}');
 $table1->easyCell('', 'img:logo1.jpg, align:R;rowspan:3');
 $table1->easyCell("YAYASAN", 'align:C;font-size:18;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->easyCell('AL - ISLAM', 'align:C;font-size:28;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->easyCell("Akta Notaris Nomor 80 Tanggal 8 Nopember 1996\nJalan Raya Gabuswetan Desa Gabuswetan Kec. Gabuswetan Kab. Indramayu 45263", 'align:C;font-size:10;font-style:B;paddingY:0.3');
 $table1->printRow();
 $table1->rowStyle('min-height:1;bgcolor:#000;paddingY:0.2;');
 $table1->easyCell('', 'colspan:2');
 $table1->printRow();
 $table1->endTable();

 $table2=new easyTable($pdf, 1);
 $table2->easyCell('KEPUTUSAN KETUA YAYASAN AL-ISLAM','align:C;font-style:UB');
 $table2->printRow();
 $table2->easyCell('Nomor : '.$sk['no_sk'],'align:C;');
 $table2->printRow(10);
 $table2->easyCell('TENTANG','align:C;font-style:B');
 $table2->printRow();
 $table2->easyCell('PENGANGKATAN '.strtoupper($sk['jenis_ptk']).' TETAP YAYASAN AL-ISLAM','align:C;font-style:B');
 $table2->printRow();
 $table2->endTable();
 
 $table3=new easyTable($pdf, '{35, 5, 8, 140}','align:L');
 $table3->rowStyle('font-size:12');
 $table3->easyCell('Menimbang');
 $table3->easyCell(':');
 $table3->easyCell('a.');
 $table3->easyCell('Bahwa untuk memenuhi kebutuhan '.$sk['jenis_ptk'].', maka perlu mengangkat '.$sk['jenis_ptk'].' pada Yayasan Al-Islam;');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('b.');
 $table3->easyCell('Bahwa pengangkatan dan penempatan '.$sk['jenis_ptk'].' pada satuan pendidikan yang diselenggaran oleh masyarakat didasarkan pada kesepakatan kerja bersama;','align:J; valign:M');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('c.');
 $table3->easyCell('Bahwa berdasarkan pertimbangan sebagaimana dimaksud pada butir a dan butir b di atas, maka perlu menetapkan Pengangkatan '.$sk['jenis_ptk'].' Tetap Yayasan Al-Islam.');
 $table3->printRow();
 $table3->easyCell('Mengingat');
 $table3->easyCell(':');
 $table3->easyCell('1.');
 $table3->easyCell('Undang-undang Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional;','align:J; valign:M');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('2.');
 $table3->easyCell('Undang-undang Nomor 14 Tahun 2005 tentang Guru dan Dosen;');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('3.');
 $table3->easyCell('Peraturan Pemerintah Nomor 74 Tahun 2008 tentang Guru;');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('4.');
 $table3->easyCell('Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan sebagaimana telah diubah menjadi Peraturan Pemerintah Nomor 32 Tahun 2013 tentang Perubahan atas Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan;','align:J; valign:M');
 $table3->printRow();
 $table3->easyCell(' ');
 $table3->easyCell(' ');
 $table3->easyCell('5.');
 $table3->easyCell('Peraturan Menteri Pendidikan Nasional Nomor 16 Tahun 2007 tentang Standar Kualifikasi Akademik dan Kompetensi Guru;');
 $table3->printRow();
 $table3->rowStyle('align:{CCCC};valign:M; font-style:B;');
 $table3->easyCell('Memutuskan','colspan:4');
 $table3->printRow();
 $table3->easyCell('Menetapkan');
 $table3->easyCell(':');
 $table3->easyCell('Keputusan Ketua Yayasan Al-Islam tentang Pengangkatan '.$sk['jenis_ptk'].' Tetap Yayasan SD Islam Al-Jannah','colspan:2');
 $table3->printRow();
 $table3->easyCell('PERTAMA');
 $table3->easyCell(':');
 $table3->easyCell('Terhitung mulai tanggal '.TanggalIndo($sk['tanggal_sk']).' mengangkat :','colspan:2');
 $table3->printRow();
 $table3->endTable();
 
 $table4=new easyTable($pdf, '{35, 5, 8, 45,5,90}','align:L');
 $table4->rowStyle('font-size:12');
 $table4->easyCell('');
 $table4->easyCell('');
 $table4->easyCell('a.');
 $table4->easyCell('Nama');
 $table4->easyCell(':');
 $table4->easyCell(strtoupper($ptk['nama']),'font-size:12;font-style:B');
 $table4->printRow();
 $table4->easyCell('');
 $table4->easyCell('');
 $table4->easyCell('b.');
 $table4->easyCell('Tempat Tanggal Lahir');
 $table4->easyCell(':');
 $table4->easyCell($ptk['tempat_lahir'].', '.TanggalIndo($ptk['tanggal_lahir']));
 $table4->printRow();
 $table4->easyCell('');
 $table4->easyCell('');
 $table4->easyCell('c.');
 $table4->easyCell('Pendidikan Terakhir');
 $table4->easyCell(':');
 $table4->easyCell($sk['pendidikan']);
 $table4->printRow();
 $table4->easyCell('');
 $table4->easyCell('');
 $table4->easyCell('sebagai '.$sk['jenis_ptk'].' Tetap Yayasan Al-Islam untuk mengampu '.$sk['jabatan'].' pada Sekolah di bawah naungan Yayasan Al-Islam','colspan:4');
 $table4->printRow();
 $table4->endTable();
 
 $table5=new easyTable($pdf, '{35, 5, 148}','align:L');
 $table5->rowStyle('font-size:12');
 $table5->easyCell('KEDUA');
 $table5->easyCell(':');
 $table5->easyCell('Kepada yang bersangkutan diberikan gaji dan tunjangan lain sesuai ketentuan Yayasan Al-Islam;');
 $table5->printRow();
 $table5->easyCell('KETIGA');
 $table5->easyCell(':');
 $table5->easyCell('Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila dikemudian hari terdapat kekeliruan dalam keputusan ini akan dilakukan perbaikan sebagaimana mestinya.');
 $table5->printRow();
 $table5->endTable();
 
 $table6=new easyTable($pdf, '{105, 35, 5, 43}','align:L');
 $table6->rowStyle('font-size:12');
 $table6->easyCell('');
 $table6->easyCell('Ditetapkan di');
 $table6->easyCell(':');
 $table6->easyCell('Gabuswetan');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('Pada Tanggal','border:B');
 $table6->easyCell(':','border:B');
 $table6->easyCell(TanggalIndo($sk['tanggal_sk']),'border:B');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('Ketua Yayasan,','colspan:3');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->easyCell('');
 $table6->printRow();
 $table6->easyCell('');
 $table6->easyCell($sk['pengangkat'],'colspan:3;font-style:UB;');
 $table6->printRow();
 
 
 
 $pdf->Output(); 


 

?>