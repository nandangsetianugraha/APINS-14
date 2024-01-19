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
		$nisn=$pn['nisn'];
		$jk=$pn['jk'];
		$ids=$pn['id'];
		$rmb=$row['rombel'];
		$idsw=$row['id_rombel'];
		$namasis=$pn['nama'];
		
		$actionButton = '
				<button class="btn btn-outline-primary btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#info">
					<i class="fa fa-user"></i> Info
				</button>
				<a href="'.base_url().'edit-siswa/'.$idp.'" class="btn btn-outline-success btn-sm me-1 mb-1">
					<i class="fa fa-pencil"></i> Edit
				</a>
				<button class="btn btn-outline-info btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-idsis="'.$idsw.'" data-bs-toggle="modal" data-bs-target="#tempatkan">
					<i class="fa fa-times"></i> Penempatan
				</button>
				<button class="btn btn-outline-danger btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-idsis="'.$idsw.'" data-bs-toggle="modal" data-bs-target="#mutasikan">
					<i class="fa fa-times"></i> Mutasikan
				</button>
				';
		$namasis=$pn['nama'];
		$output['data'][] = array(
			'
			<div class="rich-list-item p-0">
				<div class="rich-list-prepend">
					<div class="avatar avatar-circle avatar-lg">
						<div class="avatar-display">
							<img src="images/siswa/'.$pn['avatar'].'" alt="AI">
						</div>
					</div>
				</div>
				<div class="rich-list-content">
					<h4 class="rich-list-title">'.$namasis.'</h4>
					<span class="rich-list-subtitle">Kelas '.$kelas.'</span>
				</div>
			</div>
			',
			$pn['nik'],
			$pn['nis'],
			$pn['nisn'],
			$pn['tempat'].', '.TanggalIndo($pn['tanggal']),
			$actionButton
		);
	}

// database connection close
$connect->close();

echo json_encode($output);