<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "SELECT * FROM shift order by tanggal_awal asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id_shift'];
	$tombol = '
	<button class="btn btn-effect-ripple btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editTema"><i class="fa fa-edit"></i></button>
	<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="removeShift('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		TanggalIndo($row['tanggal_awal']),
		TanggalIndo($row['tanggal_akhir']),
		$row['masuk'],
		$row['keluar'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);