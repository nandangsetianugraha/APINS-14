<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$level=$_SESSION['level'];
$status=$_GET['status'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$output = array('data' => array());
	$sql = "select * from ptk where status_keaktifan_id='$status' order by nama asc";
	$query = $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$idp=$row['ptk_id'];
		$ids = $row['id'];
		$jk=$row['jenis_kelamin'];
		
		
		$gmb='
		<div class="avatar avatar-label-info">
			<div class="avatar-display">
				<img alt="AI" src="'.base_url().'images/ptk/'.$row['gambar'].'" class=" img-fluid">
			</div>
		</div>
		';
		if($status==1){
		$actionButton = '
				<a href="'.base_url().'edit-ptk/'.$idp.'" type="button" class="btn btn-outline-success btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'"><i class="fa fa-pencil"></i> Edit</a>
				<button type="button" class="btn btn-outline-info btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#mutasikan"><i class="fa fa-user-times"></i> Mutasi</button>
				<button type="button" class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="hapusPTK('.$ids.')"><i class="fa fa-trash"></i> Hapus</button>
				';
		}else{
		$actionButton = '
				<a href="'.base_url().'edit-ptk/'.$idp.'" type="button" class="btn btn-outline-success btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'"><i class="fa fa-pencil"></i> Edit</a>
				<button type="button" class="btn btn-outline-info btn-sm me-1 mb-1" data-smt="'.$smt.'" data-tapel="'.$tapel.'" data-siswa="'.$idp.'" data-bs-toggle="modal" data-bs-target="#mutasikan"><i class="fa fa-user-times"></i> Aktifkan</button>
				<button type="button" class="btn btn-outline-danger btn-sm me-1 mb-1" onclick="hapusPTK('.$ids.')"><i class="fa fa-trash"></i> Hapus</button>
				';
		}
		//$tgl=ucfirst(strtolower($row['tempat'])).", ".TanggalIndo($row['tanggal']);
		$namasis=$row['nama'];
		$output['data'][] = array(
			$gmb,
			$namasis,
			$row['niy_nigk'],
			$row['nuptk'],
			$row['tempat_lahir'].', '.TanggalIndo($row['tanggal_lahir']),
			$actionButton
		);
	}
// database connection close
$connect->close();
echo json_encode($output);