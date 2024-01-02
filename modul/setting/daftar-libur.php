<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//$tapel=$_GET['tapel'];
$output = array('data' => array());

$sql = "SELECT * FROM harilibur order by tanggal_awal desc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id'];
	$tombol = '
	<button class="btn btn-icon btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editTema"><i class="fa fa-edit"></i></button>
	<button class="btn btn-icon btn-xs btn-danger" onclick="removeLibur('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$output['data'][] = array(
		TanggalIndo($row['tanggal_awal']),
		TanggalIndo($row['tanggal_akhir']),
		$row['keterangan'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);