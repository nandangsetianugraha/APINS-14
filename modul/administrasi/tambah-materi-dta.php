<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$mapel=$_POST['mapel'];
	$n_materi=strip_tags($connect->real_escape_string($_POST['n_proyek']));
	$d_materi=strip_tags($connect->real_escape_string($_POST['d_proyek']));
	if(empty($kelas) || empty($mapel) || empty($n_materi) || empty($d_materi)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql1 = "insert into materi_dta(kelas,smt,mapel,lm,nama_lm) values('$kelas','$smt','$mapel','$n_materi','$d_materi')";
		$query1 = $connect->query($sql1);
		if($query1 === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "ateri berhasil ditambahkan";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Error Saat menambahkan materi";
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}