<?php
require_once '../../config/db_connect.php';
$tapel=$_GET['tapel'];
$sql4 = "select * from tapel order by nama_tapel asc";
$query4 = $connect->query($sql4);
$ak=0;
while($nk=$query4->fetch_assoc()){
	if($tapel==$nk['nama_tapel']){
		$stt="selected";
	}else{
		$stt='';
	};
	echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
}	
?>