<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
 
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$tahun1=substr($tapel,0,4);
	$tahun2=substr($tapel,5,4);
	$smt=$_GET['smt'];
		$namafilenya="Daftar Penyerahan Raport ".$kelas." Semester ".$smt." Tahun Pelajaran ".$tahun1."-".$tahun2.".pdf";
		$pdf=new exFPDF('L','mm',array(330,215));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, '{5,5,5,5,5,5,5,5,5,5,5,5,115,115}');
		$table2->easyCell('Nomor Statistik Sekolah','colspan:12;align:C;font-style:B');
		$table2->easyCell('','align:L;');
		$table2->easyCell('Format PK-7a','align:R;font-style:B');
		$table2->printRow();
		$table2->easyCell('1','align:C;border:1');
		$table2->easyCell('0','align:C;border:1');
		$table2->easyCell('2','align:C;border:1');
		$table2->easyCell('0','align:C;border:1');
		$table2->easyCell('2','align:C;border:1');
		$table2->easyCell('1','align:C;border:1');
		$table2->easyCell('8','align:C;border:1');
		$table2->easyCell('0','align:C;border:1');
		$table2->easyCell('3','align:C;border:1');
		$table2->easyCell('0','align:C;border:1');
		$table2->easyCell('3','align:C;border:1');
		$table2->easyCell('1','align:C;border:1');
		$table2->easyCell('','align:C');
		$table2->easyCell('','align:C');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14; font-style:B;');
		$table2->easyCell('DAFTAR PENYERAHAN RAPORT', 'align:C;');
		$table2->printRow();
		$table2->rowStyle('font-size:14; font-style:B;');
		$table2->easyCell('SEMESTER '.$smt.' TAHUN PELAJARAN '.$tapel, 'align:C;');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{30,4,256}');
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Nama Sekolah','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Status Sekolah','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('S W A S T A','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Alamat','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Desa/Kelurahan','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Gabuswetan','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Kecamatan','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Gabuswetan','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Kabupaten','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Indramayu','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:10; font-style:B;');
		$table2->easyCell('Provinsi','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell('Jawa Barat','align:L');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{10,25,85,55,40,55,40}','border:1');
		$table2->rowStyle('font-size:11; font-style:B;');
		$table2->easyCell('No','align:C');
		$table2->easyCell('Nomor Induk Siswa','align:C');
		$table2->easyCell('Nama Siswa','align:C');
		$table2->easyCell('Nama Pengambil','align:C');
		$table2->easyCell('Tanggal Pengambilan','align:C');
		$table2->easyCell('Tanda Tangan','align:C');
		$table2->easyCell('Tanggal Pengembalian','align:C');
		$table2->printRow(true);
		$skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
		$qkl = $connect->query($skl);
		$nomor=0;
		while($sis=$qkl->fetch_assoc()){
			$nomor++;
			$idp=$sis['peserta_didik_id'];
			$sw=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
			$table2->rowStyle('font-size:11; min-height:12;');
			$table2->easyCell($nomor,'align:C');
			$table2->easyCell($sw['nis'],'align:C');
			$table2->easyCell($sw['nama'],'align:L');
			$table2->easyCell('','align:L');
			$table2->easyCell('','align:L');
			$table2->easyCell($nomor,'align:L');
			$table2->easyCell('','align:L');
			$table2->printRow();
		};
		$table2->endTable();
		//selesai isi tabel siswa
		
		
		//Tertanda Wali Kelas 
		$ttd=new easyTable($pdf, '{50,71,6,72,111}');
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('Gabuswetan, ............................ 20.......','align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('Guru Kelas '.$kelas,'align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:12');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('___________________________','align:C; valign:T');
		$ttd->printRow();
		$ttd->endTable();
		
			$pdf->Output('D',$namafilenya);
		 


 

?>