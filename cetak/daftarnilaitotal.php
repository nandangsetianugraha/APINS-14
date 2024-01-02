<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
 
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$mapel=$_GET['mapel'];
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
		$namamapel=$connect->query("select * from mapel where id_mapel='$mapel'")->fetch_assoc();
		$namafilenya="Rekapitulasi Nilai Raport Pengetahuan ".$kelas.".pdf";
		$pdf=new exFPDF('L','mm',array(330,215));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',12);

		$table2=new easyTable($pdf, 2);
		$table2->easyCell('REKAPITULASI NILAI PENGETAHUAN '.$kelas,'colspan:2;align:C;font-style:B');
		$table2->printRow();
		$table2->easyCell('Mata Pelajaran : '.$namamapel['nama_mapel'],'align:L;');
		$table2->easyCell('Semester : '.$smt.' Tahun Pelajaran : '.$tapel,'align:R');
		$table2->printRow();
		$table2->endTable();
		$skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
		$qkl = $connect->query($skl);
		while($sis=$qkl->fetch_assoc()){
			$idp=$sis['peserta_didik_id'];
			$table2=new easyTable($pdf, 2);
			$table2->easyCell('Nama Siswa : '.$sis['nama'],'align:L;');
			$table2->easyCell('','align:R');
			$table2->printRow();
			$table2->endTable();
			$peta = $connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mapel'")->num_rows;
			$jumcol=$peta*3+5;
			$table3=new easyTable($pdf, $jumcol,'align:L;border:1');
			$table3->rowStyle('font-size:11');
			$table3->easyCell('K D','rowspan:2;align:C');
			$pemetaan = $connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mapel' order by tema asc");
			while($pet=$pemetaan->fetch_assoc()){
				$table3->easyCell($pet['tema'],'colspan:3;align:C');
			}
			$table3->easyCell('NPH','rowspan:2;align:C');
			$table3->easyCell('NPTS','rowspan:2;align:C');
			$table3->easyCell('NPAS','rowspan:2;align:C');
			$table3->easyCell('N A','rowspan:2;align:C');
			$table3->printRow();
			$table3->rowStyle('font-size:10');
			for ($i=1; $i < $peta+1; $i++) { 
			  $table3->easyCell('UH','align:C');
			  $table3->easyCell('TG1','align:C');
			  $table3->easyCell('TG2','align:C');
			};
			$table3->printrow(true);
			$nkd = $connect->query("select * from kd where kelas='$ab' and aspek='3' and mapel='$mapel' order by kd asc");
			while($kdku=$nkd->fetch_assoc()){
				$idkd=$kdku['kd'];
				$table3->easyCell($kdku['kd'],'align:C');
				$ntema = $connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mapel' order by tema asc");
				while($temaku=$ntema->fetch_assoc()){ 
				  $idtema=$temaku['tema'];
				  $nilai1=$connect->query("select * from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and tema='$idtema' and kd='$idkd' and jns='tls'")->fetch_assoc();
				  $nilai2=$connect->query("select * from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and tema='$idtema' and kd='$idkd' and jns='tgs1'")->fetch_assoc();
				  $nilai3=$connect->query("select * from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and tema='$idtema' and kd='$idkd' and jns='lsn'")->fetch_assoc();
				  if(empty($nilai1['nilai'])){
					  $table3->easyCell('','bgcolor:#acaeaf;');
				  }else{
					  $table3->easyCell(number_format($nilai1['nilai'],0),'align:C');
				  };
				  if(empty($nilai2['nilai'])){
					  $table3->easyCell('','bgcolor:#acaeaf;');
				  }else{
					  $table3->easyCell(number_format($nilai2['nilai'],0),'align:C');
				  };
				  if(empty($nilai3['nilai'])){
					  $table3->easyCell('','bgcolor:#acaeaf;');
				  }else{
					  $table3->easyCell(number_format($nilai3['nilai'],0),'align:C');
				  };
				};
				$nph=$connect->query("select avg(nilai) as rharian from nh where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and kd='$idkd'")->fetch_assoc();
				if(empty($nph['rharian'])){
				  $table3->easyCell('','bgcolor:#acaeaf;');
				}else{
				  $table3->easyCell(number_format($nph['rharian'],0),'align:C');
				};
				$nts=$connect->query("select * from nuts where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and kd='$idkd'")->fetch_assoc();
				$nas=$connect->query("select * from nats where id_pd='$idp' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mapel' and kd='$idkd'")->fetch_assoc();
				if(empty($nts['nilai'])){
				  $table3->easyCell('','bgcolor:#acaeaf;');
				}else{
				  $table3->easyCell(number_format($nts['nilai'],0),'align:C');
				};
				if(empty($nas['nilai'])){
				  $table3->easyCell('','bgcolor:#acaeaf;');
				}else{
				  $table3->easyCell(number_format($nas['nilai'],0),'align:C');
				};
				if(empty($nph['rharian'])){
					if(empty($nts['nilai'])){
						if(empty($nas['nilai'])){
							$akhir=0;
						}else{
							$akhir=$nas['nilai'];
						};
					}else{
						if(empty($nas['nilai'])){
							$akhir=$nts['nilai'];
						}else{
							$akhir=($nas['nilai']+$nts['nilai'])/2;
						};
					};
				}else{
					if(empty($nts['nilai'])){
						if(empty($nas['nilai'])){
							$akhir=$nph['rharian'];
						}else{
							$akhir=(2*$nph['rharian']+$nas['nilai'])/3;
						};
					}else{
						if(empty($nas['nilai'])){
							$akhir=(2*$nph['rharian']+$nts['nilai'])/3;
						}else{
							$akhir=(2*$nph['rharian']+$nas['nilai']+$nts['nilai'])/4;
						};
					};
				};
				$table3->easyCell(number_format($akhir,0),'align:C');
				$table3->printrow();
			};
			$table3->endTable();
			$pdf->AddPage();
		};
		
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
		 


 

?>