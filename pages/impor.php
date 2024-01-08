<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once 'DataSource.php';
require_once '../config/db_connect.php';
$db = new DataSource();
$conn = $db->getConnection();
require_once ('../assets/vendor/PhpSpreadsheet/vendor/autoload.php');

if (isset($_POST["import"])) {
	$tapel=$_POST['tapel'];
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
		$ckkur=$connect->query("select * from rombel where nama_rombel like '%6%' and tapel='$tapel'")->fetch_assoc();
		$nkur=$ckkur['kurikulum'];
		$idkur=$connect->query("select * from kurikulum where nama_kurikulum='$nkur'")->fetch_assoc();
		$idk=$idkur['id_kurikulum'];
		if($ckkur['kurikulum']=='Kurikulum 2013'){
			$sql4 = "select * from mapel order by id_mapel asc";
		}else{
			$sql4 = "select * from mata_pelajaran order by id_mapel asc";
		};
        for ($i = 1; $i <= $sheetCount; $i ++) {
            $name = "";
            if (isset($spreadSheetAry[$i][0])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $pai = "";
            if (isset($spreadSheetAry[$i][2])) {
                $pai = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }
			$pkn = "";
            if (isset($spreadSheetAry[$i][3])) {
                $pkn = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }
			$bin = "";
            if (isset($spreadSheetAry[$i][4])) {
                $bin = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
            }
			$mtk = "";
            if (isset($spreadSheetAry[$i][5])) {
                $mtk = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }
			$ipa = "";
            if (isset($spreadSheetAry[$i][6])) {
                $ipa = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }
			$ips = "";
            if (isset($spreadSheetAry[$i][7])) {
                $ips = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
            }
			$sbdp = "";
            if (isset($spreadSheetAry[$i][8])) {
                $sbdp = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
            }
			$pjok = "";
            if (isset($spreadSheetAry[$i][9])) {
                $pjok = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
            }
			$bid = "";
            if (isset($spreadSheetAry[$i][10])) {
                $bid = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
            }
			$pbp = "";
            if (isset($spreadSheetAry[$i][11])) {
                $pbp = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]);
            }

            if (! empty($name) || ! empty($pai) || ! empty($pkn) || ! empty($bin) || ! empty($mtk) || ! empty($ipa) || ! empty($ips) || ! empty($sbdp) || ! empty($pjok) || ! empty($bid) || ! empty($pbp)) {
                $query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'1',
                    $pai
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'2',
                    $pkn
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'3',
                    $bin
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'4',
                    $mtk
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'5',
                    $ipa
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'6',
                    $ips
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'7',
                    $sbdp
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'8',
                    $pjok
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'9',
                    $bid
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
				
				$query = "insert into nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) values(?,?,?,?,?)";
                $paramType = "ssddd";
                $paramArray = array(
                    $tapel,
					$name,
					$idk,
					'11',
                    $pbp
                );
                $insertId = $db->insert($query, $paramType, $paramArray);

                if (! empty($insertId)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
				header("location:../nilai-us");
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>