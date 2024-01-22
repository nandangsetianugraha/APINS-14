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
            $nama = "";
            if (isset($spreadSheetAry[$i][0])) {
                $nama = strip_tags($connect->real_escape_string($spreadSheetAry[$i][0]));
            }
            $gelar = "";
            if (isset($spreadSheetAry[$i][1])) {
                $gelar = strip_tags($connect->real_escape_string($spreadSheetAry[$i][1]));
            }
			$jk = "";
            if (isset($spreadSheetAry[$i][2])) {
                $jk = strip_tags($connect->real_escape_string($spreadSheetAry[$i][2]));
            }
			$tempat = "";
            if (isset($spreadSheetAry[$i][3])) {
                $tempat = strip_tags($connect->real_escape_string($spreadSheetAry[$i][3]));
            }
			$tanggal = "";
            if (isset($spreadSheetAry[$i][4])) {
                $tanggal = strip_tags($connect->real_escape_string($spreadSheetAry[$i][4]));
            }
			$nik = "";
            if (isset($spreadSheetAry[$i][5])) {
                $nik = strip_tags($connect->real_escape_string($spreadSheetAry[$i][5]));
            }
			$status = "";
            if (isset($spreadSheetAry[$i][6])) {
                $status = strip_tags($connect->real_escape_string($spreadSheetAry[$i][6]));
            }
			$jenis = "";
            if (isset($spreadSheetAry[$i][7])) {
                $jenis = strip_tags($connect->real_escape_string($spreadSheetAry[$i][7]));
            }
			$tmt = "";
            if (isset($spreadSheetAry[$i][8])) {
                $tmt = strip_tags($connect->real_escape_string($spreadSheetAry[$i][8]));
            }
			
            if (! empty($nama) || ! empty($tempat) || ! empty($tanggal)) {
				$id_pd1=random(8);
				$id_pd2=random(4);
				$id_pd3=random(4);
				$id_pd4=random(4);
				$id_pd5=random(12);
				$id_pd=$id_pd1.'-'.$id_pd2.'-'.$id_pd3.'-'.$id_pd4.'-'.$id_pd5;
                $sql1 = "insert into ptk(ptk_id,nama,gelar,jenis_kelamin,tempat_lahir,tanggal_lahir,nik,status_kepegawaian_id,jenis_ptk_id,tmt,status_keaktifan_id,gambar) values('$id_pd','$nama','$gelar','$jk','$tempat','$tanggal','$nik','$status','$jenis','$tmt','1','user-default.jpg')";
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
		header("location:../daftar-ptk");
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>