<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
 
	$kelas=$_GET['kelas'];
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$smt=$_GET['smt'];
	$tipe=$_GET['tipe'];
	if($tipe==1){
		$tipe="PTS";
	}else{
		$tipe="PAS";
	};
	if($smt==1){
		$romawi='I';
		$huruf='GANJIL';
	}else{
		$romawi='II';
		$huruf='GENAP';
	};
	$namafilenya="Form F1 ".$tipe." Kelas ".$kelas." Semester ".$smt.".pdf";
		//Jumlah Siswa 
		$jsiswa=$connect->query("select count(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$namamapel=$connect->query("select * from mapel order by id_mapel asc")->fetch_assoc();
		$pdf=new exFPDF('P','mm',array(215,330));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',12);

		$table2=new easyTable($pdf, 1);
		$table2->rowStyle('font-size:14');
		$table2->easyCell('LAPORAN PENCAPAIAN TARGET KURIKULUM, KETUNTASAN BELAJAR','align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:14');
		$table2->easyCell('DAN TARAP SERAP KURIKULUM SEKOLAH DASAR','align:C;font-style:B');
		$table2->printRow();
		$table2->rowStyle('font-size:14');
		$table2->easyCell('TAHUN PELAJARAN '.$tapel,'align:C;font-style:B');
		$table2->printRow();
		$table2->endTable(5);
		
		$table2=new easyTable($pdf, '{105,5,105}');
		$table2->rowStyle('font-size:12');
		$table2->easyCell('SEMESTER','align:R');
		$table2->easyCell(':','align:C');
		$table2->easyCell($romawi.' / '.$tipe.' '.$huruf,'align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:12');
		$table2->easyCell('KELAS','align:R');
		$table2->easyCell(':','align:L');
		$table2->easyCell($kelas,'align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:12');
		$table2->easyCell('SEKOLAH DASAR','align:R');
		$table2->easyCell(':','align:L');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:12');
		$table2->easyCell('KECAMATAN','align:R');
		$table2->easyCell(':','align:L');
		$table2->easyCell('GABUSWETAN','align:L');
		$table2->printRow();
		$table2->rowStyle('font-size:12');
		$table2->easyCell('KABUPATEN','align:R');
		$table2->easyCell(':','align:L');
		$table2->easyCell('INDRAMAYU','align:L');
		$table2->printRow();
		$table2->endTable(2);
		
		$table3=new easyTable($pdf, '{204,15}','align:L');
		$table3->rowStyle('font-size:9');
		$table3->easyCell('','align:C');
		$table3->easyCell('F1','align:C;border:1');
		$table3->printRow();
		$table3->endTable(1);
		
		$table3=new easyTable($pdf, '{9,47,24,13,13,13,10,18,12,12,9,24,15}','align:L;border:1');
		$table3->rowStyle('font-size:8');
		$table3->easyCell('NO','rowspan:3;align:C');
		$table3->easyCell('MATA PELAJARAN','rowspan:3;align:C');
		$table3->easyCell('TARGET KURIKULUM (%)','rowspan:3;align:C');
		$table3->easyCell('NILAI','colspan:3;align:C');
		$table3->easyCell('KETUNTASAN','colspan:5;align:C');
		$table3->easyCell('TARAP SERAP KURIKULUM','rowspan:3;align:C');
		$table3->easyCell('KET','rowspan:3;align:C');
		$table3->printRow();
		$table3->rowStyle('font-size:8');
		$table3->easyCell($tipe,'colspan:3;align:C');
		$table3->easyCell('KKM','rowspan:2;align:C');
		$table3->easyCell('JUMLAH SISWA','rowspan:2;align:C');
		$table3->easyCell('NILAI','colspan:2;align:C');
		$table3->easyCell('%','rowspan:2;align:C');
		$table3->printRow();
		$table3->rowStyle('font-size:8');
		$table3->easyCell('NTT','align:C');
		$table3->easyCell('NTR','align:C');
		$table3->easyCell('RT2','align:C');
		$table3->easyCell('>= KKM','align:C');
		$table3->easyCell('< KKM','align:C');
		$table3->printRow();
		$walikelas=$connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$idwk=$walikelas['wali_kelas'];
		$namawk=$connect->query("select * from ptk where ptk_id='$idwk'")->fetch_assoc();
		
		$jntt=0;
		$cntt=0;
		$jntr=0;
		$cntr=0;
		$jrt2=0;
		$crt2=0;
		//PAI
		$idpel=1;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$qkl = $connect->query("select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		
		$table3->rowStyle('font-size:9');
		$table3->easyCell('1','align:C');
		$table3->easyCell('Pendidikan Agama','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//PKn
		$idpel=2;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('2','align:C');
		$table3->easyCell('Pendidikan Kewarganegaraan','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//Bahasa
		$idpel=3;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('3','align:C');
		$table3->easyCell('Bahasa Indonesia','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//Matematika
		$idpel=4;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('4','align:C');
		$table3->easyCell('Matematika','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//IPA
		if($ab>3){
		$idpel=5;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('5','align:C');
		$table3->easyCell('Ilmu Pengetahuan Alam','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		}else{
			$table3->rowStyle('font-size:9');
			$table3->easyCell('5','align:C');
			$table3->easyCell('Ilmu Pengetahuan Alam','align:L');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->printRow();	
		};
		
		//IPS
		if($ab>3){
		$idpel=6;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('6','align:C');
		$table3->easyCell('Ilmu Pengetahuan Sosial','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		}else{
			$table3->rowStyle('font-size:9');
			$table3->easyCell('6','align:C');
			$table3->easyCell('Ilmu Pengetahuan Sosial','align:L');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->easyCell('','bgcolor:#acaeaf;');
			$table3->printRow();	
		};
		
		//SBdP
		$idpel=7;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('7','align:C');
		$table3->easyCell('Seni Budaya dan Prakarya','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//PJOK
		$idpel=8;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('8','align:C');
		$table3->easyCell('Pendidikan Jasmani Olahraga dan Kesehatan','align:L');
		$table3->easyCell('100','align:C;valign:M');
		$table3->easyCell(number_format($nmax,0),'align:C;valign:M');
		$table3->easyCell(number_format($nmin,0),'align:C;valign:M');
		$table3->easyCell(number_format($rerata,0),'align:C;valign:M');
		$table3->easyCell($kkmsaya,'align:C;valign:M');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C;valign:M');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C;valign:M');
		$table3->easyCell('0','align:C;valign:M');
		$table3->easyCell('100','align:C;valign:M');
		$table3->easyCell(number_format($rerata,0),'align:C;valign:M');
		$table3->easyCell('Tuntas','align:C;valign:M');
		$table3->printRow();
		
		$table3->rowStyle('font-size:9');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('Muatan Lokal','align:L;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->printRow();
		
		//Budi Pekerti
		$idpel=11;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('9','align:C');
		$table3->easyCell('a. Pendidikan Budi Pekerti','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//Bahasa Indramayu 
		$idpel=9;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('10','align:C');
		$table3->easyCell('b. Bahasa Indramayu','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		//Bahasa Sunda
		$table3->rowStyle('font-size:9');
		$table3->easyCell('11','align:C');
		$table3->easyCell('c. Bahasa Sunda','align:L');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->printRow();
		
		//Bahasa Inggris
		$idpel=10;
		$kkm=$connect->query("select * from kkm where kelas='$kelas' and tapel='$tapel' and mapel='$idpel'")->fetch_assoc();
		if(empty($kkm['nilai'])){
			$kkmsaya=0;
		}else{
			$kkmsaya=$kkm['nilai'];
		};
		if($tipe=="PTS"){
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pts where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		}else{
			$skl = "select MIN(nilai) as nmin, MAX(nilai) as nmax, AVG(nilai) as rerata from temp_pas where kelas='$kelas' and smt='$smt' and tapel='$tapel' and mapel='$idpel'";
			$qkl = $connect->query($skl)->fetch_assoc();
		};
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		//$ntt=$connect->query("select min(id_rombel) as jumlah_siswa from penempatan where rombel='$kelas' and tapel='$tapel'")->fetch_assoc();
		$nmax=$qkl['nmax'];
		$nmin=$qkl['nmin'];
		$rerata=$qkl['rerata'];
		$jntt=$jntt+$nmax;
		$jntr=$jntr+$nmin;
		$jrt2=$jrt2+$rerata;
		if($nmax==0){
			$cntt=$cntt;
		}else{
			$cntt=$cntt+1;
		};
		
		if($nmin==0){
			$cntr=$cntr;
		}else{
			$cntr=$cntr+1;
		};
		if($rerata==0){
			$crt2=$crt2;
		}else{
			$crt2=$crt2+1;
		};
		if($cntt==0){$cntt=1;};
		if($cntr==0){$cntr=1;};
		if($crt2==0){$crt2=1;};
		$table3->rowStyle('font-size:9');
		$table3->easyCell('12','align:C');
		$table3->easyCell('d. Bahasa Inggris','align:L');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($nmax,0),'align:C');
		$table3->easyCell(number_format($nmin,0),'align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell($kkmsaya,'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell($jsiswa['jumlah_siswa'],'align:C');
		$table3->easyCell('0','align:C');
		$table3->easyCell('100','align:C');
		$table3->easyCell(number_format($rerata,0),'align:C');
		$table3->easyCell('Tuntas','align:C');
		$table3->printRow();
		
		$table3->rowStyle('font-size:8');
		$table3->easyCell('13','align:C');
		$table3->easyCell('e. ..........................','align:L');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->easyCell('','align:C');
		$table3->printRow();
		
		//Jumlah
		$table3->rowStyle('font-size:8');
		$table3->easyCell('JUMLAH','colspan:2;align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jntt,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jntr,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jrt2,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->printRow();
		
		//Rata-rata
		$table3->rowStyle('font-size:8');
		$table3->easyCell('RATA-RATA','colspan:2;align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jntt/$cntt,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jntr/$cntr,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell(number_format($jrt2/$crt2,0),'align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->easyCell('','align:C;bgcolor:#acaeaf;');
		$table3->printRow();
		
		$table3->endTable();
		//selesai isi tabel siswa
		
		$table1=new easyTable($pdf, 1);
		if($tipe=='PTS'){
			$table1->easyCell('', 'img:pts.jpg, w280, h20 align:R;');
		}else{
			$table1->easyCell('', 'img:pas.jpg, w280, h20 align:R;');
		}
		$table1->printRow();
		$table1->endTable();
		
		//Tertanda Wali Kelas 
		$ttd=new easyTable($pdf, '{111,11,6,72,111}');
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('Mengetahui','align:C; valign:T');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('Gabuswetan, .................. 20.......','align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('Kepala Sekolah','align:C; valign:T');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('Guru Kelas '.$kelas,'align:C; valign:T');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->printRow();
		
		$ttd->rowStyle('font-size:10');
		$ttd->easyCell('UMAR ALI, S.Pd.','align:C; valign:T');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell('');
		$ttd->easyCell(strtoupper($namawk['nama']).', '.$namawk['gelar'],'align:C; valign:T');
		$ttd->printRow();
		$ttd->endTable();
		
		$ttd=new easyTable($pdf, 1);
		$ttd->rowStyle('font-size:8');
		$ttd->easyCell('Dibuat rangkap 3 (tiga)','align:L');
		$ttd->printRow();
		$ttd->rowStyle('font-size:8');
		$ttd->easyCell('1. Warna putih untuk KWKBP / ub. Pengawas Pendidikan Kecamatan','align:L');
		$ttd->printRow();
		$ttd->rowStyle('font-size:8');
		$ttd->easyCell('2. Warna kuning untuk Kepala Sekolah','align:L');
		$ttd->printRow();
		$ttd->rowStyle('font-size:8');
		$ttd->easyCell('3. Warna hijau untuk Guru Kelas ybs.','align:L');
		$ttd->printRow();
		$ttd->endTable();
		
		
		//	$pdf->Output('D',$namafilenya);
		 $pdf->Output('D',$namafilenya);


 

?>