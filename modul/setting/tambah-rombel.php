<?php 
require_once '../../config/db_connect.php';
if($_POST) {	
	$validator = array('success' => false, 'messages' => array());
	$rombel=$connect->real_escape_string($_POST['rombel']);
	$kurikulum=$_POST['kurikulum'];
	$tapel=$_POST['ptapel'];
	$smt=$_POST['psmt'];
	$wali=$_POST['walikelas'];
	$gp=$_POST['gurup'];
	$pai=$_POST['pai'];
	$penjas=$_POST['pjok'];
	$inggris=$_POST['inggris'];
	if(empty($rombel)){
		$validator['success'] = false;
		$validator['messages'] = "Nama Rombel tidak boleh kosong!";
	}else{
		$ada=$connect->query("select * from rombel where nama_rombel='$rombel' and tapel='$tapel' and smt='$smt'")->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "Nama Rombel Sudah ada";
		}else{
			$sql = "INSERT INTO rombel(nama_rombel,kurikulum,tapel,smt,wali_kelas,pendamping,pai,penjas,inggris) VALUES('$rombel','$kurikulum','$tapel','$smt','$wali','$gp','$pai','$penjas','$inggris')";
			$query = $connect->query($sql);
			if($query === TRUE) {			
				$validator['success'] = true;
				$validator['messages'] = "Rombel berhasil dibuat!";		
			} else {		
				$validator['success'] = false;
				$validator['messages'] = "Ada yang error nih";
			};
		};
	};
	$connect->close();
	echo json_encode($validator);
}