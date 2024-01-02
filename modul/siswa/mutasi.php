<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$output = array('success' => false, 'messages' => array());
$siswa = $_POST['siswa'];
$tapel = $_POST['tapel'];
$smt = $_POST['smt'];
$jenis = $_POST['jenis'];
$jns = $connect->query("SELECT * FROM jns_mutasi WHERE id_mutasi='$jenis'")->fetch_assoc();
$sqlp = "SELECT * FROM siswa WHERE peserta_didik_id = '$siswa'";
$queryp = $connect->query($sqlp);
$rs = $queryp->fetch_assoc();
$nama=$rs['nama'];
$sql = "UPDATE siswa set status='$jenis' WHERE peserta_didik_id='$siswa'";
$query = $connect->query($sql);
//hahaha
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = $nama." Berhasil dimutasikan";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data siswa';
}
$connect->close();
echo json_encode($output);