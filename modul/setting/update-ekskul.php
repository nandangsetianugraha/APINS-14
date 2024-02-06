<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$rowid=strip_tags($connect->real_escape_string($_POST['ids']));
	$eks=strip_tags($connect->real_escape_string($_POST['eks']));
	if(empty($eks)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		
			
			$sql1 = "update ekskul set nama_ekskul='$eks' where id_ekskul='$rowid'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Perubahan Ekstrakurikuler berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}