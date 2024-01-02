<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['member_id'];
	if(empty($idr)){
		$validator['success'] = false;
		$validator['messages'] = "Error! Saat Menonaktifkan Pengguna";
	}else{
			$sql = "update pengguna set verified='1' where id='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Pengguna berhasil dinonaktifkan!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}