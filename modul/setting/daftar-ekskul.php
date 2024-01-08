<?php
require_once '../../config/db_connect.php';
$jns=$_GET['jns'];
$sql4 = "select * from ekskul order by id_ekskul asc";
$query4 = $connect->query($sql4);
while($nk=$query4->fetch_assoc()){
	echo '<option data-nilai="'.$nk['nama_ekskul'].'" value="'.$nk['id_ekskul'].'" >'.$nk['nama_ekskul'].'</option>';
}	
?>