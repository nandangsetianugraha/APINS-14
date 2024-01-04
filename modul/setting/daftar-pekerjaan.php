<?php
require_once '../../config/db_connect.php';
$jns=$_GET['jns'];
$sql4 = "select * from pekerjaan order by id_pekerjaan asc";
$query4 = $connect->query($sql4);
while($nk=$query4->fetch_assoc()){
	echo '<option data-nilai="'.$nk['nama_pekerjaan'].'" value="'.$nk['id_pekerjaan'].'" >'.$nk['nama_pekerjaan'].'</option>';
}	
?>