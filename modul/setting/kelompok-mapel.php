<?php 

require_once '../../config/db_connect.php';
$kur=$_GET['kurikulum'];
$output = array('data' => array());
	$sql = "select * from kelompok_mapel where kurikulum='$kur' order by urut asc";
	$query = $connect->query($sql);
	while($s=$query->fetch_assoc()) {
		$ids=$s['id_kelompok'];
		$actionButton = '
		<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-kur="'.$kur.'" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info"><i class="fa fa-edit"></i></a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="hapusKelompok('.$ids.')"> <i class="fa fa-trash"></i></button>
		';
		$output['data'][] = array(
			$s['urut'],
			$s['kelompok'],
			$actionButton
		);
		
	};


// database connection close
$connect->close();

echo json_encode($output);