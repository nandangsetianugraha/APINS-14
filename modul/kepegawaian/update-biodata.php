<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idp=strip_tags($connect->real_escape_string($_POST['ptkid']));
	$nama=strip_tags($connect->real_escape_string($_POST['nama']));
	$gelar=strip_tags($connect->real_escape_string($_POST['gelar']));
	$jk=$_POST['jeniskelamin'];
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tanggal=$_POST['tanggal'];
	$status=$_POST['status'];
	$nik=strip_tags($connect->real_escape_string($_POST['nik']));
	$niy=strip_tags($connect->real_escape_string($_POST['niynigk']));
	$nuptk=strip_tags($connect->real_escape_string($_POST['nuptk']));
	$alamat=strip_tags($connect->real_escape_string($_POST['alamat']));
	$email=strip_tags($connect->real_escape_string($_POST['email']));
	$hp=strip_tags($connect->real_escape_string($_POST['noHP']));
	$statuspeg=$_POST['statuspegawai'];
	$jenispeg=$_POST['jenispegawai'];
	$tmt=$_POST['tmt'];
	$sql = "select * from jenis_ptk where jenis_ptk_id='$jenispeg'";
	$query = $connect->query($sql);
	$cks = $query->fetch_assoc();
	$jnsptk=$cks['jenis_ptk'];
	//$=$_POST[''];
	//$=$_POST[''];
	if(empty($nama) || empty($tanggal)){
		$validator['success'] = false;
		$validator['messages'] = "Nama dan tanggal lahir tidak boleh kosong!";
	}else{
		$sql1 = "UPDATE ptk SET nama='$nama', gelar='$gelar', jenis_kelamin='$jk', tempat_lahir='$tempat', tanggal_lahir='$tanggal', status_perkawinan='$status',nik='$nik', niy_nigk='$niy', nuptk='$nuptk', alamat_jalan='$alamat', email='$email', no_hp='$hp', status_kepegawaian_id='$statuspeg', jenis_ptk_id='$jenispeg', tmt='$tmt' WHERE ptk_id='$idp'";
		$query1 = $connect->query($sql1);
//		$query2 = $connect->query("UPDATE pengguna SET level='$jenispeg' WHERE ptk_id='$idp'");
		if($query1 === true) {			
			$validator['success'] = true;
			$validator['messages'] = "Profil $nama berhasil diperbaharui!";	
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Ada yang salah sama server!!!";
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}