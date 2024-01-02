<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idlm'];
	$tema=strip_tags($connect->real_escape_string($_POST['nolm']));
	$namatema=strip_tags($connect->real_escape_string($_POST['namalm']));
	$sql = "SELECT * FROM lingkup_materi WHERE id_lm='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$kelas=$usis['kelas'];
	$smt=$usis['smt'];
	//$tapel=$materi['tapel'];
	$mapel=$usis['mapel'];
	$lm=$usis['lm'];
	if(empty($tema) || empty($namatema)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$cekrapor=$connect->query("SELECT * FROM tp WHERE kelas='$kelas' AND lm='$lm' AND mapel='$mapel' AND smt='$smt'")->num_rows;
		if($cekrapor>0){
			$output['success'] = false;
			$output['messages'] = 'Materi ini masih ada TP terdaftar, silahkan hapus terlebih dahulu TP nya!';
		}else{
			$sqls = "update lingkup_materi set lm='$tema',nama_lm='$namatema' where id_lm='$idr'";
			$query = $connect->query($sqls);
			$validator['success'] = true;
			$validator['messages'] = "Materi berhasil diperbaharui!";		
		};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}