<?php 
 
// Load the database configuration file 
require_once '../../config/db_connect.php';
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 
 
// Excel file name for download 
$fileName = "members-data_" . date('Y-m-d') . ".xlsx"; 

$kelas=$_GET['kelas'];
$ab=substr($kelas,0,1);
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];

// Define column names 
$excelData[] = array('NAMA', 'PAI', 'PP', 'BIN', 'MTK', 'IPAS', 'PJOK', 'SB', 'BIG', 'BID', 'JUMLAH', 'RERATA', 'RANK'); 
 
// Fetch records from database and store in an array 
$sql = "select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc";
$query = $connect->query($sql);

if($query->num_rows > 0){ 
    while ($row = $query->fetch_assoc()) { 
        $idp=$row['peserta_didik_id'];
		$namas = $connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
		//PAI-BP
		$ada1=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='1'")->num_rows;
		if($ada1>0){
			$nh1=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='1'")->fetch_assoc();
			$nilai1=number_format($nh1['nilai'],0);
		}else{
			$nilai1="";
		};
		
		//Pend. Pancasila
		$ada2=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='2'")->num_rows;
		if($ada2>0){
			$nh2=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='2'")->fetch_assoc();
			$nilai2=number_format($nh2['nilai'],0);
		}else{
			$nilai2="";
		};
		
		//Bahasa Indonesia
		$ada3=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='3'")->num_rows;
		if($ada3>0){
			$nh3=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='3'")->fetch_assoc();
			$nilai3=number_format($nh3['nilai'],0);
		}else{
			$nilai3="";
		};
		
		//Matematika
		$ada4=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='4'")->num_rows;
		if($ada4>0){
			$nh4=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='4'")->fetch_assoc();
			$nilai4=number_format($nh4['nilai'],0);
		}else{
			$nilai4="";
		};
		
		//IPAS
		$ada5=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='5'")->num_rows;
		if($ada5>0){
			$nh5=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='5'")->fetch_assoc();
			$nilai5=number_format($nh5['nilai'],0);
		}else{
			$nilai5="";
		};
		
		//PJOK
		$ada6=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->num_rows;
		if($ada6>0){
			$nh6=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='6'")->fetch_assoc();
			$nilai6=number_format($nh6['nilai'],0);
		}else{
			$nilai6="";
		};
		
		//Seni Rupa
		$ada7=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->num_rows;
		if($ada7>0){
			$nh7=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='7'")->fetch_assoc();
			$nilai7=number_format($nh7['nilai'],0);
		}else{
			$nilai7="";
		};
		
		//Bahasa Inggris
		$ada8=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->num_rows;
		if($ada8>0){
			$nh8=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='8'")->fetch_assoc();
			$nilai8=number_format($nh8['nilai'],0);
		}else{
			$nilai8="";
		};
		
		//Bahasa Indramayu
		$ada9=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->num_rows;
		if($ada9>0){
			$nh9=$connect->query("select * from raport_ikm where id_pd='$idp' and kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='9'")->fetch_assoc();
			$nilai9=number_format($nh9['nilai'],0);
		}else{
			$nilai9="";
		};
		
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
        $lineData = array($namas['nama'], $nilai1,$nilai2,$nilai3,$nilai4,$nilai5,$nilai6,$nilai7,$nilai8,$nilai9,number_format($jumlah['jumlah'],0),number_format($rerata['rerata'],2),$ranking['ranking']);  
        $excelData[] = $lineData; 
    } 
} 
 
// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>