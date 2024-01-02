<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../function/db_connect.php';
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

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
};
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
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
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
    
};
$pdid=$_GET['pdid'];
$tapel=$_GET['tapel'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$pdid'")->fetch_assoc();
$kelas=$connect->query("select * from penempatan where peserta_didik_id='$pdid' and tapel='$tapel'")->fetch_assoc();
$jprinter=$connect->query("select * from printer where status='1'")->fetch_assoc();
$nomor=$siswa['nis'].".png";
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bln = array("Juli", "Agustus", "September", "Oktober", "November", "Desember", "Januari", "Februari", "Maret", "April", "Mei", "Juni");
		$pdf=new exFPDF('P','mm',array(110,165));
		//Halaman 1
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);
		$table2=new easyTable($pdf, '{110}');
		$table2->easyCell('','img:logo.jpg,w30;align:C;valign:M');
		$table2->printRow();
		$table2->easyCell('SEKOLAH DASAR ISLAM AL-JANNAH','font-size:12;font-style:B;align:C;');
		$table2->printRow();
		$table2->rowStyle('min-height:3');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','font-size:7;align:C;');
		$table2->printRow();
		$table2->rowStyle('min-height:3');
		$table2->easyCell('Indramayu Jabar 45263 Telp/Fax. (0234) 5508501','font-size:7;align:C;');
		$table2->printRow();
		$table2->rowStyle('min-height:3');
		$table2->easyCell('Website: https://sdi-aljannah.web.id email: sdi.aljannah@gmail.com','font-size:7;align:C;');
		$table2->printRow();
		$table2->easyCell('','img:../modul/qrcode/temp/'.$nomor.',w30;align:C;valign:M');
		$table2->printRow();
		$table2->rowStyle('min-height:10');
		$table2->easyCell($siswa['nama'],'font-size:12;font-style:B;align:C;valign:M;border:1');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{50,10,50}');
		$table2->rowStyle('min-height:10');
		$table2->easyCell('Kelas '.$kelas['rombel'],'font-size:12;font-style:B;align:C;valign:M;border:1');
		$table2->easyCell('','font-size:12;font-style:B;align:C;valign:M');
		$table2->easyCell($siswa['nis'],'font-size:12;font-style:B;align:C;valign:M;border:1');
		$table2->printRow();
		$table2->endTable(10);
		
		$table2=new easyTable($pdf, '{110}');
		$table2->easyCell('KARTU INFAQ BULANAN','font-size:14;font-style:B;align:C;');
		$table2->printRow();
		$table2->easyCell('TAHUN PELAJARAN '.$tapel,'font-size:14;font-style:B;align:C;');
		$table2->printRow();
		$table2->endTable();
		
		$pdf->Output('F','cetak-spp-depan.pdf');
		//$pdf->Output('D',$namafilenya);
		
?>