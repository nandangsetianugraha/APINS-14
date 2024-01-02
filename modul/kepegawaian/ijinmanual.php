<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idp'];
	$tanggal1=$_POST['tanggal_awal'];
	$tanggal2=$_POST['tanggal_akhir'];
	$status=$_POST['status'];
	$keterangan=strip_tags($connect->real_escape_string($_POST['keterangan']));
	if(empty($idr) || empty($tanggal1) || empty($tanggal2) || empty($status)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
			$sql = "insert into ijin_ptk(tanggal_awal,tanggal_akhir,pegawai_id,status,keterangan) values('$tanggal1','$tanggal2','$idr','$status','$keterangan')";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Absen Manual berhasil";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}