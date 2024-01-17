<?php
require_once('fpdf/fpdf.php');
require_once('../config/db_connect.php');

class PDF extends FPDF{
  
  function Header(){
    global $connect;
	$ids=$_GET['id'];
	$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
	//$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
	$tanggal=$Ls['tanggal'];
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
    function namaBulan($x) {
    $bulan = "";
    switch ($x) {
        case 1  : $bulan = "Januari";
           break;
        case 2  : $bulan = "Februari";
           break;
        case 3  : $bulan = "Maret";
           break;
        case 4  : $bulan = "April";
           break;
        case 5  : $bulan = "Mei";
           break;
        case 6  : $bulan = "Juni";
           break;
        case 7  : $bulan = "Juli";
           break;
        case 8  : $bulan = "Agustus";
           break;
        case 9  : $bulan = "September";
           break;
        case 10 : $bulan = "Oktober";
           break;
        case 11 : $bulan = "November";
           break;
        case 12 : $bulan = "Desember";
           break;
    }
    return $bulan;
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
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
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


      

    $this->SetFont('Arial','B',12);
    $this->Ln(0);
    $this->Cell(16,0.5, $this->Image('../assets/'.$cfg['image_login'], $this->GetX(), $this->GetY(),1.7,1.7,0,0), 0, 0, 'L', false );
    $this->Cell(0.3,0.5,'',0,0,'L',0);
    //$this->Cell(1.4,0.5, $this->Image($gambar2, $this->GetX(), $this->GetY(),2.2,1.7,0,0),0, 0, 'R', false );
    $this->Ln(0);
    $smt=$Ls['smt'];
  if($smt==1){
    $smts="Ganjil";
  }else{
    $smts="Genap";
  };
    $this->Cell(18,0.8,'BERITA ACARA PELAKSANAAN',0,0,'C');
    $this->Ln(0.5);
    $this->Cell(18,0.8,strtoupper($Ls['jenis'].' '.$smts),0,0,'C');
    $this->Ln(0.5);
    $this->Cell(18,0.8,'TAHUN PELAJARAN '.$Ls['tapel'],0,0,'C');
    $this->Ln(1.5);
    $this->SetFont('Arial','',10);
    $this->MultiCell(18,0.5,'Pada hari ini '.namahari($tanggal).' tanggal '.penyebut($tgl).' bulan '.namaBulan($bln).' tahun '.penyebut($thn).', di '.$cfg['nama_sekolah'].' telah diselenggarakan '.$Ls['jenis'].' '.$smts.' Tahun Ajaran '.$Ls['tapel'].', untuk Mata Pelajaran '.$Ls['mapel'].' dari pukul '.$Ls['mulai'].' sampai dengan pukul '.$Ls['selesai'],0,'J',0);
    $this->Ln(0);
    $this->Cell(0.5,0.5,'1.',0,0,'L');
    $this->Cell(5,0.5,'Sekolah/Madrasah',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,strtoupper($cfg['nama_sekolah']),'B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(5,0.5,'Ruang/Kelas',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,$Ls['kelas'].' / '.$Ls['kelas'],'B',0,'L');
	$romb=$Ls['kelas'];
	$tpl=$Ls['tapel'];
    $smt=$Ls['smt'];
    $jumlahpeserta=$connect->query("select * from penempatan where rombel='$romb' and tapel='$tpl' and smt='$smt'")->num_rows;
	$nHadir=$jumlahpeserta-$Ls['absen'];
	$this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(5,0.5,'Jumlah Peserta Seharusnya',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,$jumlahpeserta,'B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(5,0.5,'Jumlah Hadir (Ikut Ujian)',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,'','B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(5,0.5,'Jumlah Tidak Hadir',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,'','B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(5,0.5,'No Peserta Tidak Hadir',0,0,'L');
    $this->Cell(0.2,0.5,':',0,0,'L');
    $this->Cell(12.5,0.5,'','B',0,'L');
    $this->Ln(1);
    $this->Cell(0.5,0.5,'2.',0,0,'L');
    $this->Cell(19,0.5,'Catatan Selama '.$Ls['jenis'].' :',0,0,'L');
    $this->Ln(0.7);
    $this->Cell(0.7,0.5,'',0,0,'L');
    $this->MultiCell(17.5,0.5,' 
    
    
    
    ',1,'L',0);
    $this->Ln(0.5);
    $this->Cell(12,0.5,'Yang membuat berita acara :',0,0,'L');
    $this->SetFont('Arial','B',10);
    $this->Cell(8,2,'TTD',0,0,'L');
    $this->SetFont('Arial','',10);
    $this->Ln(1.7);
    $this->Cell(0.5,0.5,'1.',0,0,'L');
    $this->Cell(4,0.5,'Pengawas 1',0,0,'L');
    $this->Cell(5.5,0.5,$Ls['pengawas1'],'B',0,'L');
    $this->Cell(0.5,1.5,'',0,0,'L');
    $this->Cell(0.5,1.5,'1.',0,0,'L');
    $this->Cell(5,1,'','B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(4,0.5,'NIP',0,0,'L');
    $this->Cell(5.5,0.5,'-','B',0,'L');
    $this->Ln(0.7);

    $this->Cell(0.5,0.5,'2.',0,0,'L');
    $this->Cell(4,0.5,'Pengawas 2',0,0,'L');
    $this->Cell(5.5,0.5,$Ls['pengawas2'],'B',0,'L');
    $this->Cell(0.5,1.5,'',0,0,'L');
    $this->Cell(0.5,1.5,'2.',0,0,'L');
    $this->Cell(5,1,'','B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(4,0.5,'NIP',0,0,'L');
    $this->Cell(5.5,0.5,'-','B',0,'L');
    $this->Ln(0.7);

    $this->Cell(0.5,0.5,'3.',0,0,'L');
    $this->Cell(4,0.5,'Kepala Sekolah',0,0,'L');
    $this->Cell(5.5,0.5,'UMAR ALI, S.Pd.','B',0,'L');
    $this->Cell(0.5,1.5,'',0,0,'L');
    $this->Cell(0.5,1.5,'3.',0,0,'L');
    $this->Cell(5,1,'','B',0,'L');
    $this->Ln(0.7);
    $this->Cell(0.5,0.5,'',0,0,'L');
    $this->Cell(4,0.5,'NIP',0,0,'L');
    $this->Cell(5.5,0.5,'-','B',0,'L');
    $this->Ln(2);
    $this->SetFont('Arial','B',9);
    $this->Cell(14,0.5,'Catatan',1,0,'L');
    $this->SetFont('Arial','',9);
    $this->Ln(0.5);
    $this->Cell(14,0.5,'- Dibuat rangkap 2 (dua), masing-masing untuk Arsip, Wali Kelas','LR',0,'L');
    $this->Ln(0.5);
    $this->Cell(14,0.5,'- Untuk Catatan diisi apabila ada perbedaan dalam hal jumlah peserta, jumlah soal, dsb.','LRB',0,'L');
  }

  function Footer(){
    global $connect;
	$ids=$_GET['id'];
	$Ls=$connect->query("select * from berita_acara where id_bap='$ids'")->fetch_assoc();
   $this->SetY(-2,5);
   $this->Cell(0,0.7,'Berita Acara Pelaksanaan '.$Ls['jenis'].' - Halaman : '. $this->PageNo(),0,0,'R');
  }
 }

   //$pdf = new PDF('P','cm',array(21.5,33));
   $pdf = new PDF('P','cm','A4');
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->SetFont('Arial','','9');
   $pdf->SetTextColor(0,0,0);
   $pdf->SetTitle("Berita Acara Pelaksanaan ~ APINS");
   $pdf->SetAuthor("APINS");
   $pdf->SetCreator("Nandang");
   $pdf->SetKeywords("APINS");
   $pdf->SetSubject("APINS");

   $pdf->Output();
 ?>
