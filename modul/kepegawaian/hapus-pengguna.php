<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['member_id'];
	if(empty($idr)){
		$validator['success'] = false;
		$validator['messages'] = "Error! Saat Menghapus Pengguna";
	}else{
			$sql = "DELETE from pengguna where id='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Pengguna berhasil dihapus!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}