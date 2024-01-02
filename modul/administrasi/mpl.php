<?php
include("../../config/db_connect.php");
session_start();
$level = $_SESSION['level'];
$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
if($ab==0){
	echo "<option value='0'>Pilih Mapel</option>";
}else{
	if($level==96){
		echo "<option value='0'>Pilih Mapel</option>";
		echo "<option value='1'>Pendidikan Agama Islam</option>";
	};
	if($level==95){
		echo "<option value='0'>Pilih Mapel</option>";
		echo "<option value='8'>Pend. Jasmani Olahraga dan Kesehatan</option>";
	};
	if($level==94){
		echo "<option value='0'>Pilih Mapel</option>";
		echo "<option value='10'>Bahasa Inggris</option>";
	};
	if($level==11 or $level==98 or $level==97){
		echo '<option value="0">Pilih Mapel</option>';
		$sql4 = "select * from mapel";
		$query4 = $connect->query($sql4);
		while($po=$query4->fetch_assoc()){
			$idmp=$po['id_mapel'];
				if($ab<4 and ($idmp==5 or $idmp==6)){
									
				}else{
					if($ab>3 and $idmp==8){
										
					}else{
						echo '<option value="'.$po['id_mapel'].'">'.$po['nama_mapel'].'</option>';
					};
				};
		
		};
	};
};
?>