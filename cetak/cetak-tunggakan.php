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

	$tapel=$_GET['tapel'];
$siswa=$_GET['siswa'];
$bulan=(int) $_GET['bulan'];
$jenis=$_GET['jenis'];
$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
$bln = array("Juli", "Agustus", "September", "Oktober", "November", "Desember", "Januari", "Februari", "Maret", "April", "Mei", "Juni");
		$pdf=new exFPDF('P','mm',array(215,330));
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, '{30,185}');
		$table2->easyCell('','img:logo.jpg,w20;rowspan:4;align:C;border:B');
		$table2->easyCell('SD ISLAM AL-JANNAH','font-size:14;align:L;');
		$table2->printRow();
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan','align:L');
		$table2->printRow();
		$table2->easyCell('Kab. Indramayu - Jawa Barat 45263 Telp. (0234) 5508501','align:L');
		$table2->printRow();
		$table2->easyCell('Website: https://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com','align:L;border:B');
		$table2->printRow();
		$table2->endTable();
		
		$table2=new easyTable($pdf, '{215}', 'align:C');
		$table2->easyCell('LAPORAN KEWAJIBAN ADMINISTRASI SISWA','align:C');
		$table2->printRow();
		$table2->easyCell('SAMPAI DENGAN '.$bln[$bulan-1].' TAHUN '.$thn,'align:C');
		$table2->printRow();
		$table2->endTable();
		
		$namasiswa=$connect->query("select * from siswa where peserta_didik_id='$siswa'")->fetch_assoc();
		$namakelas=$connect->query("select * from penempatan where peserta_didik_id='$siswa' and tapel='$tapel'")->fetch_assoc();
		$table2=new easyTable($pdf, '{60,5,150}', 'align:L');
		$table2->easyCell('Nama Siswa','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell($namasiswa['nama'],'align:L');
		$table2->printRow();
		$table2->easyCell('Kelas','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell($namakelas['rombel'],'align:L');
		$table2->printRow();
		
		$table2->easyCell('Tahun Pelajaran','align:L');
		$table2->easyCell(':','align:L');
		$table2->easyCell($tapel,'align:L');
		$table2->printRow();
		$table2->endTable();
		
		$jumlah=0;
		$sisa=0;
		$nomor=0;
		$bayarnya=0;
		$table2=new easyTable($pdf, '{80,30,35,35,35}', 'align:L');
		$table2->easyCell('Nama Pembayaran','align:L;border:BT');
		$table2->easyCell('Bulan','align:L;border:BT');
		$table2->easyCell('Tarif/Biaya','align:C;border:BT');
		$table2->easyCell('Pembayaran','align:C;border:BT');
		$table2->easyCell('Sisa','align:C;border:BT');
		$table2->printRow();
		
		$spp=$connect->query("select * from tarif_spp where peserta_didik_id='$siswa'")->fetch_assoc();
		for($i = 1; $i < $bulan+1; $i++){
			$sppbln=$connect->query("select * from pembayaran where peserta_didik_id='$siswa' and tapel='$tapel' and jenis='1' and bulan='$i'")->num_rows;
			if($sppbln>0){
			}else{
				$blnspp=$connect->query("select * from bulan_spp where id_bulan='$i'")->fetch_assoc();
				$jumlah=$jumlah+$spp['tarif'];
				$sisa=$sisa+$spp['tarif'];
				$nomor=$nomor+1;
				$table2->easyCell('SPP Tahun '.$tapel,'align:L;');
				$table2->easyCell($blnspp['bulan'],'align:L;');
				$table2->easyCell(rupiah($spp['tarif']),'align:R;');
				$table2->easyCell('-','align:R;');
				$table2->easyCell(rupiah($spp['tarif']),'align:R;');
				$table2->printRow();
			}
		}
		$sql11="select * from jenis_tunggakan where id_tunggakan > 1";
		$query11 = $connect->query($sql11);
		while($h=$query11->fetch_assoc()) {
			$idt=$h['id_tunggakan'];
			$cek=$connect->query("select * from pembayaran where peserta_didik_id='$siswa' and tapel='$tapel' and jenis='$idt'")->num_rows;
			$tarifnya=$connect->query("select * from tunggakan_lain where peserta_didik_id='$siswa' and tapel='$tapel' and jenis='$idt'")->fetch_assoc();
			if($tarifnya['tarif']==0){}else{
			if($cek>0){
				$bayar=$connect->query("select sum(bayar) as sudahbayar from pembayaran where peserta_didik_id='$siswa' and tapel='$tapel' and jenis='$idt'")->fetch_assoc();
				$sudah=$bayar['sudahbayar'];
				if($sudah==$tarifnya['tarif']){
				}else{
					$sisanya=$tarifnya['tarif']-$sudah;
					$jumlah=$jumlah+$tarifnya['tarif'];
					$sisa=$sisa+$sisanya;
					$bayarnya=$bayarnya+$sudah;
					$nomor=$nomor+1;
					$table2->easyCell($h['nama_tunggakan'].' Tahun '.$tapel,'align:L;');
					$table2->easyCell('','align:L;');
					$table2->easyCell(rupiah($tarifnya['tarif']),'align:R;');
					$table2->easyCell(rupiah($sudah),'align:R;');
					$table2->easyCell(rupiah($sisanya),'align:R;');
					$table2->printRow();
				}
			}else{
				$jumlah=$jumlah+$tarifnya['tarif'];
				$sisa=$sisa+$tarifnya['tarif'];
				$nomor=$nomor+1;
				$table2->easyCell($h['nama_tunggakan'].' Tahun '.$tapel,'align:L;');
				$table2->easyCell('','align:L;');
				$table2->easyCell(rupiah($tarifnya['tarif']),'align:R;');
				$table2->easyCell('-','align:R;');
				$table2->easyCell(rupiah($tarifnya['tarif']),'align:R;');
				$table2->printRow();
			}
			}
		};
		if($sisa==0){
			$table2->easyCell('Tidak ada Tunggakan','colspan:5;align:C;');
			$table2->printRow();
		}else{
			$table2->easyCell('JUMLAH','colspan:2;align:C;border:BT');
			$table2->easyCell(rupiah($jumlah),'align:R;border:BT');
			$table2->easyCell(rupiah($bayarnya),'align:R;border:BT');
			$table2->easyCell(rupiah($sisa),'align:R;border:BT');
			$table2->printRow();
		}
		
		$table2->endTable();
		
	
		
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>