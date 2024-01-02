<?php
require_once('fpdf/fpdf.php');
require_once('../config/config.php');
require_once('../config/db_connect.php');
	
class PDF extends FPDF{
  /**
  function Header(){
    $this->SetFont('Times','B',13);
    $this->Ln(0);
    $this->Cell(16,0.5, $this->Image('logo.jpg', $this->GetX(), $this->GetY(),2.9,2.9,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'J',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
    $this->Cell(21,0.8,'PEMERINTAH KABUPATEN INDRAMAYU',0,0,'C');
    $this->Ln(0.5);
    $this->Cell(21,0.8,'DINAS PENDIDIKAN DAN KEBUDAYAAN',0,0,'C');
    $this->Ln(0.5);
    $this->Cell(21,0.8,'YAYASAN AL-ISLAM INDRAMAYU',0,0,'C');
	$this->Ln(0.5);
	$this->SetFont('Times','B',14);
    $this->Cell(21,0.8,'SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
	$this->Ln(0.5);
	$this->SetFont('Arial','B',8);
    $this->Cell(21,0.8,'Alamat Jl. Raya Gabuswetan No. 1 Gabuswetan Indramayu Telp. (0234)2505005 Kodepos 45263',0,0,'C');
	$this->Ln(0.35);
    $this->Cell(21,0.8,'E-mail: sdi.aljannah@gmail.com Laman: https://sdi-aljannah.web.id',0,0,'C');
    $this->Ln(0.5);
	$this->SetLineWidth(0.09);
	$this->Line(1,4.2,20,4.2);
	$this->SetLineWidth(0);
	$this->Line(1,4.3,20,4.3);
	$this->Ln(0.5);
  }
  
  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,0.7,'SD ISLAM AL-JANNAH GABUSWETAN KABUPATEN INDRAMAYU - Halaman : '. $this->PageNo(),'BTRL',0,'C');
  }
 **/
 }
if($tipe==''){
	echo "Salah Server!!";
}else{
$tpl=substr($tipe,0,8);
$tpl1=substr($tpl,0,4);
$tpl2=substr($tpl,4,4);
$tapel=$tpl1.'/'.$tpl2;
$smt=substr($tipe,8,1);
   
   $pdf = new PDF('P','cm',array(21.6,33));
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->SetFont('Times','B',13);
    $pdf->Ln(0);
    $pdf->Cell(16,0.5, $pdf->Image('logo.jpg', $pdf->GetX(), $pdf->GetY(),2.9,2.9,0,0), 0, 0, 'L', false );
    $pdf->Cell(0.3,0.5,'',0,0,'J',0);
    //$pdf->Cell(1.4,0.5, $pdf->Image($gambar2, $pdf->GetX(), $pdf->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $pdf->Ln(0);
    $pdf->Cell(21,0.8,'PEMERINTAH KABUPATEN INDRAMAYU',0,0,'C');
    $pdf->Ln(0.5);
    $pdf->Cell(21,0.8,'DINAS PENDIDIKAN DAN KEBUDAYAAN',0,0,'C');
    $pdf->Ln(0.5);
    $pdf->Cell(21,0.8,'YAYASAN AL-ISLAM INDRAMAYU',0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',14);
    $pdf->Cell(21,0.8,'SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
    $pdf->Cell(21,0.8,'Alamat Jl. Raya Gabuswetan No. 1 Gabuswetan Indramayu Telp. (0234)2505005 Kodepos 45263',0,0,'C');
	$pdf->Ln(0.35);
    $pdf->Cell(21,0.8,'E-mail: sdi.aljannah@gmail.com Laman: https://sdi-aljannah.web.id',0,0,'C');
    $pdf->Ln(0.5);
	$pdf->SetLineWidth(0.09);
	$pdf->Line(1,4.2,20,4.2);
	$pdf->SetLineWidth(0);
	$pdf->Line(1,4.3,20,4.3);
	$pdf->Ln(0.5);
   $pdf->Ln(0.7);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(0,0,'KEPUTUSAN',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'KEPALA SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->SetFont('Times','B','12');
   if($smt=='1'){
   $jsm='GANJIL';
   $pdf->Cell(0,0,'Nomor: 421.2/040-SDI/VII/'.$tpl1,0,0,'C');
   }else{
	   $jsm='GENAP';
	   $pdf->Cell(0,0,'Nomor: 421.2/040-SDI/I/'.$tpl2,0,0,'C');
   };
   $pdf->Ln(0.7);
   $pdf->Cell(0,0,'TENTANG',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'PEMBAGIAN TUGAS MENGAJAR DAN TUGAS TAMBAHAN GURU',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'SEMESTER '.$smt.' ('.$jsm.') TAHUN PELAJARAN '.$tapel,0,0,'C');
   $pdf->Ln(0.9);
   $pdf->SetFont('Times','','12');
   $pdf->MultiCell(19,0.7,'Kepala SD Islam Al-Jannah, Dinas Pendidikan Kabupaten Indramayu, Propinsi Jawa Barat,',0,'J',0); 
   $pdf->Ln(0.1);
   //$pdf->Cell(0.5,0.5,'1.',0,0,'L');
   $pdf->Cell(3,0.5,'Menimbang',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(0.5,0.5,'a. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'Bahwa proses belajar mengajar merupakan inti proses penyelenggaraan pendidikan pada satuan pendidikan.',0,'J',0); 
   $pdf->Cell(3,0.5,'',0,0,'L');
   $pdf->Cell(0.4,0.5,'',0,0,'L');
   $pdf->Cell(0.5,0.5,'b. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'Bahwa untuk menjamin kelancaran proses belajar mengajar perlu ditetapkan pembagian tugas mengajar dan tugas tambahan bagi guru.',0,'J',0); 
   $pdf->Ln(0.5);
   $pdf->Cell(3,0.5,'Mengingat',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Cell(0.5,0.5,'a. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'UU Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional.',0,'J',0); 
   $pdf->Cell(3,0.5,'',0,0,'L');
   $pdf->Cell(0.4,0.5,'',0,0,'L');
   $pdf->Cell(0.5,0.5,'b. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'UU Nomor 14 tahun 2005 tentang Guru dan Dosen sebagai tenaga Profesional.',0,'J',0); 
   $pdf->Cell(3,0.5,'',0,0,'L');
   $pdf->Cell(0.4,0.5,'',0,0,'L');
   $pdf->Cell(0.5,0.5,'c. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'Peraturan Pemerintah nomor 13 tahun 2015 tentang perubahan kedua Standar Nasional Pendidikan.',0,'J',0);
   $pdf->Cell(3,0.5,'',0,0,'L');
   $pdf->Cell(0.4,0.5,'',0,0,'L');
   $pdf->Cell(0.5,0.5,'d. ',0,0,'L');
   $pdf->MultiCell(15,0.5,'Permenpan No 16 tahun 2009 tentang Angka Kredit Jabatan Guru.',0,'J',0);
   $pdf->Ln(0.7);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(0,0,'MEMUTUSKAN',0,0,'C');
   $pdf->Ln(0.7);
   
   $pdf->SetFont('Times','','12');
   $pdf->Cell(3,0.5,'Menetapkan',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->Ln(0.7);
   
   $pdf->Cell(3,0.5,'PERTAMA',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(15.5,0.5,'Pembagian Tugas Mengajar dan Tugas Tambahan pada Guru SD Islam Al-Jannah pada Semester '.$smt.' ('.$jsm.') Tahun Pelajaran '.$tapel.' meliputi pembagian tugas mengajar oleh setiap guru bidang studi dalam melaksanakan kewajiban mengajar dan tugas tambahan lainnya.',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(3,0.5,'KEDUA',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(15.5,0.5,'Pembagian Tugas Mengajar dan Beban Kerja bagi setiap Guru tersebut tertuang dalam daftar terlampir dalam surat keputusan ini.',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(3,0.5,'KETIGA',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(15.5,0.5,'Apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini, maka akan diadakan perbaikan sebagaimana mestinya.',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(3,0.5,'KEEMPAT',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(15.5,0.5,'Keputusan ini berlaku sejak tanggal ditetapkan.',0,'J',0);
   $pdf->Ln(0.7);
   $pdf->Cell(12,0.5,'',0,0,'L');
   $pdf->Cell(3,0.5,'Ditetapkan di',0,0,'L');
   $pdf->Cell(0.5,0.5,':',0,0,'L');
   $pdf->Cell(3,0.5,'Gabuswetan',0,0,'L');
   $pdf->Ln(0.5);
   $pdf->Cell(12,0.5,'',0,0,'L');
   $pdf->Cell(3,0.5,'Pada Tanggal','B',0,'L');
   $pdf->Cell(0.5,0.5,':','B',0,'L');
   $pdf->Cell(3,0.5,'8 Januari 2024','B',0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(13,0.5,'',0,0,'L');
   $pdf->Cell(4,0.5,'Kepala Sekolah',0,0,'C');
   $pdf->Ln(0.1);
   $pdf->MultiCell(13.5,0.5,'Tembusan :',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'1. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Ketua Yayasan Al-Islam Indramayu',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'2. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Yang bersangkutan',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'3. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Arsip',0,'J',0);
   //$pdf->Cell(13,0.5,'Tembusan :',0,0,'L');
   $pdf->Ln(0.2);
   $pdf->Cell(13);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(4,0.5,'UMAR ALI, S.Pd.',0,0,'C');
   
   //halaman 2
   $pdf->AddPage();
   $pdf->SetFont('Times','B','9');
   $pdf->Cell(2,0.5,'Lampiran',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(14,0.5,'Pembagian Tugas Mengajar dan Tugas Tambahan Guru Semester 1 Tahun Pelajaran '.$tapel,0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(2,0.5,'Nomor',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   if($smt=='1'){
   $pdf->MultiCell(11,0.5,'Nomor: 421.2/040-SDI/VII/'.$tpl1,0,'J',0);
   }else{
   $pdf->MultiCell(11,0.5,'Nomor: 421.2/040-SDI/I/'.$tpl2,0,'J',0);
   }
   $pdf->Ln(0.1);
   $pdf->Cell(2,0.5,'Tanggal',0,0,'L');
   $pdf->Cell(0.4,0.5,':',0,0,'L');
   $pdf->MultiCell(11,0.5,'8 Januari 2024',0,'J',0);
   $pdf->Ln(1);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(0,0,'PEMBAGIAN TUGAS MENGAJAR DAN TUGAS TAMBAHAN GURU',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'SEKOLAH DASAR ISLAM AL-JANNAH',0,0,'C');
   $pdf->Ln(0.5);
   $pdf->Cell(0,0,'SEMESTER '.$smt.' ('.$jsm.') TAHUN PELAJARAN '.$tapel,0,0,'C');
   $pdf->Ln(0.9);
   $pdf->SetFont('Times','','10');
   $pdf->Cell(1,1,'NO',1,0,'C');
   //$pdf->MultiCell(4,1,'NAMA GURU',1,'C',0);
   //$pdf->MultiCell(4,1,'TUGAS MENGAJAR',1,'C',0);
   //$pdf->MultiCell(4,1,'TUGAS TAMBAHAN',1,'C',0);
   $pdf->Cell(6,1,'NAMA GURU',1,0,'C');
   $pdf->Cell(3,1,'JENIS PTK',1,0,'C');
   $pdf->Cell(4,1,'TUGAS TAMBAHAN',1,0,'C');
   //$jrom=$connect->query("select * from rombel where tapel='$tapel_aktif' and smt='$smt_aktif'")->num_rows;
   $pdf->Cell(3,1,'MENGAJAR DI',1,0,'C');
   $pdf->Cell(2,1,'JJM',1,0,'C');
   $pdf->Ln();
   $pdf->Cell(1,1,'1.',1,0,'C');
   $pdf->Cell(6,1,'UMAR ALI, S.Pd.',1,0,'L');
   $pdf->Cell(3,1,'-',1,0,'C');
   $pdf->Cell(4,1,'KEPALA SEKOLAH',1,0,'C');
   $pdf->Cell(3,1,'-',1,0,'C');
   $pdf->Cell(2,1,'18 JP',1,0,'C');
   $pdf->Ln();
   $ekstra = "select * from rombel where tapel='$tapel' and smt='$smt'";
   $queryed = $connect->query($ekstra);
   $nom=2;
   while ($rowed = $queryed->fetch_assoc()) {
	   $idptk=$rowed['wali_kelas'];
	   $namag=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
	   $idjnsptk=$namag['jenis_ptk_id'];
	   $jnsptk=$connect->query("select * from jenis_ptk where jenis_ptk_id='$idjnsptk'")->fetch_assoc();
	   $pdf->Cell(1,1,$nom.'.',1,0,'C');
	   $pdf->Cell(6,1,$namag['nama'],1,0,'L');
	   $pdf->Cell(3,1,$jnsptk['jenis_ptk'],1,0,'C');
	   $pdf->Cell(4,1,'-',1,0,'C');
	   $pdf->Cell(3,1,'Kelas '.$rowed['nama_rombel'],1,0,'C');
	   $pdf->Cell(2,1,'24 JP',1,0,'C');
	   $pdf->Ln();
	   $nom++;
   };
   $ekstra = "select * from rombel where tapel='$tapel' and smt='$smt'";
   $queryed = $connect->query($ekstra);
   while ($rowed = $queryed->fetch_assoc()) {
	   $idptk=$rowed['pendamping'];
	   $namag=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
	   $idjnsptk=$namag['jenis_ptk_id'];
	   $jnsptk=$connect->query("select * from jenis_ptk where jenis_ptk_id='$idjnsptk'")->fetch_assoc();
	   $pdf->Cell(1,1,$nom.'.',1,0,'C');
	   $pdf->Cell(6,1,$namag['nama'],1,0,'L');
	   $pdf->Cell(3,1,$jnsptk['jenis_ptk'],1,0,'C');
	   $pdf->Cell(4,1,'-',1,0,'C');
	   $pdf->Cell(3,1,'Kelas '.$rowed['nama_rombel'],1,0,'C');
	   $pdf->Cell(2,1,'24 JP',1,0,'C');
	   $pdf->Ln();
	   $nom++;
   };
   $pdf->Ln(0.7);
   $pdf->SetFont('Times','','12');
   $pdf->Cell(12,0.5,'',0,0,'L');
   $pdf->Cell(3,0.5,'Ditetapkan di',0,0,'L');
   $pdf->Cell(0.5,0.5,':',0,0,'L');
   $pdf->Cell(3,0.5,'Gabuswetan',0,0,'L');
   $pdf->Ln(0.5);
   $pdf->Cell(12,0.5,'',0,0,'L');
   $pdf->Cell(3,0.5,'Pada Tanggal','B',0,'L');
   $pdf->Cell(0.5,0.5,':','B',0,'L');
   $pdf->Cell(3,0.5,'8 Januari 2024','B',0,'L');
   $pdf->Ln(0.7);
   $pdf->Cell(13,0.5,'',0,0,'L');
   $pdf->Cell(4,0.5,'Kepala Sekolah',0,0,'C');
   $pdf->Ln(0.1);
   $pdf->MultiCell(13.5,0.5,'Tembusan :',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'1. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Ketua Yayasan Al-Islam Indramayu',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'2. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Yang bersangkutan',0,'J',0);
   $pdf->Ln(0.1);
   $pdf->Cell(0.5,0.5,'3. ',0,0,'L');
   $pdf->MultiCell(11,0.5,'Arsip',0,'J',0);
   //$pdf->Cell(13,0.5,'Tembusan :',0,0,'L');
   $pdf->Ln(0.2);
   $pdf->Cell(13);
   $pdf->SetFont('Times','B','12');
   $pdf->Cell(4,0.5,'UMAR ALI, S.Pd.',0,0,'C');
   
   
   
   //tambahan
   $pdf->SetTitle("Surat Keterangan Kelakuan Baik");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");

   $pdf->Output();
}
 ?>
