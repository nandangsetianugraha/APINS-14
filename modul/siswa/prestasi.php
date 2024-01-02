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
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$sqlp = "SELECT * FROM data_prestasi WHERE peserta_didik_id='$idp' and smt='$smt' and tapel='$tapel'";
	$ada = $connect->query($sqlp)->num_rows;
	if($ada>0){
	$pn = $connect->query($sqlp)->fetch_assoc();
	$tng=$pn['kesenian'];
	$brt=$pn['olahraga'];
	$telinga=$pn['akademik'];
	}else{
		$tng="";
	$brt="";
	$telinga="";
	};
	$tinggi = '
		<span class="input form-control form-control-sm"  contenteditable="true" data-old_value="'.$tng.'"  onBlur="simpankes(this,\'kesenian\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$tng.'</span>
		';
	$berat = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$brt.'"  onBlur="simpankes(this,\'olahraga\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$brt.'</span>
		';
	$pendengaran = '
		<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$telinga.'"  onBlur="simpankes(this,\'akademik\',\''.$idp.'\',\''.$smt.'\',\''.$tapel.'\')" onClick="highlightEdit(this);">'.$telinga.'</span>
		';
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$row['nama'],
		$tinggi,
		$berat,
		$pendengaran
	);
}

// database connection close
$connect->close();

echo json_encode($output);