<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$kelas=$_POST['kelas'];
	$smt=$_POST['smt'];
	$aspek=$_POST['aspek'];
	$mapel=$_POST['mapel'];
	$tema=$connect->real_escape_string($_POST['temaku']);
	$kd=$connect->real_escape_string($_POST['kd']);
	if(empty($kelas) || empty($smt) || empty($mapel) || empty($aspek) || empty($tema)){
		$validator['success'] = false;
		$validator['messages'] = "Tidak Boleh Kosong Datanya!";
	}else{
		$sql = "select * from pemetaan where kelas='$kelas' and smt='$smt' and kd_aspek='$aspek' and mapel='$mapel' and tema='$tema' and nama_peta='$kd'";
		$query = $connect->query($sql);
		$cks = $query->fetch_assoc();
		$ada=$query->num_rows;
		if($ada>0){
			$validator['success'] = false;
			$validator['messages'] = "KD tersebut sudah dipetakan!";
		}else{
		    if(empty($kd)){
				$validator['success'] = false;
				$validator['messages'] = "Tidak Boleh Kosong Datanya!";
			}else{
				$sql1 = "insert into pemetaan(kelas, smt, kd_aspek, mapel, tema, nama_peta) values('$kelas','$smt','$aspek','$mapel','$tema','$kd')";
				$query1 = $connect->query($sql1);
				if($query1 === TRUE) {			
					$validator['success'] = true;
					$validator['messages'] = "Pemetaan KD berhasil ditambahkan";		
				} else {		
					$validator['success'] = false;
					$validator['messages'] = "Error while adding the member information";
				};
			};
		};
		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}