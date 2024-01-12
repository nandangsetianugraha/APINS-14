<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$namasekolah=$_POST['nama_sekolah'];
	$alamat=$_POST['alamat'];
	$sql = "UPDATE konfigurasi SET nama_sekolah='$namasekolah', alamat_sekolah='$alamat' WHERE id_conf='1'";
    $query = $connect->query($sql);
    if($query === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Identitas Sekolah berhasil diubah!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}