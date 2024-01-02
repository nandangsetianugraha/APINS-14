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
$kelas=$_GET['kelas'];
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
		$table2->easyCell('SAMPAI DENGAN '.$bln[$bulan-1],'align:C');
		$table2->printRow();
		$table2->endTable();
		
		if($kelas==0){
			$sql1="select * from rombel where tapel='$tapel' order by nama_rombel asc";
			$query1 = $connect->query($sql1);
			while($m=$query1->fetch_assoc()) {
				$idromb=$m['nama_rombel'];
				
				$table2=new easyTable($pdf, '{60,5,150}', 'align:L');
				$table2->easyCell('Kelas','align:L');
				$table2->easyCell(':','align:L');
				$table2->easyCell($idromb,'align:L');
				$table2->printRow();
				$table2->endTable();
				
				$table2=new easyTable($pdf, '{80,45,45,45}', 'align:L');
				$table2->easyCell('Nama Pembayaran','align:L;border:BT');
				$table2->easyCell('Total','align:C;border:BT');
				$table2->easyCell('Sudah dibayar','align:C;border:BT');
				$table2->easyCell('Sisa','align:C;border:BT');
				$table2->printRow(true);
				
				$jtot=0;
				$jbayar=0;
				$jsisa=0;
				$sql2="select * from jenis_tunggakan";
				$query2 = $connect->query($sql2);
				while($n=$query2->fetch_assoc()) {
					$idtung = $n['id_tunggakan'];
					if($jenis==0){
						if($idtung==1){
							$jumlahtunggakan=$connect->query("select sum(tarif) as jumlahspp from penempatan left join tarif_spp on penempatan.peserta_didik_id=tarif_spp.peserta_didik_id where penempatan.rombel='$idromb' and penempatan.tapel='$tapel'")->fetch_assoc();
							$totaltunggakan=$jumlahtunggakan['jumlahspp']*$bulan;
						}else{
							$jumlahtunggakan=$connect->query("select sum(tarif) as jumlahspp from penempatan left join tunggakan_lain on penempatan.peserta_didik_id=tunggakan_lain.peserta_didik_id where penempatan.rombel='$idromb' and penempatan.tapel='$tapel' and tunggakan_lain.tapel='$tapel' and tunggakan_lain.jenis='$idtung'")->fetch_assoc();
							$totaltunggakan=$jumlahtunggakan['jumlahspp'];
						};
						$sql5="select sum(bayar) as dibayar from penempatan left join pembayaran on penempatan.peserta_didik_id=pembayaran.peserta_didik_id where penempatan.rombel='$idromb' and penempatan.tapel='$tapel' and pembayaran.tapel='$tapel' and pembayaran.jenis='$idtung'";
						$query5= $connect->query($sql5);
						$jumlahbayar=$query5->fetch_assoc();
						$jtot=$jtot+$totaltunggakan;
						$jbayar=$jbayar+$jumlahbayar['dibayar'];
						$jsisa=$jsisa+($jtot-$jbayar);
						if($totaltunggakan==0){}else{
						$table2->easyCell($n['nama_tunggakan'],'align:L;');
						$table2->easyCell(rupiah($totaltunggakan),'align:R;');
						$table2->easyCell(rupiah($jumlahbayar['dibayar']),'align:R;');
						$table2->easyCell(rupiah($totaltunggakan-$jumlahbayar['dibayar']),'align:R;');
						$table2->printRow();
						}
					}
				}
				$table2->easyCell('JUMLAH','align:C;border:BT');
				$table2->easyCell(rupiah($jtot),'align:R;border:BT');
				$table2->easyCell(rupiah($jbayar),'align:R;border:BT');
				$table2->easyCell(rupiah($jtot-$jbayar),'align:R;border:BT');
				$table2->printRow();
				$table2->endTable(4);
			}
		}else{
		}
		
		
	
		
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>