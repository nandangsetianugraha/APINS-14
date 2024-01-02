<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$tapel=$_POST['ptapel'];
	$smt=$_POST['psmt'];
	$status=$_POST['pstatus'];
    $tutup=$_POST['pdok'];
    $tanggal=$_POST['twaktu'];
	$sql = "UPDATE konfigurasi SET tapel='$tapel', semester='$smt', maintenis='$status' WHERE id_conf='1'";
    $sql2 = "UPDATE setting_dokumen SET tutup='$tutup', tanggal='$tanggal' WHERE id_setting='1'";
	$query = $connect->query($sql);
    $query2 = $connect->query($sql2);
	if($query === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Status Server berhasil diubah!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}