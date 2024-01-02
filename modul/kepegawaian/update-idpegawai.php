<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idpeg'];
	
	$idguru=$_POST['idsis'];
	$idpegawai=strip_tags($connect->real_escape_string($_POST['notema']));
	$sql = "SELECT * FROM id_pegawai WHERE id='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	if(empty($idguru) || empty($idpegawai)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update id_pegawai set pegawai_id='$idpegawai',ptk_id='$idguru' where id='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "ID Pegawai berhasil diperbaharui!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}