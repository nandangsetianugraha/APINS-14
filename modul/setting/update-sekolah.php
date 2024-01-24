<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$ids=strip_tags($connect->real_escape_string($_POST['idsek']));
	$namasekolah=strip_tags($connect->real_escape_string($_POST['nama_sekolah']));
	$nss=strip_tags($connect->real_escape_string($_POST['nss']));
	$npsn=strip_tags($connect->real_escape_string($_POST['npsn']));
	$alamat=strip_tags($connect->real_escape_string($_POST['alamat']));
	$rt=strip_tags($connect->real_escape_string($_POST['rt']));
	$rw=strip_tags($connect->real_escape_string($_POST['rw']));
	$desa=strip_tags($connect->real_escape_string($_POST['desas']));
	$kec=strip_tags($connect->real_escape_string($_POST['kecs']));
	$kab=strip_tags($connect->real_escape_string($_POST['kabs']));
	$prov=strip_tags($connect->real_escape_string($_POST['provs']));
	$kodepos=strip_tags($connect->real_escape_string($_POST['kodepos']));
	$lintang=strip_tags($connect->real_escape_string($_POST['lintang']));
	$bujur=strip_tags($connect->real_escape_string($_POST['bujur']));
	//$desa=strip_tags($connect->real_escape_string($_POST['desas']));
	
	$sql = "UPDATE sekolah SET nama='$namasekolah', nss='$nss', npsn='$npsn', alamat_jalan='$alamat', rt='$rt', rw='$rw', desa='$desa', kecamatan='$kec', kabupaten='$kab', provinsi='$prov', kode_pos='$kodepos', lintang='$lintang', bujur='$bujur' WHERE sekolah_id='$ids'";
    $query = $connect->query($sql);
    if($query === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Identitas Sekolah berhasil diubah!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Kesalahan Query!";
		};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}