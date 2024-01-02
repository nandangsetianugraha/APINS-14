<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idraport'];
	$nilai=$_POST['nilai'];
	$predikat=$_POST['predikat'];
	$deskripsi=strip_tags($connect->real_escape_string($_POST['deskripsi']));
	$ids=$_POST['ids'];
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$mapel=$_POST['mapel'];
	$jns=$_POST['jns'];
	$sql = "SELECT * FROM raport_k13 WHERE id_raport='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	if(empty($nilai) || empty($predikat)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "update raport_k13 set nilai='$nilai',predikat='$predikat',deskripsi='$deskripsi' where id_raport='$idr'";
			$query = $connect->query($sql);
			if($jns==='k3'){
				$sql1 = "update raport set nilai='$nilai' where id_pd='$ids' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$mapel'";
				$query1 = $connect->query($sql1);
			};
			$validator['success'] = true;
			$validator['messages'] = "Raport berhasil diperbaharui!";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}