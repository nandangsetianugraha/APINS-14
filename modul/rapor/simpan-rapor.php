<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$mp=$_POST['mp'];
	$tapel=$_POST['tapel'];
	$smt=$_POST['smt'];
	$pdid=$_POST['pdid'];
	$ab=substr($kelas,0,1);
	if(empty($smt) || empty($pdid)){
		$validator['success'] = false;
		$validator['messages'] = "Error Input";
	}else{
		$ceksts=$connect->query("SELECT * FROM sts WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->num_rows;
		$ceksas=$connect->query("SELECT * FROM sas WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->num_rows;
		if($ceksts==0 or $ceksas==0){
			$validator['success'] = false;
			$validator['messages'] = "Nilai STS atau SAS masih kosong!";
		};
		$kelebihan=$connect->query("SELECT * FROM formatif WHERE id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp' order by nilai desc")->fetch_assoc();
		$kelemahan=$connect->query("SELECT * FROM formatif WHERE id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp' order by nilai asc")->fetch_assoc();
		$lm1=$kelebihan['lm'];
		$tp1=$kelebihan['tp'];
		$lm2=$kelemahan['lm'];
		$tp2=$kelemahan['tp'];
		$tujuan1=$connect->query("SELECT * FROM tp WHERE kelas='$ab' AND lm='$lm1' AND tp='$tp1' AND mapel='$mp'")->fetch_assoc();
		$tujuan2=$connect->query("SELECT * FROM tp WHERE kelas='$ab' AND lm='$lm2' AND tp='$tp2' AND mapel='$mp'")->fetch_assoc();
		$deskripsi1="Menunjukkan pemahaman sangat baik dalam ".$tujuan1['nama_tp'];
		$deskripsi2="Perlu bantuan dalam ".$tujuan2['nama_tp'];
		$nDesL=$deskripsi1."|".$deskripsi2;
		$nDes=strip_tags($connect->real_escape_string($nDesL));
		$rataFor=$connect->query("SELECT AVG(nilai) as rataformatif FROM formatif WHERE id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
		$rataSum=$connect->query("SELECT AVG(nilai) as ratasumatif FROM sumatif WHERE id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
		$nilaiSTS=$connect->query("SELECT * FROM sts WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
		$nilaiSAS=$connect->query("SELECT * FROM sas WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
		$nilaiRapor=round(($rataFor['rataformatif']+$rataSum['ratasumatif']+$nilaiSTS['nilai']+$nilaiSAS['nilai'])/4,0);
		$cekrapor=$connect->query("SELECT * FROM raport_ikm WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->num_rows;
		if($cekrapor>0){
			$idr=$connect->query("SELECT * FROM raport_ikm WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
			$nilaiRaporlama=$idr['nilai'];
			$deslama=$idr['deskripsi'];
			if($nilaiRapor==$nilaiRaporlama and $nDes==$deslama) {
				$validator['success'] = false;
				$validator['messages'] = "Tidak ada perubahan nilai Rapor!!";
			}else{
				$idrp=$idr['id_raport'];
				$sql1 = "UPDATE raport_ikm set nilai='$nilaiRapor', deskripsi='$nDes' WHERE id_raport='$idrp'";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Rapor berhasil diupdate!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Error update raport???";
				};
			};
		}else{
			$sql1 = "INSERT INTO raport_ikm(id_pd,kelas,smt,tapel,mapel,nilai,deskripsi) VALUES('$pdid','$kelas','$smt','$tapel','$mp','$nilaiRapor','$nDes')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Rapor berhasil digenerate!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Generate Raport???";
			};
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}