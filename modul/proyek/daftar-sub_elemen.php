<?php
session_start();
$level = $_SESSION['level'];
require_once '../../config/db_connect.php';
$dimensi=$_GET['dimensi'];
$elemen=$_GET['elemen'];
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
	<select class="form-select" id="sub_elemen" name="sub_elemen">
		<option value="0">Pilih Sub Elemen</option>
	</select>
<?php 
}else{
	$sql4 = "select * from elemen_proyek where dimensi='$dimensi' and elemen='$elemen' and fase='$fase'";
	$query4 = $connect->query($sql4);
?>
	<select class="form-select" id="sub_elemen" name="sub_elemen">
		<option value="0">Pilih Sub Elemen</option>
		<?php 
		while($nk=$query4->fetch_assoc()){
		?>
		<option value="<?=$nk['id_elemen'];?>"><?=$nk['sub_elemen'];?></option>
		<?php } ?>
	</select>
<?php } ?>
