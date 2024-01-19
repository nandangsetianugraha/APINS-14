<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$level=$_SESSION['level'];
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$output = array('data' => array());

	$sql = "SELECT * FROM penempatan WHERE rombel='$kelas' AND tapel='$tapel' AND smt='$smt' order by nama asc";
	$query = $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$idp=$row['peserta_didik_id'];
		$sqlp = "SELECT * FROM siswa WHERE peserta_didik_id='$idp'";
		$pn = $connect->query($sqlp)->fetch_assoc();
		//$idrmb = $connect->query("penempatan WHERE peserta_didik_id='$idp' and tapel='$tapel' AND smt='$smt'")->fetch_assoc();
		//$idr=$idrmb['id_rombel'];
		$nisn=$pn['nisn'];
		$jk=$pn['jk'];
		$ids=$pn['id'];
		$rmb=$row['rombel'];
		$idsw=$row['id_rombel'];
		$namasis=$pn['nama'];
		
		$actionButton = '
				<button class="btn btn-outline-success btn-sm me-1 mb-1" onclick="keluarkan(\''.$idsw.'\')">
					<i class="fa fa-reply"></i>
				</button>
				';
		$namasis=$pn['nama'];
		$output['data'][] = array(
			$actionButton.' '.$pn['nama'],
			$pn['nis'],
			$pn['nisn']
		);
	}

// database connection close
$connect->close();

echo json_encode($output);