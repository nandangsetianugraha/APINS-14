<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idtema'];
	
	$tema=$_POST['notema'];
	$namatema=strip_tags($connect->real_escape_string($_POST['namatema']));
	$sql = "SELECT * FROM tema WHERE id_tema='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	if(empty($tema) || empty($namatema)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update tema set tema='$tema',nama_tema='$namatema' where id_tema='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Tema berhasil diperbaharui!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}