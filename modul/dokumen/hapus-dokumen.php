<?php 
require_once '../../config/db_connect.php';
$output = array('success' => false, 'messages' => array());
$idr = $_POST['member_id'];
$sql = "UPDATE form_data SET hapus='1' where id='$idr'";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Dokumen Berhasil dihapus';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba menghapus Dokumen';
}
// close database connection
$connect->close();
echo json_encode($output);