<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

//require_once 'DataSource.php';
require_once '../config/db_connect.php';
//$db = new DataSource();
//$conn = $db->getConnection();
require_once ('../assets/vendor/PhpSpreadsheet/vendor/autoload.php');
function random($panjang)
{
   $karakter = 'abcdefghijklmnopqrstuvwxyz1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($karakter)-1);
   $string .= $karakter{$pos};
   }
    return $string;
};
if (isset($_POST["import"])) {
	$allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);
	//	$idkur=$connect->query("select * from kurikulum where nama_kurikulum='$nkur'")->fetch_assoc();
	    for ($i = 1; $i <= $sheetCount; $i ++) {
            $nis = "";
            if (isset($spreadSheetAry[$i][0])) {
                $nis = strip_tags($connect->real_escape_string($spreadSheetAry[$i][0]));
            }
            $nisn = "";
            if (isset($spreadSheetAry[$i][1])) {
                $nisn = strip_tags($connect->real_escape_string($spreadSheetAry[$i][1]));
            }
			$nama = "";
            if (isset($spreadSheetAry[$i][2])) {
                $nama = strip_tags($connect->real_escape_string($spreadSheetAry[$i][2]));
            }
			$jk = "";
            if (isset($spreadSheetAry[$i][3])) {
                $jk = strip_tags($connect->real_escape_string($spreadSheetAry[$i][3]));
            }
			$tempat = "";
            if (isset($spreadSheetAry[$i][4])) {
                $tempat = strip_tags($connect->real_escape_string($spreadSheetAry[$i][4]));
            }
			$tanggal_lahir = "";
            if (isset($spreadSheetAry[$i][5])) {
                $tanggal_lahir = strip_tags($connect->real_escape_string($spreadSheetAry[$i][5]));
            }
			$nik = "";
            if (isset($spreadSheetAry[$i][6])) {
                $nik = strip_tags($connect->real_escape_string($spreadSheetAry[$i][6]));
            }
			$alamat = "";
            if (isset($spreadSheetAry[$i][7])) {
                $alamat = strip_tags($connect->real_escape_string($spreadSheetAry[$i][7]));
            }
			$ayah = "";
            if (isset($spreadSheetAry[$i][8])) {
                $ayah = strip_tags($connect->real_escape_string($spreadSheetAry[$i][8]));
            }
			$ibu = "";
            if (isset($spreadSheetAry[$i][9])) {
                $ibu = strip_tags($connect->real_escape_string($spreadSheetAry[$i][9]));
            }
			$noHP = "";
            if (isset($spreadSheetAry[$i][10])) {
                $noHP = strip_tags($connect->real_escape_string($spreadSheetAry[$i][10]));
            }

            if (! empty($nama) || ! empty($tempat) || ! empty($tanggal_lahir)) {
				$id_pd1=random(8);
				$id_pd2=random(4);
				$id_pd3=random(4);
				$id_pd4=random(4);
				$id_pd5=random(12);
				$id_pd=$id_pd1.'-'.$id_pd2.'-'.$id_pd3.'-'.$id_pd4.'-'.$id_pd5;
                $sql1 = "insert into siswa(peserta_didik_id,nis,nisn,nama,jk,tempat,tanggal,nik,alamat,nama_ayah,nama_ibu,no_wa,avatar,status) values('$id_pd','$nis','$nisn','$nama','$jk','$tempat','$tanggal_lahir','$nik','$alamat','$ayah','$ibu','$noHP','user-default.jpg','1')";
                $query1 = $connect->query($sql1);
				
				if ($query1 === TRUE) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
				//header("location:../daftar-siswa");
            }
        }
		header("location:../daftar-siswa");
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>