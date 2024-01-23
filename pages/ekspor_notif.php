<?php
include "../config/db_connect.php";
$tanggal=date('Y-m-d');
// nama file hasil export
$namaFile = $tanggal."-notifikasi.txt";
 
// karakter separator
$separator = "\t";
 
// koneksi ke mysql
 
// header file text
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=".$namaFile);
 
// query sql baca semua data dlm tabel mhs
$sql = "SELECT * FROM log";
$hasil = $connect->query($sql);
while ($data = $hasil->fetch_assoc())
{   
    $idptk=$data['ptk_id'];
	$nama=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
    echo $data['logDate'].$separator.$nama['nama'].$separator.$data['activity']."\r\n";
}
 
?>