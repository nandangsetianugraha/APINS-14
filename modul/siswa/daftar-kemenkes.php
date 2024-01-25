<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idptk=$_GET['idptk'];
$output = array('data' => array());

$sql = "SELECT * FROM data_kemenkes where peserta_didik_id='$idptk'";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id'];
	$tombol = '
	<button class="btn btn-icon btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editKes"><i class="fa fa-edit"></i></button>
	<button class="btn btn-icon btn-xs btn-danger" onclick="removeKes('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		$row['jenis'],
		$row['tanggal'],
		$row['tempat'],
		$row['tipe'],
		$row['dosis'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);