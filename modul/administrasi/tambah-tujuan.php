<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$mp=$_POST['mp'];
	$lm=$_POST['materi'];
	$kdtp=strip_tags($connect->real_escape_string($_POST['kode_tp']));
	$nama_tp=strip_tags($connect->real_escape_string($_POST['tp']));
	if(empty($kelas) || empty($smt) || empty($kdtp) || empty($nama_tp)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from tp where kelas='$kelas' and lm='$lm' and mapel='$mp' and smt='$smt' and tp='$kdtp'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Tujuan Pembelajaran sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into tp(kelas, lm, mapel,smt,tp, nama_tp) values('$kelas','$lm','$mp','$smt','$kdtp','$nama_tp')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Tujuan Pembelajaran berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Saat menambahkan TP";
			};
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}