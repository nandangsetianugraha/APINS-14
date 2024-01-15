<?php 
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$tempat=strip_tags($connect->real_escape_string($_POST['tempat']));
	$tanggal=$_POST['tanggal'];
	$tanggal2=$_POST['tanggal2'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$cek = $connect->query("select * from titimangsa WHERE smt='$smt' and tapel='$tapel'")->num_rows;
	if($cek>0){
		$ntm = $connect->query("select * from titimangsa WHERE smt='$smt' and tapel='$tapel'")->fetch_assoc();
		$idt=$ntm['id'];
		$sql = "UPDATE titimangsa SET tempat='$tempat', tanggal='$tanggal', tanggal2='$tanggal2' WHERE id='$idt'";
		$query = $connect->query($sql);
		if($query === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Titimangsa berhasil diubah!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		};
	}else{
		$sql1 = "insert into titimangsa(smt,tapel,tempat,tanggal,tanggal2) values('$smt','$tapel','$tempat','$tanggal','$tanggal2')";
		$query1 = $connect->query($sql1);
		if($query1 === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Titimangsa berhasil dibuat!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		};
	}
	
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}