<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$output = array('success' => false, 'messages' => array());
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
 
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	for($i = 1;$i < count($sheetData);$i++)
	{
        $idpeg = $sheetData[$i]['1'];
        $tgl = $sheetData[$i]['2'];
        $masuk = $sheetData[$i]['3'];
		$keluar =  $sheetData[$i]['4'];
		$tanggal=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
		if($masuk==''){
		}else{
			$jmasuk=$tanggal." ".$masuk;
			$ada=$connect->query("select * from absensi_ptk where pegawai_id='$idpeg' and tanggal='$jmasuk'")num_rows;
			if($ada>0){
			}else{
				$query2 = $connect->query("INSERT INTO absensi_ptk(pegawai_id,tanggal) VALUES('$idpeg','$jmasuk')");
			}
		};
		if($keluar==''){
		}else{
			$jkeluar=$tanggal." ".$keluar;
			$ada=$connect->query("select * from absensi_ptk where pegawai_id='$idpeg' and tanggal='$jkeluar'")num_rows;
			if($ada>0){
			}else{
				$query2 = $connect->query("INSERT INTO absensi_ptk(pegawai_id,tanggal) VALUES('$idpeg','$jkeluar')");
			}
		};
		if($query2 === TRUE) {
			$output['success'] = true;
			$output['messages'] = " Berhasil dimutasikan";
		} else {
			$output['success'] = false;
			$output['messages'] = 'Error saat mencoba mengeluarkan data PTK';
		}
    }
	$output['success'] = true;
	$output['messages'] = "Berhasil upload";
    header("Location: ../../absensi-pegawai");
}
$connect->close();
echo json_encode($output);