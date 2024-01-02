<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$output = array('data' => array());
$kelas=substr($kelas,0,1);
$sql = "select * from tema where kelas='$kelas' and smt='$smt' order by tema asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$ids=$s['id_tema'];
	$actionButton = '
	<button class="btn btn-effect-ripple btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editTema"><i class="fa fa-edit"></i></button>
	<button class="btn btn-effect-ripple btn-xs btn-danger" data-tema="'.$ids.'" id="hapus-tema"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		"Tema ".$s['tema'],
		$s['nama_tema'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);