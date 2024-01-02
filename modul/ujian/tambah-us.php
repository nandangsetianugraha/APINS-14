<?php 

require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$id=$_POST['idpd'];
	$smt=$_POST['smt'];
	$tapel=$_POST['tapel'];
	$kur=$_POST['kur'];
	$ckkur=$connect->query("select * from rombel where nama_rombel like '%6%' and tapel='$tapel'")->fetch_assoc();
	$nkur=$ckkur['kurikulum'];
	$idkur=$connect->query("select * from kurikulum where nama_kurikulum='$nkur'")->fetch_assoc();
	$idk=$idkur['id_kurikulum'];
	if($ckkur['kurikulum']=='Kurikulum 2013'){
		$sql4 = "select * from mapel order by id_mapel asc";
	}else{
		$sql4 = "select * from mata_pelajaran order by id_mapel asc";
	};
	$query4 = $connect->query($sql4);
	//$saran=$connect->real_escape_string($_POST['sarantext']);
	if(empty($tapel) || empty($id)){
		$validator['success'] = false;
		$validator['messages'] = "Saran tidak boleh kosong";
	}else{
		while($nk=$query4->fetch_assoc()){
			$idmp=$nk['id_mapel'];
			$nilai[$idmp]=$connect->real_escape_string($_POST['mapel'.$idmp]);
			$cekn = $connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$id' and kurikulum='$idk' and mapel='$idmp'")->num_rows;
			if($cekn>0){
				$m=$connect->query("select * from nilai_us where tapel='$tapel' and peserta_didik_id='$id' and kurikulum='$idk' and mapel='$idmp'")->fetch_assoc();
				$idn=$m['id_us'];
				//$nilaius=$m['nilai'];
				$sql = "update nilai_us set nilai='$nilai[$idmp]' where id_us='$idn'";
				$query = $connect->query($sql);
			}else{
				if($nilai[$idmp]=='' or empty($nilai[$idmp])){
				}else{
					$sql = "INSERT INTO nilai_us(tapel,peserta_didik_id,kurikulum,mapel,nilai) VALUES('$tapel','$id','$kur','$idmp','$nilai[$idmp]')";
					$query = $connect->query($sql);
				};
			};
		};
		$validator['success'] = true;
		$validator['messages'] = "OK";		
	};
	
	// close the database connection
	$connect->close();

	echo json_encode($validator);

}