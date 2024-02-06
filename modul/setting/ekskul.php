<?php 

require_once '../../config/db_connect.php';
$output = array('data' => array());

	$sql = "select * from ekskul order by id_ekskul asc";
	$query = $connect->query($sql);
	while($s=$query->fetch_assoc()) {
		$ids=$s['id_ekskul'];
		$actionButton = '
		<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info"><i class="fa fa-edit"></i></a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="hapusEkskul('.$ids.')"> <i class="fa fa-trash"></i></button>
		';
		$output['data'][] = array(
			$s['id_ekskul'],
			$s['nama_ekskul'],
			$actionButton
		);
		
	};


	

// database connection close
$connect->close();

echo json_encode($output);