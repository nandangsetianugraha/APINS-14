<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$level=$_SESSION['level'];
$status=$_GET['status'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$output = array('data' => array());

	$sql = "SELECT * FROM siswa WHERE status='$status' order by nama asc";
	$query = $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$idp=$row['peserta_didik_id'];
		$sqlp = "SELECT * FROM penempatan WHERE peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'";
		$pn = $connect->query($sqlp)->fetch_assoc();
		$cek = $connect->query($sqlp)->num_rows;
		$nisn=$row['nisn'];
		$jk=$row['jk'];
		$ids=$row['id'];
		$rmb=$pn['rombel'];
		$idsw=$pn['id_rombel'];
		$namasis=$row['nama'];
		if($status!='1'){
		$actionButton = '
				<button class="btn btn-outline-success btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#info">
					<i class="fa fa-user"></i> Info
				</button>
				<a href="'.base_url().'edit-siswas/'.$idp.'" class="btn btn-outline-primary btn-sm me-1 mb-1">
					<i class="fa fa-pencil"></i> Edit
				</a>
				<button class="btn btn-outline-danger btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-idsis="'.$idsw.'" data-bs-toggle="modal" data-bs-target="#mutasikan">
					<i class="fa fa-times"></i> Aktifkan
				</button>
				<button class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="HapusSiswa('.$ids.')"><i class="fa fa-trash"></i> Hapus</button>
				';
		}else{
		$actionButton = '
				<button class="btn btn-outline-success btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#info">
					<i class="fa fa-user"></i> Info
				</button>
				<a href="'.base_url().'edit-siswas/'.$idp.'" class="btn btn-outline-primary btn-sm me-1 mb-1">
					<i class="fa fa-pencil"></i> Edit
				</a>
				<button class="btn btn-outline-info btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-idsis="'.$idsw.'" data-bs-toggle="modal" data-bs-target="#tempatkan">
					<i class="fa fa-times"></i> Penempatan
				</button>
				<button class="btn btn-outline-danger btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-idsis="'.$idsw.'" data-bs-toggle="modal" data-bs-target="#mutasikan">
					<i class="fa fa-times"></i> Mutasikan
				</button>
				<button class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="HapusSiswa('.$ids.')"><i class="fa fa-trash"></i> Hapus</button>
				';
		}
		$namasis=$row['nama'];
		if($cek>0){
			$kelas = 'Kelas '.$rmb;
		}else{
			$kelas = '';
		};
		$output['data'][] = array(
			'
			<div class="rich-list-item p-0">
				<div class="rich-list-prepend">
					<div class="avatar avatar-circle avatar-lg">
						<div class="avatar-display">
							<img src="images/siswa/'.$row['avatar'].'" alt="AI">
						</div>
					</div>
				</div>
				<div class="rich-list-content">
					<h4 class="rich-list-title">'.$namasis.'</h4>
				</div>
			</div>
			',
			$row['nik'],
			$row['nis'],
			$row['nisn'],
			$row['tempat'].', '.TanggalIndo($row['tanggal']),
			$kelas,
			$actionButton
		);
	}

// database connection close
$connect->close();

echo json_encode($output);