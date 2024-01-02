<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idptk=$_GET['idptk'];
$output = array('data' => array());

$sql = "SELECT * FROM anak where ptk_id='$idptk'";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$ids=$row['id_anak'];
	$idj=$row['jenjang'];
	$tombol = '
	<button class="btn btn-icon btn-xs btn-primary" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#editTema"><i class="fa fa-edit"></i></button>
	<button class="btn btn-icon btn-xs btn-danger" onclick="removeAnak('.$ids.')"> <i class="fa fa-trash"></i></button>
	';
	$sts=$row['status'];
	$jkel=$row['jk'];
	if($sts=='ak')
		$statusanak='Anak Kandung';
	if($jkel=='L')
		$jkanak='Laki-laki';
	else
		$jkanak='Perempuan';
	if($sts=='at')
		$statusanak='Anak Tiri';
	if($sts=='aa')
		$statusanak='Anak Angkat';
	$jnj=$connect->query("select * from jenjang_pendidikan where id_jenjang='$idj'")->fetch_assoc();
	$output['data'][] = array(
		$row['nama'],
		$statusanak,
		$jkanak,
		$row['tempat_lahir'].', '.$row['tanggal_lahir'],
		$jnj['nama_jenjang'],
		$row['nisn'],
		$row['tahun_masuk'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);