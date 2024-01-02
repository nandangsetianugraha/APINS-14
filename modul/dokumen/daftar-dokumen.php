<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';

function get_remote_file_info($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
    $data = curl_exec($ch);
    $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
  	$fileSizes = round($fileSize/1024,2);
    $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [
        'fileExists' => (int) $httpResponseCode == 200,
        'fileSize' => (int) $fileSizes
    ];
};


$idptk=$_GET['ptkid'];
$kat=$_GET['kategori'];
$idp=$_SESSION['userid'];
$lvl=$_SESSION['level'];
$output = array('data' => array());
if($kat==0){
	$sql = "SELECT * FROM form_data where hapus='0' order by submitted_on desc";
}else{
	$sql = "SELECT * FROM form_data where kategori='$kat' and hapus='0' order by submitted_on desc";
}
$querys = $connect->query($sql);
while ($row = $querys->fetch_assoc()) {
	$idd=$row['id'];
	$ptkids=$row['ptk_id'];
	$ups=$connect->query("select * from ptk where ptk_id='$ptkids'")->fetch_assoc();
	$jns=$row['tipefile'];
  	$filed = $_SERVER['DOCUMENT_ROOT'].'/dokumen/uploads/'.$row['file_names'];
  	if(file_exists($filed)){
		$filesize_raw = fm_get_size($filed);
		$filesize = fm_get_filesize($filesize_raw);
	}else{
		$filesize='0 KB';
	};
	if($jns=='doc' or $jns=='docx'){
		$jns='word';
	};
	if($jns=='mp4'){
		$jns='video';
	};
  	if($jns=='mp3'){
		$jns='audio';
	};
	if($jns=='jpg' or $jns=='png'){
		$jns='image';
	};
	$richlist = $row['judul'].'<br/>
		<span class="badge badge-outline-success">Unduh : '.$row['download'].'</span>
		<span class="badge badge-outline-info">Lihat : '.$row['view'].'</span>
		<span class="badge badge-outline-dark">Size : '.$filesize.'</span>
		<span class="badge badge-outline-danger">Type : '.$row['tipefile'].'</span>
	';
	if($lvl==11 or $idp==$ptkids){
		$tombol='
		<button class="btn btn-sm btn-outline-danger btn-icon" onclick="removeDokumen('.$idd.')">
			<i class="fa fa-trash-alt"></i>
		</button>
		<button class="btn btn-sm btn-outline-success btn-icon" onclick="unduhDokumen('.$idd.')">
			<i class="fa-solid fa-download"></i>
		</button>
		<button class="btn btn-sm btn-outline-info btn-icon" data-doc="'.$idd.'" data-bs-toggle="modal" data-bs-target="#info">
			<i class="fa-solid fa-magnifying-glass"></i>
		</button>
		';
	}else{
		$tombol='
		<button class="btn btn-sm btn-outline-success btn-icon" onclick="unduhDokumen('.$idd.')">
			<i class="fa-solid fa-download"></i>
		</button>
		<button class="btn btn-sm btn-outline-info btn-icon" data-doc="'.$idd.'" data-bs-toggle="modal" data-bs-target="#info">
			<i class="fa-solid fa-magnifying-glass"></i>
		</button>
		';
	};
	
	$output['data'][] = array(
		$richlist,
		$row['submitted_on'],
		$ups['nama'],
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);