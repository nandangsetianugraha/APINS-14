<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['idpeg'];
	$nptk = $connect->query("select * from pengguna where id='$ids'")->fetch_assoc();
	$idptk=$nptk['ptk_id'];
	$username=strip_tags($connect->real_escape_string($_POST['username']));
	$password=strip_tags($connect->real_escape_string($_POST['password']));
	$newpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$ceku = $connect->query("select * from pengguna where username='$username'")->num_rows;
	$cek = strlen($password);
	
		if($cek>6){
			if(empty($username) || empty($password)){
				$validator['success'] = false;
				$validator['messages'] = "Username atau Password tidak boleh kosong";
			}else{
				$namaptk = $connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
				$namanya = $namaptk['nama'];
				$query1 = $connect->query("update pengguna set username='$username',password='$newpw',nama_lengkap='$namanya' where id='$ids'");
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Username atau Password atas nama $namanya berhasil Ubah";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			};
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Panjang Password harus lebih dari 6 karakter";
		};
	
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}