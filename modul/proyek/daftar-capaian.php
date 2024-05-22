<?php
session_start();
$level = $_SESSION['level'];
require_once '../../config/db_connect.php';
$dimensi=$_GET['dimensi'];
$elemen=$_GET['elemen'];
$sub_elemen=$_GET['subelemen'];
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
if($ab==1 or $ab==2){
	$fase='A';
};
if($ab==3 or $ab==4){
	$fase='B';
};
if($ab==5 or $ab==6){
	$fase='C';
};
if($kelas=='0'){
?>
	<textarea class="form-control" name="capaian"></textarea>
<?php 
}else{
	$sql4 = "select * from elemen_proyek where id_elemen='$sub_elemen'";
	$query4 = $connect->query($sql4);
	$nk=$query4->fetch_assoc();
?>
	<textarea class="form-control" col="4" name="capaian"><?=$nk['capaian'];?></textarea>
	
<?php } ?>
