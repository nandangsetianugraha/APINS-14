<?php
if($_GET) {
	$validator = array('success' => false, 'messages' => array());
	$npm=$_GET['nis'];
    $nomor = $_GET['pdid'];
	include "phpqrcode/qrlib.php";
	$tempdir = "https://sdi-aljannah.web.id/images/qrcode/";
    if (!file_exists($tempdir)){
        mkdir($tempdir);
    }
	$isi_teks = $nomor;
    $namafile = $npm.".png";
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
	$validator['success'] = true;
	$validator['messages'] = "Generate QRCode Berhasil";
}else{
	$validator['success'] = false;
	$validator['messages'] = "Gak Ada yang harus digenerate";
}
echo json_encode($validator);
