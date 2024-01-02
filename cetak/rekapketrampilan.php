<?php
require_once('fpdf/fpdf.php');
require_once('../function/db_connect.php');
function namahari($tanggal){
    
		//fungsi mencari namahari
		//format $tgl YYYY-MM-DD
		//harviacode.com
		
		$tgl=substr($tanggal,8,2);
		$bln=substr($tanggal,5,2);
		$thn=substr($tanggal,0,4);

		$info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
		
		switch($info){
			case '0': return "Minggu"; break;
			case '1': return "Senin"; break;
			case '2': return "Selasa"; break;
			case '3': return "Rabu"; break;
			case '4': return "Kamis"; break;
			case '5': return "Jumat"; break;
			case '6': return "Sabtu"; break;
		};
		
	}
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
	}

class PDF extends FPDF{
function Header(){
   global $connect;
   
	//$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
	$kelas=$_GET['kelas'];
	$mp=$_GET['mp'];
	$mapel=$connect->query("select * from mapel where id_mapel='$mp'")->fetch_assoc();
	$ab=substr($kelas, 0, 1);
	$tapel=$_GET['tapel'];
	$tahun1=substr($tapel,0,4);
	$tahun2=substr($tapel,5,4);
	$smt=$_GET['smt'];
    
   $this->SetTextColor(0,0,0);
   $this->SetFont('Arial','B','12');
   $this->Ln(0);
   //$this->Cell(16,0.5, $this->Image('logo.jpg', $this->GetX(), $this->GetY(),1.7,1.7,0,0), 0, 0, 'L', false );
    //$this->Cell(0.3,0.5,'',0,0,'L',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    //$this->Ln(0);
   $this->Cell(31,1,'REKAPITULASI NILAI KETRAMPILAN',0,0,'C');
   $this->Ln(1.5);
   //$this->Ln(0.5);

   

   $this->SetFont('Arial','','9');
   $this->Cell(4,0.5,'Nama Sekolah',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,'SD ISLAM AL-JANNAH','B',0,'L');
   $this->Cell(8,0.5,'',0,0,'L');
   $this->Cell(5,0.5,'Status',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,'Swasta','B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'Alamat',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,'Jl. Raya Gabuswetan No. 1','B',0,'L');
   $this->Cell(8,0.5,'',0,0,'L');
   $this->Cell(5,0.5,'Tahun Pelajaran / Semester',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,$tapel,'B',0,'L');

   $this->Ln(0.5);
   $this->Cell(4,0.5,'Mata Pelajaran',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,$mapel['nama_mapel'],'B',0,'L');
   $this->Cell(8,0.5,'',0,0,'L');
   $this->Cell(5,0.5,'Semester',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(3,0.5,$smt,'B',0,'L');
   $this->Ln(0.5);
   $this->Cell(4,0.5,'Kelas',0,0,'L');
   $this->Cell(0.3,0.5,':',0,0,'L');
   $this->Cell(7.5,0.5,$kelas,'B',0,'L');
      
   
   $this->SetFont('Arial','B','8');
   $this->SetFillColor(192,192,192);
   $this->Ln(1.2);
   $this->SetTextColor(0,0,0);
   $ceklebar=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp'")->num_rows;
   $lebar=23/($ceklebar*3);
   $this->Cell(1,3*0.8,'No','LTB',0,'C',1);
   $this->Cell(7,3*0.8,'Nama Lengkap Siswa','LTB',0,'C',1);
   $x = $this->GetX();
   $que="select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by tema order by tema asc";
   $peta=$connect->query($que);
   $this->SetX($x);
   while($s=$peta->fetch_assoc()){
	   $tema=$s['tema'];
	   $ckd=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp' and tema='$tema'")->num_rows;
	   $kd=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp' and tema='$tema'")->fetch_assoc();
	   $lebars1=3*$lebar*$ckd;
	   $this->Cell($lebars1,0.8,$s['tema'],'LTBR',0,'C',1);
   };
   $this->Ln(0.8);
   //$this->Cell(1,1,'','',0,'C',1);
   //$this->Cell(7,1,'','',0,'C',1);
   $que1="select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='3' and mapel='$mp' group by tema order by tema asc";
   $peta1=$connect->query($que1);
   $this->SetX($x);
   while($s1=$peta1->fetch_assoc()){
	   $tema1=$s1['tema'];
	   $ckd1=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp' and tema='$tema1'")->num_rows;
	   $lebars2=3*$lebar;
	   $que2="select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp' and tema='$tema1' order by nama_peta asc";
	   $peta2=$connect->query($que2);
	   while($s2=$peta2->fetch_assoc()){
		$this->Cell($lebars2,0.8,$s2['nama_peta'],'LTBR',0,'C',1);
	   };
   }
   $this->Ln(0.8);
   $this->SetX($x);
   $que2="select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp'";
   $peta2=$connect->query($que2);
   while($s2=$peta2->fetch_assoc()){
	   $this->Cell($lebar,0.8,'PR','LTBR',0,'C',1);
	   $this->Cell($lebar,0.8,'PY','LTBR',0,'C',1);
	   $this->Cell($lebar,0.8,'PO','LTBR',0,'C',1);
   }
   $this->Ln(0.8);
   

  }
  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,1,'Daftar Nilai Pengetahuan - Halaman : '. $this->PageNo(),0,0,'R');
  }
 }


$i = 0;
$kelas=$_GET['kelas'];
$tapel=$_GET['tapel'];
$tahun1=substr($tapel,0,4);
	$tahun2=substr($tapel,5,4);
$mp=$_GET['mp'];
$mapel=$connect->query("select * from mapel where id_mapel='$mp'")->fetch_assoc();
$smt=$_GET['smt'];
$ab=substr($kelas, 0, 1);
$ceklebar=$connect->query("select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp'")->num_rows;
   $lebar=23/($ceklebar*3);
$qsis = $connect->query("select * from penempatan where rombel='$kelas' and tapel='$tapel' and smt='$smt' order by nama asc");

    


   $pdf = new PDF('L','cm',array(33,21.5));
   $pdf->AliasNbPages();
   $pdf->AddPage();
   //$pdf->SetFont('Arial','','9');
   $pdf->SetTextColor(0,0,0);
   $pdf->SetTitle("Rekapitulasi Nilai Ketrampilan ~ APINS");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");

   $pdf->SetFont('Arial','','8');
   $urut=1;
   $tinggi=0.6;
   while($siswa=$qsis->fetch_assoc()){
	   $idp=$siswa['peserta_didik_id'];
	   $pdf->Cell(1,$tinggi,$urut,'LTBR',0,'L');
	   $urut++;
	   $pdf->Cell(7,$tinggi,$siswa['nama'],'LTBR',0,'L');
	   $que2="select * from pemetaan where kelas='$ab' and smt='$smt' and kd_aspek='4' and mapel='$mp' order by tema, nama_peta asc";
	   $peta2=$connect->query($que2);
	   
	   while($s2=$peta2->fetch_assoc()){
		   $tema=$s2['tema'];
		   $kd=$s2['nama_peta'];
		   $m1=$connect->query("select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$tema' and kd='$kd' and jns='prak'")->fetch_assoc();
		   $m2=$connect->query("select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$tema' and kd='$kd' and jns='proy'")->fetch_assoc();
		   $m3=$connect->query("select * from nk where id_pd='$idp' and smt='$smt' and tapel='$tapel' and mapel='$mp' and tema='$tema' and kd='$kd' and jns='port'")->fetch_assoc();
		   if($m1['nilai']==0){
             $pdf->Cell($lebar,$tinggi,'','LTBR',0,'C');
           }else{
             $pdf->Cell($lebar,$tinggi,number_format($m1['nilai'],0),'LTBR',0,'C');
           }
         if($m2['nilai']==0){
           $pdf->Cell($lebar,$tinggi,'','LTBR',0,'C');
           }else{
           $pdf->Cell($lebar,$tinggi,number_format($m2['nilai'],0),'LTBR',0,'C');
           }
         if($m3['nilai']==0){
           $pdf->Cell($lebar,$tinggi,'','LTBR',0,'C');
           }else{
           $pdf->Cell($lebar,$tinggi,number_format($m3['nilai'],0),'LTBR',0,'C');
           };
	   };
	   
	   $pdf->Ln($tinggi);
   }
    $query1 = $connect->query("select * from rombel where nama_rombel='$kelas' and tapel='$tapel'");
	$wali = $query1->fetch_assoc();
	$idwali=$wali['wali_kelas'];
	$idpend=$wali['pendamping'];
	$namawali = $connect->query("select * from ptk where ptk_id='$idwali'")->fetch_assoc();
	if($namawali['gelar']===''){
		$walikelas=$namawali['nama'];
	}else{
		$walikelas=$namawali['nama'].', '.$namawali['gelar'];
	}
	$namapend = $connect->query("select * from ptk where ptk_id='$idpend'")->fetch_assoc();
	if($namapend['gelar']===''){
		$pendamping=$namapend['nama'];
	}else{
		$pendamping=$namapend['nama'].', '.$namapend['gelar'];
	};
   $pdf->Ln(0.5);
   $pdf->Cell(10,0.5,'Keterangan',0,0,'L');
   $pdf->Cell(10,0.5,'Guru Kelas',0,0,'L');
   $pdf->Ln(0.5);
   $pdf->Cell(4,0.3,'PR = Nilai Praktek',0,0,'L');
$pdf->Ln(0.5);
$pdf->Cell(4,0.3,'PY = Nilai Proyek',0,0,'L');
$pdf->Ln(0.5);
$pdf->Cell(10,0.3,'PO = Nilai Portofolio',0,0,'L');
$pdf->Cell(10,0.5,$walikelas,0,0,'L');
 
  $pdf->Output();
$namafilenya="Rekapitulasi Nilai Pengetahuan ".$mapel['nama_mapel']." ".$kelas." Semester ".$smt." Tahun Pelajaran ".$tahun1."-".$tahun2.".pdf";
//$pdf->Output('D',$namafilenya);
 ?>
