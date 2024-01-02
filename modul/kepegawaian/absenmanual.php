<?php 
require_once '../../config/db_connect.php';
$host = "localhost"; // Host name
$username = "admin_nilai"; // Mysql username
$password = "M@ikawasumi79"; // Mysql password
$db_name = "admin_absen"; // Database name

// create connection
$koneksi = new mysqli($host, $username, $password, $db_name);

// check connection 
if($koneksi->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
};
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['idpeg'];
	
	$hari=$_POST['hari'];
	$jam=$_POST['jam'];
	$sql = "SELECT * FROM id_pegawai WHERE pegawai_id='$idr'";
	$usis = $connect->query($sql)->fetch_assoc();
	$ids=$usis['ptk_id'];
	if(empty($idr) || empty($hari) || empty($jam)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$pegawai=$koneksi->query("select * from employees where employees_code='$idr'")->fetch_assoc();
		$cdpeg=$pegawai['id'];
		$ceks=$koneksi->query("select * from presence where employees_id='$cdpeg' and presence_date='$hari'")->num_rows;
		if($ceks>0){
			$hasil=$koneksi->query("select * from presence where employees_id='$cdpeg' and presence_date='$hari'")->fetch_assoc();
			$idpr=$hasil['presence_id'];
			if($hasil['time_out']=='00:00:00'){
				$query4 = $koneksi->query("update presence set time_out='$jam' where presence_id='$idpr'");
			}else{
				
			}
		}else{
			$sql1 = "insert into presence(employees_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information) values('$cdpeg','$hari','$jam','00:00:00','','','1','','')";
			$query1 = $koneksi->query($sql1);
		}
		$tanggal=$hari." ".$jam;
		$sql = "insert into absensi_ptk(pegawai_id,tanggal) values('$idr','$tanggal')";
		$query = $connect->query($sql);
		$validator['success'] = true;
		$validator['messages'] = "Absen Manual berhasil";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}