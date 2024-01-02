<?php
require_once '../../config/db_connect.php';
$tapel=$_GET['tapel'];
$sql4 = "select * from provinsi order by id_prov asc";
$query4 = $connect->query($sql4);
while($nk=$query4->fetch_assoc()){
	echo '<option value="'.$nk['id_prov'].'" >'.$nk['nama'].'</option>';
}	
?>