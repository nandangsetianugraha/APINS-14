<?php 

require_once '../../config/db_connect.php';
$tapel=$_GET['tapel'];
$smt=$_GET['smt'];
$kelas=$_GET['kelas'];
$output = array('data' => array());

$sql = "select * from berita_acara where tapel='$tapel' and smt='$smt' and kelas='$kelas' order by id_bap desc";
$query = $connect->query($sql);
while($s=$query->fetch_assoc()) {
	$ids=$s['id_bap'];
	$actionButton = '
	<div class="btn-group dropup">
                      <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-align-justify"></i>
                      </button>
	                  <div class="dropdown-menu">
                        <a href="#editbap" class="dropdown-item has-icon" id="'.$ids.'" data-toggle="modal" data-id="'.$ids.'"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-trash"></i> Hapus</a>
                        <a class="dropdown-item has-icon" href="../cetak/daftarHadir.php?id='.$s['id_bap'].'" target="_blank" rel="noopener noreferrer"><i class="fa fa-print"></i> Cetak Daftar Hadir</a>
						<a class="dropdown-item has-icon" href="../cetak/beritaAcara.php?id='.$s['id_bap'].'" target="_blank" rel="noopener noreferrer"><i class="fa fa-print"></i> Cetak BAP</a>
                      </div>
                    </div>
	';
	$output['data'][] = array(
		$s['tanggal'],
		$s['jenis'].'<br/>'.$s['mapel'],
		$s['kelas'],
		$s['absen'],
		$s['mulai'],
		$s['selesai'],
		$s['pengawas1'],
		$s['pengawas2'],
		$actionButton
	);
	
};

	

// database connection close
$connect->close();

echo json_encode($output);