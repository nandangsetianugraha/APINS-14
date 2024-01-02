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
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
};
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$output = array('data' => array());
if($kelas==0){
	$sql = "select * from penempatan where tapel='$tapel' and smt='$smt' order by rombel asc";
}else{
	$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
};
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
	$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$nomor=$nama['no_wa'];
	$nh='
	<span class="input form-control form-control-sm" contenteditable="true" data-old_value="'.$nomor.'"  onBlur="saveWA(this,\'no_wa\',\''.$idp.'\')" onClick="highlightEdit(this);">'.$nomor.'</span>
	';
	$output['data'][] = array(
		$nama['nama'],
		$nh
	);
}

// database connection close
$connect->close();

echo json_encode($output);