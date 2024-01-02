<?php
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db_connect.php");
$idp=$_REQUEST['id'];
$nilai=$_REQUEST['value'];
$kolom=$_REQUEST['column'];
$smt=$_REQUEST['smt'];
$tapel=$_REQUEST['tapel'];
$kes=$connect->query("SELECT * FROM data_kesehatan WHERE peserta_didik_id='$idp' AND smt='$smt' AND tapel='$tapel'")->num_rows;
if($kes>0){
	$sql = "UPDATE data_kesehatan SET $kolom='$nilai' WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'";
}else{
	$sql = "INSERT INTO data_kesehatan(peserta_didik_id, smt, tapel,$kolom) VALUES('$idp','$smt','$tapel','$nilai')";
}
$query1 = $connect->query($sql);
if($query1 === TRUE) {	
	echo "saved";
}else{
	echo "gagal";
};