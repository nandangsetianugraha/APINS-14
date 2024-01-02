<?php 

require_once '../../config/db_connect.php';

$output = array('success' => false, 'messages' => array());
$memberId = $_POST['member_id'];
$sqlp = "SELECT * FROM id_pegawai WHERE id = '$memberId'";
$queryp = $connect->query($sqlp);
$rs = $queryp->fetch_assoc();
$idN=$rs['pegawai_id'];
//hapus Nasabah
$sql = "DELETE FROM id_pegawai WHERE id = {$memberId}";
$query = $connect->query($sql);
//Hapus data tabungan
$sql1 = "DELETE FROM absensi_ptk WHERE pegawai_id = {$idN}";
$query1 = $connect->query($sql1);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = " Berhasil dihapus ";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data nasabah';
}

// close database connection
$connect->close();

echo json_encode($output);