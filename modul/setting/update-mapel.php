<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$jns=strip_tags($connect->real_escape_string($_POST['jns']));
	$rowid=strip_tags($connect->real_escape_string($_POST['ids']));
	$mapel=strip_tags($connect->real_escape_string($_POST['mapel']));
	$kd_mapel=strip_tags($connect->real_escape_string($_POST['kd_mapel']));
	if(empty($kd_mapel) or empty($mapel)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		
			if($jns=='Kurikulum 2013'){
				$sql1 = "update mapel set kd_mapel='$kd_mapel', nama_mapel='$mapel' where id_mapel='$rowid'";
			}elseif($jns=='Kurikulum Merdeka'){
				$sql1 = "update mata_pelajaran set kd_mapel='$kd_mapel', nama_mapel='$mapel' where id_mapel='$rowid'";
			}elseif($jns=='dta'){
				$sql1 = "update mata_pelajaran set kd_mapel='$kd_mapel', nama_mapel='$mapel' where id_mapel='$rowid'";
			}else{
				$sql1 = "update mapel set kd_mapel='$kd_mapel', nama_mapel='$mapel' where id_mapel='$rowid'";
			};
			//$sql1 = "insert into desa(id,id_kecamatan,nama) values('$id_desa','$id_kec','$nama_desa')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Perubahan Mata pelajaran berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error while adding the member information";
			};
		
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}