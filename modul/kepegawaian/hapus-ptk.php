<?php require_once '../../config/db_connect.php';$output = array('success' => false, 'messages' => array());$idp = $_POST['member_id'];	$sql = "DELETE from ptk where id='$idp'";	$query = $connect->query($sql);	if($query === TRUE) {		$output['success'] = true;		$output['messages'] = 'PTK Berhasil dihapus';	} else {		$output['success'] = false;		$output['messages'] = 'Error saat mencoba menghapus PTK';	}// close database connection$connect->close();echo json_encode($output);