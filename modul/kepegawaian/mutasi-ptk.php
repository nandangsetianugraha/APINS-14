<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$output = array('success' => false, 'messages' => array());
$ptk = $_POST['ptk'];
$tapel = $_POST['tapel'];
$smt = $_POST['smt'];
$jenis = $_POST['jenis'];
$jns = $connect->query("SELECT * FROM jns_mutasi WHERE id_mutasi='$jenis'")->fetch_assoc();
$sqlp = "SELECT * FROM ptk WHERE ptk_id = '$ptk'";
$queryp = $connect->query($sqlp);
$rs = $queryp->fetch_assoc();
$nama=$rs['nama'];
$sql = "UPDATE ptk set status_keaktifan_id='$jenis' WHERE ptk_id='$ptk'";
$query = $connect->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = $nama." Berhasil dimutasikan";
} else {
	$output['success'] = false;
	$output['messages'] = 'Error saat mencoba mengeluarkan data PTK';
}
$connect->close();
echo json_encode($output);