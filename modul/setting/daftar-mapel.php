<?php
require_once '../../config/db_connect.php';
$jns=$_GET['jns'];
if($jns=='k13'){
	$sql4 = "select * from mapel order by id_mapel asc";
}elseif($jns=='km'){
	$sql4 = "select * from mata_pelajaran order by id_mapel asc";
}elseif($jns=='dta'){
	$sql4 = "select * from mapel_dta order by id_mapel asc";
}else{
	$sql4 = "select * from mapel order by id_mapel asc";
};
$query4 = $connect->query($sql4);
while($nk=$query4->fetch_assoc()){
	echo '<option data-nilai="'.$nk['nama_mapel'].'" value="'.$nk['id_mapel'].'" >'.$nk['nama_mapel'].'</option>';
}	
?>