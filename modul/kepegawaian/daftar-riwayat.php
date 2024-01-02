<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idptk=$_GET['idptk'];
$output = array('data' => array());

$sql = "SELECT * FROM riwayat_pendidikan where ptk_id='$idptk' order by jenjang asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id_riwayat'];
	$idj=$row['jenjang'];
	$tombol = '
	<button class="btn btn-icon btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editTema"><i class="fa fa-edit"></i></button>
	<button class="btn btn-icon btn-xs btn-danger" onclick="removeRiwayat('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$jnj=$connect->query("select * from jenjang_pendidikan where id_jenjang='$idj'")->fetch_assoc();
	$output['data'][] = array(
		$jnj['nama_jenjang'],
		$row['nama_jenjang'],
		$row['fakultas'],
		$row['tahun_masuk'],
		$row['tahun_keluar'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);