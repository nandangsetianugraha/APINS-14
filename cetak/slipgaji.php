<?php
 include 'fpdf/fpdf.php';
 include 'exfpdf.php';
 include 'easyTable.php';
 include '../config/db_connect.php';
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

	$bln=$_GET['bln'];
	$thn=$_GET['thn'];
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$namafilenya="Slip Gaji ".$bulan[(int)$bln]." ".$thn.".pdf";
		$pdf=new exFPDF('P','mm',array(215,330));
		$cek=$connect->query("select * from id_pegawai order by pegawai_id asc");
		while($sis=$cek->fetch_assoc()){
			$idpeg=$sis['pegawai_id'];
		$pdf->AddPage(); 
		$pdf->SetFont('helvetica','',10);

		$table2=new easyTable($pdf, '{150,65}');
		$table2->rowStyle('font-size:14');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B');
		$table2->rowStyle('font-size:10');
		$table2->easyCell('BUKTI PEMBAYARAN GAJI BULAN : '.$bulan[(int)$bln].' '.$thn,'rowspan:2;valign:M;align:C;font-style:B;border:1');
		$table2->printRow();
		$table2->rowStyle('font-size:8');
		$table2->easyCell('Jl. Raya Gabuswetan No. 1 Desa Gabuswetan Kec. Gabuswetan Kab. Indramayu - Jawa Barat 45263 Telp. (0234) 5508501 Website: http://sdi-aljannah.web.id Email: sdi.aljannah@gmail.com','align:L;');
		$table2->printRow();
		$table2->endTable();
		
		$hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
		$jjm=0;
		$jhari=0;
		$jhadir=0;
		for ($i=1; $i < $hari+1; $i++) { 
				if($i>9){
					$ab=$i;
				}else{
					$ab="0".$i;
				};
				$ttt=$thn."-".$bln."-".$ab;
				if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
					
				}else{
					$jhari=$jhari+1;
					$hadir=$connect->query("select * from absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d')='$ttt'")->num_rows;
					if($hadir>0){
						$jhadir=$jhadir+1;
					}else{
						$jhadir=$jhadir;
						if(namahari($ttt)==="Jumat"){
							$jjm=$jjm+1;
						};
					};
				};
			};
		
		$table2=new easyTable($pdf, '{33,5,33,33,5,33,25,5,50}');
		$table2->easyCell('Pegawai ID','align:L;font-style:B;border:T');
		$table2->easyCell(':','align:L;font-style:B;border:T');
		$table2->easyCell($sis['pegawai_id'],'align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('','align:L;font-style:B;border:T');
		$table2->easyCell('Sekolah','align:L;font-style:B;border:T');
		$table2->easyCell(':','align:L;font-style:B;border:T');
		$table2->easyCell('SD ISLAM AL-JANNAH','align:L;font-style:B;border:T');
		$table2->printRow();
		
		$ptk=$connect->query("select * from id_pegawai where pegawai_id='$idpeg'")->fetch_assoc();
		$idptk=$ptk['ptk_id'];
		$nptk=$connect->query("select * from ptk where ptk_id='$idptk'")->fetch_assoc();
		$jnsptk=$nptk['jenis_ptk_id'];
		$jptk=$connect->query("select * from jenis_ptk where jenis_ptk_id='$jnsptk'")->fetch_assoc();
		$table2->easyCell('Nama','align:L;font-style:B');
		$table2->easyCell(':','align:L;font-style:B');
		$table2->easyCell($nptk['nama'],'colspan:4;align:L;font-style:B');
		$table2->easyCell('Jabatan','align:L;font-style:B');
		$table2->easyCell(':','align:L;font-style:B');
		$table2->easyCell($jptk['jenis_ptk'],'align:L;font-style:B');
		$table2->printRow();
		
		$table2->easyCell('RINCIAN GAJI','colspan:3;align:L;font-style:B;border:T');
		$table2->easyCell('POTONGAN','colspan:3;align:L;font-style:B;border:T');
		$table2->easyCell('KEHADIRAN','colspan:3;align:L;font-style:B;border:T');
		$table2->printRow();
		
		$gp=$connect->query("select * from gajipokok where pegawai_id='$idpeg'")->fetch_assoc();
		$po=$connect->query("select * from potongan_gaji where pegawai_id='$idpeg' and bulan='$bln' and tahun='$thn'")->fetch_assoc();
		$ada=$connect->query("select * from potongan_gaji where pegawai_id='$idpeg' and bulan='$bln' and tahun='$thn'")->num_rows;
		if($ada>0){
			$jhadir=0;
			$jhari=0;
			$jjum=0;
			$jijin=0;$jsakit=0;
			for ($i=1; $i < $hari+1; $i++) { 
				if($i>9){
					$ab=$i;
				}else{
					$ab="0".$i;
				};
				$ttt=$po['tahun']."-".$po['bulan']."-".$ab;
				if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
					
				}else{
					$jhari=$jhari+1;
					$hadir=$connect->query("select * from absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d')='$ttt'")->num_rows;
					if($hadir>0){
						$jhadir=$jhadir+1;
					}else{
						$adaijin=$connect->query("select * from ijin_ptk where pegawai_id='$idpeg' and tanggal='$ttt'")->num_rows;
						if($adaijin>0){
							$ijin=$connect->query("select * from ijin_ptk where pegawai_id='$idpeg' and tanggal='$ttt'")->fetch_assoc();
							if($ijin['status']==="I"){
								$jijin=$jijin+1;
							};
							if($ijin['status']==="S"){
								$jsakit=$jsakit+1;
							};
						}else{
							if(namahari($ttt)==="Jumat"){
								$jjum=$jjum+1;
							};
						}
					};
				};
			};
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Gaji Pokok','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($gp['insentif']*9*20,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Datang Telat','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format(round(($po['telat']/60)*$gp['insentif']),0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Hari Kerja','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell($po['hari'].' Hari','align:R;font-style:B;border:T');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Transport','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['transport'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Cepat Pulang','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format(round(($po['cepat']/60)*$gp['insentif']),0,",","."),'align:R;font-style:B');
			$table2->easyCell('Kehadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['hari']-$po['absen'].' Hari','align:R;font-style:B');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Tunj. Jabatan','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_walikelas'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Absen','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format(round($po['absen']*9*$gp['insentif']),0,",","."),'align:R;font-style:B');
			$table2->easyCell('Absensi','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['absen'].' Hari','align:R;font-style:B');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$totalgaji=$gp['insentif']*9*20+$gp['transport']+$gp['tunj_walikelas']+$gp['tunj_kepsek']+$gp['tunj_kehadiran']+$gp['tunj_ekskul'];
			if($po['absen']==0){
				$takhadir=0;
			}else{
				$takhadir=$gp['tunj_kehadiran'];
			};
			$totalpotong=round(($po['telat']/60)*$gp['insentif'])+round(($po['cepat']/60)*$gp['insentif'])+round($po['absen']*9*$gp['insentif'])+$takhadir+$po['ekskul']*($gp['tunj_ekskul']/4);
			
			$table2->easyCell('Tunj. Lain','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_kepsek'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Ketidakhadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($takhadir,0,",","."),'align:R;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Kehadiran','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_kehadiran'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('Ekskul','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($po['ekskul']*($gp['tunj_ekskul']/4),0,",","."),'align:R;font-style:B');
			$table2->easyCell('Late','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['telat'].' menit','align:R;font-style:B');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Ekstrakurikuler','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell('Rp. '.number_format($gp['tunj_ekskul'],0,",","."),'align:R;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('Early','align:L;font-style:B');
			$table2->easyCell(':','align:L;font-style:B');
			$table2->easyCell($po['cepat'].' menit','align:R;font-style:B');
			$table2->printRow();
			
			$table2->rowStyle('font-size:10');
			$table2->easyCell('Total Gaji','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalgaji,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('Total Potongan','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalpotong,0,",","."),'align:R;font-style:B;border:T');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			
			$table2->easyCell('Gaji Bersih','align:L;font-style:B;border:T');
			$table2->easyCell(':','align:L;font-style:B;border:T');
			$table2->easyCell('Rp. '.number_format($totalgaji-$totalpotong,0,",","."),'colspan:4;align:R;font-style:B;border:T');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
		}else{
			$table2->easyCell('Belum Ada Gaji Bulan '.$bulan[(int)$bln].' '.$thn,'colspan:9;align:C;font-style:B;border:TB');
			$table2->printRow();
		}
		$table2->endTable(2);
		
		//Tanda Tangan
		$table2=new easyTable($pdf, '{33,5,33,33,5,33,25,5,50}');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('Kepala Sekolah','align:C;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:6');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->rowStyle('font-size:8');
			$table2->easyCell('','colspan:8;align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->printRow();
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('','align:L;font-style:B');
			$table2->easyCell('UMAR ALI, S.Pd.','align:C;font-style:B;border:B');
			$table2->printRow();
		$table2->endTable();
		};
		
		
		
			$pdf->Output();
			//$pdf->Output('D',$namafilenya);
		 


 

?>