<?php
date_default_timezone_set('Asia/Jakarta');
$waktu=date('Y-m-d H:i:s');
include_once("../../config/db_connect.php");
$idp=$_REQUEST['id'];
$nilai=$_REQUEST['value'];
$sql = "UPDATE siswa SET no_wa='$nilai' WHERE peserta_didik_id='$idp'";
$query1 = $connect->query($sql);
echo "saved";