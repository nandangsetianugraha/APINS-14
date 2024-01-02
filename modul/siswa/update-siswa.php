<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['ptkid'];
	$nis=strip_tags($connect->real_escape_string($_POST['nis']));
	$nisn=strip_tags($connect->real_escape_string($_POST['nisn']));
	$nama=strip_tags($connect->real_escape_string($_POST['nama']));
	$jk=$_POST['jeniskelamin'];
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tanggal=$_POST['tanggal'];
	$nik=strip_tags($connect->real_escape_string($_POST['nik']));
	$agama=$_POST['agama'];
	$no_wa=$_POST['no_wa'];
	$pend=strip_tags($connect->real_escape_string($_POST['pend_seb']));
	$alamat=strip_tags($connect->real_escape_string($_POST['alamat']));
	$ayah=strip_tags($connect->real_escape_string($_POST['ayah']));
	$ibu=strip_tags($connect->real_escape_string($_POST['ibu']));
	$pek_ayah=$_POST['pek_ayah'];
	$pek_ibu=$_POST['pek_ibu'];
	//$=$_POST[''];
	//$=$_POST[''];
	$jalan=strip_tags($connect->real_escape_string($_POST['jalan']));
	$kelurahan=$_POST['kelurahan'];
	$kecamatan=$_POST['kecamatan'];
	$kabupaten=$_POST['kabupaten'];
	$provinsi=$_POST['provinsi'];
	if(empty($nama) || empty($ids)){
		$validator['success'] = false;
		$validator['messages'] = "Nama dan tanggal lahir tidak boleh kosong!";
	}else{
			$sql1 = "UPDATE siswa SET nis='$nis', nisn='$nisn', nama='$nama', jk='$jk', tempat='$tempat', tanggal='$tanggal', nik='$nik', agama='$agama', pend_sebelum='$pend', alamat='$alamat', nama_ayah='$ayah', nama_ibu='$ibu', no_wa='$no_wa', pek_ayah='$pek_ayah', pek_ibu='$pek_ibu', jalan='$jalan', kelurahan='$kelurahan', kecamatan='$kecamatan', kabupaten='$kabupaten', provinsi='$provinsi' WHERE peserta_didik_id='$ids'";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Biodata $nama berhasil diperbaharui!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}