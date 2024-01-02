<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../config/db_connect.php';
 
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
		$namamapel=$connect->query("select * from mapel order by id_mapel asc")->fetch_assoc();
		$namafilenya="Rekapitulasi Nilai Raport Pengetahuan ".$kelas.".pdf";
		$pdf=new exFPDF('L','mm',array(330,215));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',12);

		$table2=new easyTable($pdf, 2);
		$table2->easyCell('REKAPITULASI NILAI RAPORT PENGETAHUAN '.$kelas,'colspan:2;align:C;font-style:B');
		$table2->printRow();
		$table2->easyCell('Semester : '.$smt,'align:L;');
		$table2->easyCell(' Tahun Pelajaran : '.$tapel,'align:R');
		$table2->printRow();
		$table2->endTable();
		
		$table3=new easyTable($pdf, '{120, 12,12,12,12,12,12,12,12,12,12,12,12,17,17,12}','align:L;border:1');
		$table3->rowStyle('font-size:11');
		$table3->easyCell('Nama Siswa','rowspan:2;align:C');
		$table3->easyCell('Mata Pelajaran','colspan:12;align:C');
		$table3->easyCell('Jumlah','rowspan:2;align:C');
		$table3->easyCell('Rata2','rowspan:2;align:C');
		$table3->easyCell('Rank','rowspan:2;align:C');
		$table3->printRow();
		$table3->rowStyle('font-size:10');
		for ($i=1; $i < 13; $i++) { 
		  $mapelnya=$connect->query("select * from mapel where id_mapel='$i'")->fetch_assoc();
		  $table3->easyCell($mapelnya['kd_mapel'],'align:C');
		};
		$table3->printrow(true);
		$skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
		$qkl = $connect->query($skl);
		while($sis=$qkl->fetch_assoc()){
			$idp=$sis['peserta_didik_id'];
			$sw=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
			$table3->easyCell($sw['nama'],'align:L');
			for ($i=1; $i < 13; $i++) { 
			  $nr=$connect->query("select * from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$i' and jns='k3'")->fetch_assoc();
			  if(empty($nr['nilai'])){
				  $table3->easyCell('','bgcolor:#acaeaf;');
			  }else{
				 $table3->easyCell(number_format($nr['nilai'],0),'align:C'); 
			  }
			  
			};
			$nto=$connect->query("select sum(nilai) as total from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k3'")->fetch_assoc();
			$nrt=$connect->query("select avg(nilai) as rerata from raport_k13 where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and jns='k3'")->fetch_assoc();
			$table3->easyCell(number_format($nto['total'],0),'align:C');
			$table3->easyCell(number_format($nrt['rerata'],0),'align:C');
			$table3->easyCell('','align:C');
			$table3->printRow();
		};
		$table3->endTable();
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