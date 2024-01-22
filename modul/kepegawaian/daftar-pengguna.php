<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$level=$_SESSION['level'];
$status=$_GET['status'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$output = array('data' => array());
	$sql = "select * from pengguna where verified='$status' order by nama_lengkap asc";
	$query = $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$idps=$row['id'];
		$idp=$row['ptk_id'];
		$jk=$row['level'];
		$nama = $connect->query("select * from ptk where ptk_id='$idp'")->fetch_assoc();
		$j_ptk = $connect->query("select * from jenis_ptk where jenis_ptk_id='$jk'")->fetch_assoc();
		$actionButton = '
		<button class="btn btn-effect-ripple btn-xs btn-primary" data-tema="'.$idps.'" data-bs-toggle="modal" data-bs-target="#edit-pengguna"><i class="fa fa-pencil"></i> Edit</button>
		<button class="btn btn-effect-ripple btn-xs btn-success" data-tema="'.$idps.'" data-bs-toggle="modal" data-bs-target="#info"><i class="fa fa-calendar"></i> Ubah Level</button>';
		if($status==1){
			$actionButton .= '
			<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="removePengguna('.$idps.')"><i class="fa fa-close"></i> Non-Aktif</button>
			';
		}else{
			$actionButton .= '
			<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="AktifPengguna('.$idps.')"><i class="fa fa-close"></i> Aktifkan</button>
			';
		}
				
		//$tgl=ucfirst(strtolower($row['tempat'])).", ".TanggalIndo($row['tanggal']);
		
		$output['data'][] = array(
			$row['username'],
			$nama['nama'],
			$j_ptk['jenis_ptk'],
			$actionButton
		);
	}
// database connection close
$connect->close();
echo json_encode($output);