<?php 
require_once '../../inc/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$mp=$_POST['mp'];
	$tema=strip_tags($connect->real_escape_string($_POST['no_lm']));
	$nama_tema=strip_tags($connect->real_escape_string($_POST['materi']));
	if(empty($kelas) || empty($smt) || empty($tema) || empty($nama_tema)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from lingkup_materi where kelas='$kelas' and smt='$smt' and mapel='$mp' and lm='$tema'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Materi sudah ada, silahkan hapus terlebih dahulu!";
		}else{
			$sql1 = "insert into lingkup_materi(kelas, smt, mapel,lm, nama_lm) values('$kelas','$smt','$mp','$tema','$nama_tema')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Penambahan Materi berhasil dilakukan";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Error Saat menambahkan materi";
			};
		};
	};
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}