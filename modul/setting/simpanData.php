<?php 

require_once '../../function/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$namasekolah=$connect->real_escape_string($_POST['nama_sekolah']);
	$alamatsekolah=$connect->real_escape_string($_POST['alamat_sekolah']);
	$versi=$connect->real_escape_string($_POST['versi']);	$smt=$_POST['smt'];	$maintenis=$_POST['maintenis'];	$tapel=$_POST['tapel'];
		$sql = "UPDATE konfigurasi SET tapel='$tapel', semester='$smt', maintenis='$maintenis', nama_sekolah='$namasekolah', alamat_sekolah='$alamatsekolah', versi='$versi' WHERE id_conf='1'";		$query = $connect->query($sql);
	if($query === TRUE) {						$validator['success'] = true;			$validator['messages'] = "Konfigurasi berhasil diubah!";				} else {					$validator['success'] = false;			$validator['messages'] = "Error while adding the member information";		};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}