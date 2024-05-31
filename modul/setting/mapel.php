<?php 

require_once '../../config/db_connect.php';
$kur=$_GET['kurikulum'];
$output = array('data' => array());
if($kur==='Kurikulum 2013'){
	$sql = "select * from mapel order by urutan asc";
	$query = $connect->query($sql);
	while($s=$query->fetch_assoc()) {
		$ids=$s['id_mapel'];
		$idk = $s['kd_kelompok'];
		$klp=$connect->query("select * from kelompok_mapel where id_kelompok='$idk'")->fetch_assoc();
		$actionButton = '
		<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-kur="'.$kur.'" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info"><i class="fa fa-edit"></i></a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="hapusMapel('.$ids.')"> <i class="fa fa-trash"></i></button>
		';
		$output['data'][] = array(
			$klp['kelompok'],
			$s['urutan'],
			$s['kd_mapel'],
			$s['nama_mapel'],
			$actionButton
		);
		
	};
}elseif($kur==='Kurikulum Merdeka'){
	$sql = "select * from mata_pelajaran order by id_mapel asc";
	$query = $connect->query($sql);
	while($s=$query->fetch_assoc()) {
		$ids=$s['id_mapel'];
		$idk = $s['kd_kelompok'];
		$klp=$connect->query("select * from kelompok_mapel where id_kelompok='$idk'")->fetch_assoc();
		$actionButton = '
		<a href="#" class="btn btn-effect-ripple btn-xs btn-primary" type="button" data-kur="'.$kur.'" data-tema="'.$ids.'" data-bs-toggle="modal" data-bs-target="#edit-info"><i class="fa fa-edit"></i></a>
		<button class="btn btn-effect-ripple btn-xs btn-danger" onclick="hapusMapel('.$ids.')"> <i class="fa fa-trash"></i></button>
		';
		$output['data'][] = array(
			$klp['kelompok'],
			$s['urutan'],
			$s['kd_mapel'],
			$s['nama_mapel'],
			$actionButton
		);
		
	};
}else{
	
};

	

// database connection close
$connect->close();

echo json_encode($output);