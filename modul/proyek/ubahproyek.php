<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$idproyek=$_POST['idproyek'];
	$tema=$_POST['tema'];
	$fase=$_POST['fase'];
	$nproyek=strip_tags($connect->real_escape_string($_POST['n_proyek']));
	$dproyek=strip_tags($connect->real_escape_string($_POST['d_proyek']));
	if(empty($idproyek) || empty($tema) || empty($fase) || empty($nproyek) || empty($dproyek)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		
			$sql1 = "UPDATE data_proyek set tema='$tema',fase='$fase',nama_proyek='$nproyek',deskripsi_proyek='$dproyek' where id_proyek='$idproyek'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Ubah Proyek berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Saat mengubah Proyek";
			};
		
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}