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
						<?php if($level==96){ //mapel PAI ?>
						<select class="form-select" id="mp" name="mp">
							<option value="0">Pilih Mapel</option>
							<option value="1">Pendidikan Agama Islam</option>
						</select>
						<?php }; ?>
						<?php if($level==95){ //mapel PJOK ?>
						<select class="form-select" id="mp" name="mp">
							<option value="0">Pilih Mapel</option>
							<option value="6">Pend. Jasmani Olahraga dan Kesehatan</option>
						</select>
						<?php }; ?>
						<?php if($level==94){ //mapel Inggris ?>
						<select class="form-select" id="mp" name="mp">
							<option value="0">Pilih Mapel</option>
							<option value="8">Bahasa Inggris</option>
						</select>
						<?php } ?>
						
						<?php if($level==11 or $level==93 or $level==98 or $level==97){ //Admin ?>
						<select class="form-select" id="mp" name="mp">
							<option value="0">Pilih Mapel</option>
							<?php 
							$sql4 = "select * from mata_pelajaran order by id_mapel asc";
							$query4 = $connect->query($sql4);
							while($mp=$query4->fetch_assoc()){
								
							?>
							<option value="<?=$mp['id_mapel'];?>"><?=$mp['nama_mapel'];?></option>
							<?php } ?>
						</select>
						<?php } ?>
<?php } ?>
