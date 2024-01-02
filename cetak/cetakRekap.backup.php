<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../assets/db_connect.php';
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
$idp=$_GET['idp'];
$kelas=$_GET['kelas'];
$smt=$_GET['smt'];
$mp=$_GET['mp'];
$ab=substr($kelas, 0, 1);
$tapel=$_GET['tapel'];
$sqls = "select * from siswa where peserta_didik_id='$idp'";
$querys = $connect->query($sqls);
$siswa=$querys->fetch_assoc();
$rombs=$connect->query("select * from penempatan where peserta_didik_id='$idp' and tapel='$tapel'")->fetch_assoc();
$nmapel=$connect->query("select * from mapel where id_mapel='$mp'")->fetch_assoc();
$jKD=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta order by nama_peta asc")->num_rows;
$namafilenya="Rekap Nilai ".$nmapel['nama_mapel']." Semester ".$smt.".pdf";
 $pdf=new exFPDF('L','mm',array(330,215));
 //halaman 1
 $pdf->AddPage(); 
 $pdf->SetFont('helvetica','',12);

 $table2=new easyTable($pdf, 1);
 $table2->rowStyle('font-size:15; font-style:B;');
 $table2->easyCell('DAFTAR NILAI ASPEK PENGETAHUAN', 'align:C;');
 $table2->printRow();
 $table2->easyCell('Mata Pelajaran : '.$nmapel['nama_mapel'], 'align:C;');
 $table2->printRow();
 $table2->endTable(5);
 
  $table2=new easyTable($pdf, 3);
 $table2->rowStyle('font-size:12; font-style:B;');
 $table2->easyCell('Kelas : '.$kelas, 'align:L;');
 $table2->easyCell('Tahun Pelajaran : '.$tapel, 'align:C;');
 $table2->easyCell('Semester : '.$smt, 'align:R;');
 $table2->printRow();
 $table2->endTable(5);
 
 $table3=new easyTable($pdf, '{10,30,70,10,10,10,10,10,10,10,10,10,10,10,15,10,70}','align:C;border:1');
 $table3->rowStyle('font-size:10');
 $table3->easyCell('No','align:C;rowspan:2');
 $table3->easyCell('NIS','align:C;rowspan:2');
 $table3->easyCell('Nama Peserta Didik','align:C;rowspan:2');
 $table3->easyCell('KD','align:C;rowspan:2');
 $table3->easyCell('KKM KD','align:C;rowspan:2');
 $table3->easyCell('PH TEMA','align:C;colspan:4');
 $table3->easyCell('Nilai PH','align:C;rowspan:2');
 $table3->easyCell('Nilai PTS','align:C;rowspan:2');
 $table3->easyCell('Nilai PAS','align:C;rowspan:2');
 $table3->easyCell('Nilai KD','align:C;rowspan:2');
 $table3->easyCell('Predikat','align:C;rowspan:2');
 $table3->easyCell('Nilai Rapor','align:C;rowspan:2');
 $table3->easyCell('Predikat','align:C;rowspan:2');
 $table3->easyCell('Deskripsi Raport','align:C;rowspan:2');
 $table3->printRow();
 $table3->rowStyle('font-size:10');
 $table3->easyCell('5','align:C;');
 $table3->easyCell('6','align:C;');
 $table3->easyCell('7','align:C;');
 $table3->easyCell('8','align:C;');
 $table3->printRow();
 /*
 $skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
$qkl = $connect->query($skl);
while($sis=$qkl->fetch_assoc()){
 
}
*/
 $skl = "select * from penempatan where rombel='$kelas' and tapel='$tapel' order by nama asc";
 $qkl = $connect->query($skl);
 $ah=0;
 while($sis=$qkl->fetch_assoc()){
	 $ah++;
	 $nkd=0;
	 $ids=$sis['peserta_didik_id'];
	 $nto=$connect->query("select * from siswa where peserta_didik_id='$ids'")->fetch_assoc();
	 $table3->easyCell($ah,'align:C;rowspan:'.$jKD);
	 $table3->easyCell($nto['nis'],'align:C;rowspan:'.$jKD);
	 $table3->easyCell($nto['nama'],'align:C;rowspan:'.$jKD);
	 $data1=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta limit 0,1")->fetch_assoc();
	 $kda=$data1['nama_peta'];
	 $namakd=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->fetch_assoc();
	 $skl1 = "select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by nama_peta limit 1,10";
	 $qkl1 = $connect->query($skl1);
	 
		 $table3->easyCell($data1['nama_peta'],'align:C;');
		 $table3->easyCell($namakd['kd'],'align:C;');
		 for ($i = 5; $i < 9; $i++){
			 $dNH=$connect->query("select AVG(nilai) as nilai_kd from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$i' and kd='$kda'")->fetch_assoc();
			 $nkd=$dNH['nilai_kd'];
			 if($nkd==0){
				$table3->easyCell('','bgcolor:#acaeaf;'); 
			 }else{
			 $table3->easyCell(number_format($nkd,0),'align:C;');
			 };
		 };
		 $adaNH1=$connect->query("select AVG(nilai) as nilai_nh from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->num_rows;
		 if($adaNH1>0){
		 $rNH=$connect->query("select AVG(nilai) as nilai_nh from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->fetch_assoc();
		 $nilaiNH1=$rNH['nilai_nh'];
		 }else{
			 $nilaiNH1=0;
		 };
		 $table3->easyCell(number_format($nilaiNH1,0),'align:C;');
		 $adaPTS=$connect->query("select * from nuts where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->num_rows;
		 if($adaPTS>0){
			$nPTS=$connect->query("select * from nuts where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->fetch_assoc();
			$nilaiPTS=$nPTS['nilai'];
		 }else{
			 $nilaiPTS=0;
		 };
		 $table3->easyCell(number_format($nilaiPTS,0),'align:C;');
		 $adaPAS=$connect->query("select * from nats where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->num_rows;
		 if($adaPAS>0){
		 $nPAS=$connect->query("select * from nats where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda'")->fetch_assoc();
		 $nilaiPAS=$nPAS['nilai'];
		 }else{
			 $nilaiPAS=0;
		 };
		 $table3->easyCell(number_format($nilaiPAS,0),'align:C;');
		 if($nilaiPTS==0){
			 $naKD=(2*$nilaiNH1+$nilaiPAS)/3;
		 }else{
			 $naKD=(2*$nilaiNH1+$nilaiPAS+$nilaiPTS)/4;
		 };
		 $table3->easyCell(number_format($naKD,0),'align:C;');
		 $table3->easyCell('','align:C;');
		 $table3->easyCell('','align:C;rowspan:'.$jKD);
		 $table3->easyCell('','align:C;rowspan:'.$jKD);
		 $table3->easyCell('','align:C;rowspan:'.$jKD);
		 $table3->printRow();
		while($sis1=$qkl1->fetch_assoc()){
		 $kda1=$sis1['nama_peta'];
		 $namakd1=$connect->query("select * from kkmku where kelas='$ab' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->fetch_assoc();
		 $table3->easyCell($sis1['nama_peta'],'align:C;');
		 $table3->easyCell($namakd1['kd'],'align:C;');
		 for ($i = 5; $i < 9; $i++){
			 $dNH=$connect->query("select AVG(nilai) as nilai_kd from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$i' and kd='$kda1'")->fetch_assoc();
			 $nkd=$dNH['nilai_kd'];
			 if($nkd==0){
				 $table3->easyCell('','bgcolor:#acaeaf;');
			 }else{
			 $table3->easyCell(number_format($nkd,0),'align:C;');
			 };
		 };
		 $adaNH=$connect->query("select AVG(nilai) as nilai_nh from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->num_rows;
		 if($adaNH>0){
		 $rNH=$connect->query("select AVG(nilai) as nilai_nh from nh where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->fetch_assoc();
		 $nilaiNH=$rNH['nilai_nh'];
		 }else{
			 $nilaiNH=0;
		 };
		 $table3->easyCell(number_format($nilaiNH,0),'align:C;');
		 $adaPTS1=$connect->query("select * from nuts where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->num_rows;
		 if($adaPTS1>0){
		 $nPTS=$connect->query("select * from nuts where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->fetch_assoc();
		 $nilaiPTS1=$nPTS['nilai'];
		 }else{
			 $nilaiPTS1=0;
		 };
		 $table3->easyCell(number_format($nilaiPTS1,0),'align:C;');
		 $adaPAS1=$connect->query("select * from nats where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->num_rows;
		 if($adaPAS1>0){
		 $nPAS=$connect->query("select * from nats where id_pd='$ids' and kelas='$ab' and smt='$smt' and tapel='$tapel' and mapel='$mp' and kd='$kda1'")->fetch_assoc();
		 $nilaiPAS1=$nPAS['nilai'];
		 }else{
			 $nilaiPAS1=0;
		 };
		 $table3->easyCell(number_format($nilaiPAS1,0),'align:C;');
		 if($nilaiPTS1==0){
			 $naKD=(2*$nilaiNH+$nilaiPAS1)/3;
		 }else{
			 $naKD=(2*$nilaiNH+$nilaiPAS1+$nilaiPTS1)/4;
		 };
		 $table3->easyCell(number_format($naKD,0),'align:C;');
		 $table3->easyCell('','align:C;');
		 $table3->printRow();
	 };
 };
 $table3->endTable(10);
 
//====================================================================



 $pdf->Output();


 

?>