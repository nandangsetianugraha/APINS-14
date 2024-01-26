<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$idr=$_POST['member_id'];
	if(empty($idr)){
		$validator['success'] = false;
		$validator['messages'] = "Error! Saat Menghapus Siswa";
	}else{
			$siswa = $connect->query("select * from siswa where id='$idr'")->fetch_assoc();
			$ids = $siswa['peserta_didik_id'];
			
			//hapus data yang terkait
			$sql1 = "DELETE from data_absensi where peserta_didik_id='$ids'";
			$query1 = $connect->query($sql1);
			$sql2 = "DELETE from data_ekskul where peserta_didik_id='$ids'";
			$query2 = $connect->query($sql2);
			$sql3 = "DELETE from data_kesehatan where peserta_didik_id='$ids'";
			$query3 = $connect->query($sql3);
			$sql4 = "DELETE from data_prestasi where peserta_didik_id='$ids'";
			$query4 = $connect->query($sql4);
			$sql5 = "DELETE from data_register where peserta_didik_id='$ids'";
			$query5 = $connect->query($sql5);
			$sql6 = "DELETE from penempatan where peserta_didik_id='$ids'";
			$query6 = $connect->query($sql6);
			$sql7 = "DELETE from penilaian_proyek where peserta_didik_id='$ids'";
			$query7 = $connect->query($sql7);
			$sql8 = "DELETE from prestasi where peserta_didik_id='$ids'";
			$query8 = $connect->query($sql8);
			$sql9 = "DELETE from saran where peserta_didik_id='$ids'";
			$query9 = $connect->query($sql9);
			// hapus data rapor baik k13 maupun merdeka
			$sql10 = "DELETE from deskripsi_k13 where id_pd='$ids'";
			$query10 = $connect->query($sql10);
			$sql11 = "DELETE from formatif where id_pd='$ids'";
			$query11 = $connect->query($sql11);
			$sql12 = "DELETE from nats where id_pd='$ids'";
			$query12 = $connect->query($sql12);
			$sql13 = "DELETE from nh where id_pd='$ids'";
			$query13 = $connect->query($sql13);
			$sql14 = "DELETE from nk where id_pd='$ids'";
			$query14 = $connect->query($sql14);
			$sql15 = "DELETE from nso where id_pd='$ids'";
			$query15 = $connect->query($sql15);
			$sql16 = "DELETE from nso_pai where id_pd='$ids'";
			$query16 = $connect->query($sql16);
			$sql17 = "DELETE from nsp where id_pd='$ids'";
			$query17 = $connect->query($sql17);
			$sql18 = "DELETE from nsp_pai where id_pd='$ids'";
			$query18 = $connect->query($sql18);
			$sql19 = "DELETE from nuts where id_pd='$ids'";
			$query19 = $connect->query($sql19);
			$sql20 = "DELETE from ranking_ikm where id_pd='$ids'";
			$query20 = $connect->query($sql20);
			$sql21 = "DELETE from raport where id_pd='$ids'";
			$query21 = $connect->query($sql21);
			$sql22 = "DELETE from raport_ikm where id_pd='$ids'";
			$query22 = $connect->query($sql22);
			$sql23 = "DELETE from raport_k13 where id_pd='$ids'";
			$query23 = $connect->query($sql23);
			$sql24 = "DELETE from sas where id_pd='$ids'";
			$query24 = $connect->query($sql24);
			$sql25 = "DELETE from sikap where id_pd='$ids'";
			$query25 = $connect->query($sql25);
			$sql26 = "DELETE from sts where id_pd='$ids'";
			$query26 = $connect->query($sql26);
			$sql27 = "DELETE from sumatif where id_pd='$ids'";
			$query27 = $connect->query($sql27);
			$sql28 = "DELETE from uas where id_pd='$ids'";
			$query28 = $connect->query($sql28);
			$sql29 = "DELETE from uasbn where id_pd='$ids'";
			$query29 = $connect->query($sql29);
			$sql30 = "DELETE from uasbn_praktek where id_pd='$ids'";
			$query30 = $connect->query($sql30);
			$sql31 = "DELETE from ulhar where id_pd='$ids'";
			$query31 = $connect->query($sql31);
			
			$sql = "DELETE from siswa where id='$idr'";
			$query = $connect->query($sql);
			$validator['success'] = true;
			$validator['messages'] = 'Siswa Berhasil dihapus';
			
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}