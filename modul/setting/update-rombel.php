<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());	$idr=$_POST['idrombel'];
	$rombel=$connect->real_escape_string($_POST['rombel']);	$kurikulum=$_POST['kurikulum'];	$tapel=$_POST['ptapel'];	$smt=$_POST['psmt'];	$wali=$_POST['walikelas'];	$gp=$_POST['gurup'];	$pai=$_POST['pai'];	$penjas=$_POST['pjok'];	$inggris=$_POST['inggris'];	
		$sql = "UPDATE rombel SET nama_rombel='$rombel', kurikulum='$kurikulum', tapel='$tapel', smt='$smt', wali_kelas='$wali', pendamping='$gp', pai='$pai', penjas='$penjas', inggris='$inggris' WHERE id_rombel='$idr'";		$query = $connect->query($sql);
	if($query === TRUE) {						$validator['success'] = true;			$validator['messages'] = "Rombel berhasil diubah!";				} else {					$validator['success'] = false;			$validator['messages'] = "Error while adding the member information";		};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}