<?php 
include("../../config/db_connect.php");
function random($panjang)
{
   $karakter = 'abcdefghijklmnopqrstuvwxyz1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter{$pos};
   }
    return $string;
};
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	
	$idp=$_POST['idr'];
	$rmb=$connect->query("select * from penempatan where id_rombel='$idp'")->fetch_assoc();
	if(empty($idp)){
		$validator['success'] = false;
		$validator['messages'] = "Harus diisi datanya!";
	}else{
		$sql1 = "DELETE from penempatan where id_rombel='$idp'";
		$query1 = $connect->query($sql1);
		if($query1 === TRUE) {			
			$validator['success'] = true;
			$validator['messages'] = "Berhasil!";		
		} else {		
			$validator['success'] = false;
			$validator['messages'] = "Ada yang error nih???";
		};
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}