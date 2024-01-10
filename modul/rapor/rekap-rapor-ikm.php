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
$ab=substr($kelas,0,1);
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['peserta_didik_id'];
    $namas = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
	$sql1 = "select * from mata_pelajaran order by id_mapel asc";
	$query1 = $connect->query($sql1);
	$nilaimp='';
	while ($row1 = $query1->fetch_assoc()) {
		$idm=$row1['id_mapel'];
		$ada1=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->num_rows;
		if($ada1>0){
			$nh1=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idm'")->fetch_assoc();
			$nilai1=number_format($nh1['nilai'],0);
		}else{
			$nilai1="";
		};
		$nilaimp=$nilaimp+$nilai1+',';
	}
	$nilaimpl=substr($nilaimp, 0, -1);
	
	//Jumlah
	$jumlah=$connect->query("select sum(nilai) as jumlah from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
	$total=$jumlah['jumlah'];
	$cekrapor=$connect->query("SELECT * FROM ranking_ikm WHERE id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel'")->num_rows;
	if($cekrapor>0){
		$idr=$connect->query("SELECT * FROM ranking_ikm WHERE id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
		$idrp=$idr['id_rank'];
		$sql1 = "UPDATE ranking_ikm set jumlah='$total' WHERE id_rank='$idrp'";
		$query1 = $connect->query($sql1);
	}else{
		$sql1 = "INSERT INTO ranking_ikm(id_pd,kelas,tapel,smt,jumlah) VALUES('$idp','$kelas','$tapel','$smt','$total')";
		$query1 = $connect->query($sql1);
	};
	//Rerata
	$rerata=$connect->query("select AVG(nilai) as rerata from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel'")->fetch_assoc();
	
	$ranking=$connect->query("select id_pd,jumlah,(select find_in_set(jumlah,(select group_concat(distinct jumlah order by jumlah desc separator ',') from ranking_ikm where kelas='$kelas' AND smt='$smt' AND tapel='$tapel'))) as ranking from ranking_ikm where id_pd='$idp' AND kelas='$kelas' AND smt='$smt' AND tapel='$tapel'")->fetch_assoc();
	
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$namas['nama'],
		$nilaimpl,number_format($jumlah['jumlah'],0),number_format($rerata['rerata'],2),$ranking['ranking']
	);
}

// database connection close
$connect->close();

echo json_encode($output);