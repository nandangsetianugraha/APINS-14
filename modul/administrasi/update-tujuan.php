<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idlm'];
	
	$kodetp=strip_tags($connect->real_escape_string($_POST['kode_tp']));
	$namatp=strip_tags($connect->real_escape_string($_POST['tp']));
	$sql = "SELECT * FROM lingkup_materi WHERE id_lm='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$kelas=$usis['kelas'];
	$lm=$usis['lm'];
	$mp=$usis['mapel'];
	$smt=$usis['smt'];
	//$kdtp=$usis['tp'];
	//$kelas=$usis['kelas'];
	if(empty($kodetp) || empty($namatp)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$ada=$connect->query("select * from tp where kelas='$kelas' and lm='$lm' and mapel='$mp' and smt='$smt' and tp='$kodetp'")->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Kode TP tersebut sudah digunakan!";
		}else{
			$sql = "update tp set tp='$kodetp',nama_tp='$namatp' where id_tp='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = "Tujuan Pembelajaran berhasil diperbaharui!";	
		}			
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}