<?php 

require_once '../../config/db_connect.php';
function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
};
function namahari($tanggal){
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);
    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };
};
$hariini=$_REQUEST['tanggal'];
$tahun=substr($hariini,0,4);
$bulan=substr($hariini,5,2);
$tgls=substr($hariini,8,2);
$output = array('data' => array());
$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

$sql = "select * from ptk where status_keaktifan_id=1";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['ptk_id'];
	$nsb=$connect->query("select * from id_pegawai where ptk_id='$idp'")->fetch_assoc();
	$ida=$nsb['pegawai_id'];
  	$kerja=$connect->query("select * from shift where '$hariini' between tanggal_awal and tanggal_akhir")->fetch_assoc();
	$jmasuk=$kerja['masuk'];
	if(empty($jmasuk)){
		$jmasuk="07:00:00";
	};
	$jkeluar=$kerja['keluar'];
	if(empty($jkeluar)){
		$jkeluar="15:45:00";
	};
	$sql2 = "SELECT pegawai_id,
	DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,
	min(left(RIGHT(tanggal, 8), 5)) jam1,
	MAX(left(right(tanggal, 8), 5)) jam2,
	if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '$jmasuk'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '$jmasuk'))))/60,'') diff1, 
	if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('$jkeluar', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('$jkeluar', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
	FROM absensi_ptk where pegawai_id='$ida' and DATE_FORMAT(tanggal,'%Y-%m-%d')='$hariini' group by tgl";
$jabs=$connect->query($sql2)->fetch_assoc();
$jmanual=$connect->query($sql2)->num_rows;
if($jmanual>0){
  	if(namahari($hariini)==="Sabtu" || namahari($hariini)==="Minggu"){
      $tombol='Hari Libur';
    }else{
      $ceklibur=$connect->query("select * from harilibur where '$hariini' between tanggal_awal and tanggal_akhir")->num_rows;
      if($ceklibur>0){
        $tombol='Hari Libur';
      }else{
	$tombol='
	<button class="btn btn-effect-ripple btn-xs btn-primary" data-tema="'.$ida.'" data-bs-toggle="modal" data-bs-target="#info"><i class="fa fa-calendar"></i></button>
	';
      }
    };
}else{
	$jijin=$connect->query("select * from ijin_ptk where '$hariini' between tanggal_awal and tanggal_akhir and pegawai_id='$ida'")->num_rows;
	if($jijin>0){
		$namaijin=$connect->query("select * from ijin_ptk where '$hariini' between tanggal_awal and tanggal_akhir and pegawai_id='$ida'")->fetch_assoc();
		if($namaijin['status']==="I"){
			$tombol="Ijin";
		}elseif($namaijin['status']==="S"){
			$tombol="Sakit";
		}else{
			$tombol="Cuti";
		};
		if(!empty($namaijin['keterangan'])){
			$tombol=$tombol;
		}else{
			$tombol=$tombol;
		};
	}else{
      if(namahari($hariini)==="Sabtu" || namahari($hariini)==="Minggu"){
        $tombol='Hari Libur';
      }else{
        $ceklibur=$connect->query("select * from harilibur where '$hariini' between tanggal_awal and tanggal_akhir")->num_rows;
      if($ceklibur>0){
        $tombol='Hari Libur';
      }else{
		$tombol='		
		<button class="btn btn-effect-ripple btn-xs btn-primary" data-tema="'.$ida.'" data-bs-toggle="modal" data-bs-target="#info"><i class="fa fa-calendar"></i></button>
		<button class="btn btn-effect-ripple btn-xs btn-danger" type="button" data-bs-toggle="modal" data-ids="'.$ida.'" data-tgls="'.$hariini.'" data-bs-target="#ijinmanual"><i class="fa fa-calendar"></i></button>
	';
      };
      };
	};
}
	if($jabs['jam1']==$jabs['jam2']){
      $keluar='';
      $early='';
    }else{
      $keluar=$jabs['jam2'];
      $early=$jabs['diff2'];
    }
	
	$output['data'][] = array(
		$nsb['pegawai_id'],
		$row['nama'],
		$jabs['jam1'],
		$keluar,
		$jabs['diff1'],
		$early,
		$tombol
	);
}

// database connection close
$connect->close();

echo json_encode($output);