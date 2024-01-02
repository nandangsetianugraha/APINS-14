<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	//$mp=$_POST['mp'];
	$tapel=$_POST['tapel'];
	$smt=$_POST['smt'];
	$pdid=$_POST['pdid'];
	$ab=substr($kelas,0,1);
	if(empty($smt) || empty($pdid)){
		$validator['success'] = false;
		$validator['messages'] = "Error Input";
	}else{
		$sql2 = "select * from mapel_dta order by id_mapel asc";
		$query2 = $connect->query($sql2);
		while($sl=$query2->fetch_assoc()) {
			$mp=$sl['id_mapel'];
			$rataHar=$connect->query("SELECT AVG(nilai) as rataharian FROM nh_dta WHERE id_pd='$pdid' AND kelas='$ab' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
			$nilaipts=$connect->query("SELECT * FROM pts_dta WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
			$nilaipas=$connect->query("SELECT * FROM pas_dta WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
			$nrapor=round(($rataHar['rataharian']+$nilaipts['nilai']+2*$nilaipas['nilai'])/4,0);
			$cekrapor=$connect->query("SELECT * FROM raport_dta WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->num_rows;
			if($cekrapor>0){
				$idr=$connect->query("SELECT * FROM raport_dta WHERE id_pd='$pdid' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel' AND mapel='$mp'")->fetch_assoc();
				$nilaiRaporlama=$idr['nilai'];
				if($nrapor==$nilaiRaporlama) {
					$validator['success'] = false;
					$validator['messages'] = "Tidak ada perubahan nilai Rapor!!";
				}else{
					$idrp=$idr['id_raport'];
					$sql1 = "UPDATE raport_dta set nilai='$nrapor' WHERE id_raport='$idrp'";
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
				$sql1 = "INSERT INTO raport_dta(id_pd,kelas,smt,tapel,mapel,nilai) VALUES('$pdid','$kelas','$smt','$tapel','$mp','$nrapor')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Rapor berhasil digenerate!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Error Generate Raport???";
				};
			}
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}