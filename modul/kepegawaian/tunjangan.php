<?php 
require_once '../../config/db_connect.php';
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
$output = array('data' => array());
$sql = "SELECT * FROM id_pegawai order by pegawai_id asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['pegawai_id'];
	$pegid=$row['ptk_id'];
	$namap = $connect->query("SELECT * FROM ptk WHERE ptk_id='$pegid'")->fetch_assoc();
	$pn = $connect->query("select * from gajipokok where pegawai_id='$idp'")->fetch_assoc();
	$tunj1 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['insentif'].'"  onBlur="simpankes(this,\'insentif\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['insentif'].'</span>
		';
	$tunj2 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['transport'].'"  onBlur="simpankes(this,\'transport\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['transport'].'</span>
		';
	$tunj3 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['tunj_walikelas'].'"  onBlur="simpankes(this,\'tunj_walikelas\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['tunj_walikelas'].'</span>
		';
	$tunj4 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['tunj_kepsek'].'"  onBlur="simpankes(this,\'tunj_kepsek\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['tunj_kepsek'].'</span>
		';
	$tunj5 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['tunj_kehadiran'].'"  onBlur="simpankes(this,\'tunj_kehadiran\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['tunj_kehadiran'].'</span>
		';
	$tunj6 = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$pn['tunj_ekskul'].'"  onBlur="simpankes(this,\'tunj_ekskul\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$pn['tunj_ekskul'].'</span>
		';
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$idp,
		$namap['nama'],
		$tunj1,
		$tunj2,
		$tunj3,
		$tunj4,
		$tunj5,
		$tunj6
	);
}

// database connection close
$connect->close();

echo json_encode($output);