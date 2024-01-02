<?php
session_start();
$level = $_SESSION['level'];
require_once '../../config/db_connect.php';
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
if($kelas==0){
?>
	<select class="form-select" id="mp" name="mp">
		<option value="0">Pilih Mapel</option>
	</select>
<?php 
}else{
?>
						
						<select class="form-select" id="mp" name="mp">
							<option value="0">Pilih Mapel</option>
							<?php 
							$sql4 = "select * from mapel_dta order by id_mapel asc";
							$query4 = $connect->query($sql4);
							while($mp=$query4->fetch_assoc()){
								
							?>
							<option value="<?=$mp['id_mapel'];?>"><?=$mp['nama_mapel'];?></option>
							<?php } ?>
						</select>
						
<?php } ?>
