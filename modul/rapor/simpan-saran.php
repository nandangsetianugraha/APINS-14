<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['idpd'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$saran=$connect->real_escape_string($_POST['sarantext']);
	if(empty($smt) || empty($id)){
		$validator['success'] = false;
		$validator['messages'] = "Saran tidak boleh kosong";
	}else{
		$ceks=$connect->query("SELECT * FROM saran WHERE peserta_didik_id='$id' AND smt='$smt' AND tapel='$tapel'")->num_rows;
		if($ceks>0){
			$kess=$connect->query("SELECT * FROM saran WHERE peserta_didik_id='$id' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
			$idkes=$kess['id'];
			if(empty($saran)){
				$sql = "DELETE from saran where id='$idkes'";
				$query = $connect->query($sql);
				if($query === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Saran berhasil dihapus!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			}else{
				$sql = "update saran set saran='$saran' where id='$idkes'";
				$query = $connect->query($sql);
				if($query === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Saran berhasil diubah!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			}
			
		}else{
			if(empty($saran)){
				$validator['success'] = false;
				$validator['messages'] = "Saran tidak boleh kosong";
			}else{
				$sql1 = "INSERT INTO saran(peserta_didik_id, smt, tapel,saran) VALUES('$id','$smt','$tapel','$saran')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Saran berhasil ditambahkan!";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			}
		};		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}