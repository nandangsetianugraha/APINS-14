<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idr'];
	$nilai=$_POST['nilai'];
	$kelebihan=strip_tags($connect->real_escape_string($_POST['kelebihan']));
	$kelemahan=strip_tags($connect->real_escape_string($_POST['kelemahan']));
	$deskripsi=$kelebihan.'|'.$kelemahan;
	$idpd=$_POST['idpd'];
	$sql = "SELECT * FROM siswa WHERE peserta_didik_id='$idpd'";
	$nama = $connect->query($sql)->fetch_assoc();
	if(empty($nilai) || empty($kelebihan) || empty($kelemahan)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update raport_ikm set nilai='$nilai',deskripsi='$deskripsi' where id_raport='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Rapor atas nama ".$nama['nama']." berhasil diperbaharui!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}