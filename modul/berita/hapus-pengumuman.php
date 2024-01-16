<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
if($_POST) {
	$validator = array('success' => false, 'messages' => array());
	$idartikel = $_POST['member_id'];
	//$slug = $_POST['slug'];
	$sqls = "DELETE from pengumuman where id='$idartikel'";
	$query1 = $connect->query($sqls);
	if($query1 === TRUE) {	
		$validator['success'] = true;
		$validator['messages'] = "Pengumuman berhasil dihapus!";			  
	}else{
		$validator['success'] = false;
		$validator['messages'] = "Ada kesalahan sistem";		 
	}
	$connect->close();
	echo json_encode($validator);
}