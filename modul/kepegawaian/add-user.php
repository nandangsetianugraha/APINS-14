<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$ids=$_POST['idptk'];
	$lvl=$_POST['jenispegawai'];
	$username=strip_tags($connect->real_escape_string($_POST['pengguna']));
	$password=strip_tags($connect->real_escape_string($_POST['password']));
	$newpw = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$ceku = $connect->query("select * from pengguna where username='$username'")->num_rows;
	$cek = strlen($password);
	if($ceku>0){
		$validator['success'] = false;
		$validator['messages'] = "nama pengguna sudah ada, silahkan cari yang lain";
	}else{
		if($cek>6){
			if(empty($username) || empty($password)){
				$validator['success'] = false;
				$validator['messages'] = "Username atau Password tidak boleh kosong";
			}else{
				$namaptk = $connect->query("select * from ptk where ptk_id='$ids'")->fetch_assoc();
				$namanya = $namaptk['nama'];
				$query1 = $connect->query("INSERT INTO pengguna(ptk_id,username,password,nama_lengkap,level,verified,gambar) VALUES('$ids','$username','$newpw','$namanya','$lvl','1','user-default.png')");
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Pengguna atas nama $namanya berhasil ditambahkan";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Kok Error ya???";
				};
			};
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Panjang Password harus lebih dari 6 karakter";
		};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}