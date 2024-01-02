<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['idpd'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$tinggi=$connect->real_escape_string($_POST['tinggi']);
	$berat=$connect->real_escape_string($_POST['berat']);
	$pendengaran=$connect->real_escape_string($_POST['pendengaran']);
	$penglihatan=$connect->real_escape_string($_POST['penglihatan']);
	$gigi=$connect->real_escape_string($_POST['gigi']);
	$lainnya=$connect->real_escape_string($_POST['lainnya']);
	if(empty($smt) || empty($id) || empty($tinggi) || empty($berat) || empty($pendengaran) || empty($penglihatan) || empty($gigi)){
		$validator['success'] = false;
		$validator['messages'] = "Keterangan tidak boleh kosong";
	}else{
		$ceks=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$id' AND smt='$smt' AND tapel='$tapel'")->num_rows;
		if($ceks>0){
			$kess=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$id' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
			$idkes=$kess['id'];
			$sql = "update data_kesehatan set tinggi='$tinggi',berat='$berat',pendengaran='$pendengaran',penglihatan='$penglihatan',gigi='$gigi',lainnya='$lainnya' where id='$idkes'";
			$query = $connect->query($sql);
			if($query === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Kesehatan berhasil diubah!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		}else{
			$sql1 = "INSERT INTO data_kesehatan(peserta_didik_id, smt, tapel,tinggi, berat,pendengaran,penglihatan,gigi,lainnya) VALUES('$id','$smt','$tapel','$tinggi','$berat','$pendengaran','$penglihatan','$gigi','$lainnya')";
			$query1 = $connect->query($sql1);
			if($query1 === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Data Kesehatan berhasil ditambahkan!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Kok Error ya???";
			};
		};		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}