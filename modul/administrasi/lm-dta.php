<?php 

require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$mp=$_GET['mp'];
$output = array('data' => array());

$sql = "select * from materi_dta where kelas='$kelas' and smt='$smt' and mapel='$mp' order by lm asc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$ids=$s['id_lm'];
	$actionButton = '
	<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info"><i class="fa fa-edit"></i></a>
	<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="removeMateri('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		$s['lm'],
		$s['nama_lm'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);