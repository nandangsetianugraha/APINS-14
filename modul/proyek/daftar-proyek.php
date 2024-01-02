<?php
session_start();
$level = $_SESSION['level'];
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$proyek=$_GET['proyek'];
$ab=substr($kelas,0,1);
if($kelas=='0'){
?>
	<select class="form-select" id="proyek" name="proyek">
		<option value="0">Pilih Proyek</option>
	</select>
<?php 
}else{
	$sql4 = "select * from data_proyek where kelas='$kelas' and tapel='$tapel' and smt='$smt'";
	$query4 = $connect->query($sql4);
?>
	<select class="form-select" id="proyek" name="proyek">
		<option value="0">Pilih Proyek</option>
		<?php 
		while($nk=$query4->fetch_assoc()){
		?>
		<option value="<?=$nk['id_proyek'];?>"><?=$nk['nama_proyek'];?></option>
		<?php } ?>
	</select>
<?php } ?>
