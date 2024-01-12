<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../inc/db_connect.php';
 
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
		$namamapel=$connect->query("select * from mata_pelajaran order by id_mapel asc")->fetch_assoc();
		$namafilenya="Rekapitulasi Nilai Rapor IKM ".$kelas.".pdf";
		$pdf=new exFPDF('L','mm',array(330,215));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, 2);
		$table2->easyCell('REKAPITULASI NILAI RAPOR '.$kelas,'colspan:2;align:C;font-style:B');
		$table2->printRow();
		$table2->easyCell('Semester : '.$smt,'align:L;');
		$table2->easyCell(' Tahun Pelajaran : '.$tapel,'align:R');
		$table2->printRow();
		$table2->endTable();
		
		$table3=new easyTable($pdf, '{106, 17,17,17,17,17,17,17,17,17,17,17,17}','align:L;border:1');
		$table3->rowStyle('font-size:10');
		$table3->easyCell('Nama Siswa','rowspan:2;align:C;valign:M');
		$table3->easyCell('Mata Pelajaran','colspan:9;align:C;valign:M');
		$table3->easyCell('Jumlah','rowspan:2;align:C;valign:M');
		$table3->easyCell('Rata2','rowspan:2;align:C;valign:M');
		$table3->easyCell('Rank','rowspan:2;align:C;valign:M');
		$table3->printRow();
		$table3->rowStyle('font-size:10');
		$sql = "select * from mata_pelajaran order by id_mapel asc";
		$query = $connect->query($sql);
		while ($row = $query->fetch_assoc()) {
		  $table3->easyCell($row['kd_mapel'],'align:C;valign:M');
		};
		$table3->printrow(true);
		
		$sql1 = "select id_pd,jumlah,(select find_in_set(jumlah,(select group_concat(distinct jumlah order by jumlah desc separator ',') from ranking_ikm where kelas='$kelas' AND smt='$smt' AND tapel='$tapel'))) as ranking from ranking_ikm where kelas='$kelas' AND smt='$smt' AND tapel='$tapel' order by ranking asc";
		$query1 = $connect->query($sql1);
		$jsiswa=$connect->query("select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt'")->num_rows;
		$jum=array();
		$jum[1]=0;$jum[2]=0;$jum[3]=0;$jum[4]=0;$jum[5]=0;$jum[6]=0;$jum[7]=0;$jum[8]=0;$jum[9]=0;$jum[10]=0;$jum[11]=0;
		while ($nm = $query1->fetch_assoc()) {
			$idp=$nm['id_pd'];
          	$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
			$table3->rowStyle('font-size:12; min-height:10');
			$table3->easyCell($nama['nama'],'align:L;valign:M');
			$sql2 = "select * from mata_pelajaran order by id_mapel asc";
			$query2 = $connect->query($sql2);
			while ($mpl = $query2->fetch_assoc()) {
				$idm=$mpl['id_mapel'];
				$ada=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->num_rows;
				if($ada>0){
					$nh=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->fetch_assoc();
					$nilai=number_format($nh['nilai'],0);
					$jum[$idm]=$jum[$idm]+$nilai;
				}else{
					$nilai="";
					$jum[$idm]=$jum[$idm]+0;
				};
				//$nilaim=$connect->query("select * from mata_pelajaran order by id_mapel asc")->fetch_assoc();
				$table3->easyCell($nilai,'align:C;valign:M');
			};
			$jumlah=$connect->query("select sum(nilai) as jumlah from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
			$total=$jumlah['jumlah'];
			$jum[10]=$jum[10]+$total;
			$table3->easyCell(number_format($total,0),'align:C;valign:M');
			$rerata=$connect->query("select AVG(nilai) as rerata from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
			$jum[11]=$jum[11]+$rerata['rerata'];
			$table3->easyCell(number_format($rerata['rerata'],2),'align:C;valign:M');
			$ranking=$connect->query("select id_pd,jumlah,(select find_in_set(jumlah,(select group_concat(distinct jumlah order by jumlah desc separator ',') from ranking_ikm where kelas='$kelas' AND smt='$smt' AND tapel='$tapel'))) as ranking from ranking_ikm where id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
			$table3->easyCell($ranking['ranking'],'align:C;valign:M');
			$table3->printRow();
		};
		$table3->rowStyle('font-size:12; min-height:10');
		$table3->easyCell('Jumlah','align:R;valign:M');
		for ($i=1; $i < 12; $i++) {
			$table3->easyCell(number_format($jum[$i],0),'align:C;valign:M');
		};
		$table3->easyCell('','align:C;valign:M');
		$table3->printRow();
		$table3->rowStyle('font-size:12; min-height:10');
		$table3->easyCell('Rata-rata','align:R;valign:M');
		for ($i=1; $i < 12; $i++) {
			$table3->easyCell(number_format($jum[$i]/$jsiswa,2),'align:C;valign:M');
		};
		$table3->easyCell('','align:C;valign:M');
		$table3->printRow();
		
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
		$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>