<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idNasabah=$_POST['idNasabah'];
	$idsis=$_POST['idsis'];
	$qry = $connect->query("select * from ptk where ptk_id='$idsis'");
	$namasiswa=$qry->fetch_assoc();
	$namanya=$namasiswa['nama'];
	//$idnya=$namasiswa[''];
	if(empty($idNasabah) || empty($idsis)){
		$validator['success'] = false;
		$validator['messages'] = "ID Pegawai tidak boleh Kosong!";
	}else{
			$sql = "select * from id_pegawai where pegawai_id='$idNasabah'";
			$query = $connect->query($sql);
			$ada=$query->num_rows;
			if($ada>0){
				$validator['success'] = false;
				$validator['messages'] = "ID Pegawai sudah terdaftar!";
			}else{
				$sql1 = "select * from id_pegawai where ptk_id='$idsis'";
				$query1 = $connect->query($sql1);
				$ada1=$query1->num_rows;
				if($ada1>0){
					$validator['success'] = false;
					$validator['messages'] = "$namanya sudah mempunyai ID Pegawai!";
				}else{
					$query4 = $connect->query("select * from ptk where ptk_id='$idsis'");
					$nsis=$query4->fetch_assoc();
					$sql2 = "INSERT INTO id_pegawai(pegawai_id,ptk_id) VALUES('$idNasabah','$idsis')";				
					$query2 = $connect->query($sql2);
					$validator['success'] = true;
					$validator['messages'] = "ID Pegawai berhasil dibuat";
				}
			};	
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}