<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idpeg'];
	
	$level=$_POST['jenispegawai'];
	if(empty($idr) || empty($level)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "update pengguna set level='$level' where id='$idr'";
		$query = $connect->query($sql);
		$validator['success'] = true;
		$validator['messages'] = "Level Pegawai berhasil diperbaharui!";	
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}