<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$idptk=$_POST['rowid'];
$bulans=date('m');
$tahuns=date('Y');
$tglsek=date('d');
?>
<thead>
															  <tr>
																<th scope="col">Tanggal</th>
																<th scope="col">Jam Masuk</th>
																<th scope="col">Jam Pulang</th>
																<th scope="col">Terlambat</th>
																<th scope="col">Pulang Cepat</th>
															  </tr>
															</thead>
															<tbody>
																<?php 
																//$idptk = $bioku["ptk_id"];
																$peg = $connect->query("select * from id_pegawai where ptk_id='$idptk'")->fetch_assoc();
																$idpeg=$peg['pegawai_id'];
																$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
																$telat=0;
																$cepul=0;
																for ($i=1; $i < $hari+1; $i++) { 
																	if($i>9){
																		$ab=$i;
																	}else{
																		$ab="0".$i;
																	};
																	$ttt=$tahun."-".$bulan."-".$ab;
                                                                  if($i>$tglsek and $bulans==$bulan){}else{
																	if(namahari($ttt)==="Sabtu" || namahari($ttt)==="Minggu"){
																?>
																
																<?php 
																	}else{
																		$ceklibur=$connect->query("select * from harilibur where '$ttt' between tanggal_awal and tanggal_akhir")->num_rows;
																		if($ceklibur>0){
																			$libur=$connect->query("select * from harilibur where '$ttt' between tanggal_awal and tanggal_akhir")->fetch_assoc();
																?>
																
																<?php 
																		}else{
																			$cekijin=$connect->query("select * from ijin_ptk where '$ttt' between tanggal_awal and tanggal_akhir and pegawai_id='$idpeg'")->num_rows;
																			if($cekijin>0){
																				$ijins=$connect->query("select * from ijin_ptk where '$ttt' between tanggal_awal and tanggal_akhir and pegawai_id='$idpeg'")->fetch_assoc();
																				if($ijins['status']=='I'){
																					$stats='IJIN '.$ijins['keterangan'];
																				};
																				if($ijins['status']=='S'){
																					$stats='SAKIT '.$ijins['keterangan'];
																				};
																				if($ijins['status']=='C'){
																					$stats='CUTI '.$ijins['keterangan'];
																				};
																?>
																<tr>
																	<td><?=namahari($ttt);?>, <?=TanggalIndo($ttt);?></td>
																	<td colspan="4"><?=$stats;?></td>
																</tr>
																<?php 
																			}else{
																			$kerja=$connect->query("select * from shift where '$ttt' between tanggal_awal and tanggal_akhir")->fetch_assoc();
																			$jmasuk=$kerja['masuk'];
																			if(empty($jmasuk)){
																				$jmasuk="07:00:00";
																			};
																			$jkeluar=$kerja['keluar'];
																			if(empty($jkeluar)){
																				$jkeluar="15:45:00";
																			};
																			$sql = "SELECT pegawai_id,
																			  DATE_FORMAT(tanggal,'%Y-%m-%d') tgl,
																			  min(left(RIGHT(tanggal, 8), 5)) jam1,
																			  MAX(left(right(tanggal, 8), 5)) jam2,
																			  if(LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '$jmasuk'))))>0,LEAST(12600,trim(TIME_TO_SEC(TIMEDIFF(min(left(RIGHT(tanggal, 8), 5)), '$jmasuk'))))/60,'') diff1, 
																			  if(LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('$jkeluar', MAX(left(right(tanggal, 8), 5))))))>0,LEAST(14400,trim(TIME_TO_SEC(TIMEDIFF('$jkeluar', MAX(left(right(tanggal, 8), 5))))))/60,'') diff2
																			  FROM absensi_ptk where pegawai_id='$idpeg' and DATE_FORMAT(tanggal,'%Y-%m-%d')='$ttt' group by tgl";
																			$query = $connect->query($sql);
																			$row = $query->fetch_assoc();
																			if($row['jam2']==$row['jam1']){
																				$keluar='';
																				$pulcep='';
																			}else{
																				$keluar=$row['jam2'];
																				$pulcep=$row['diff2'];
																			}
																			$telat=$telat+$row['diff1'];
																			$cepul=$cepul+$row['diff2'];
																?>
																<tr>
																	<td><?=namahari($ttt);?>, <?=TanggalIndo($ttt);?></td>
																	<td><?=$row['jam1'];?></td>
																	<td><?=$keluar;?></td>
																	<td><?=$row['diff1'];?> <?php if(empty($row['diff1'])){}else{echo "Menit";} ?></td>
																	<td><?=$pulcep;?> <?php if(empty($row['diff2'])){}else{echo "Menit";} ?></td>
																</tr>
																<?php 
																		}
																		}
																	}
																}}
																?>
															</tbody>
															<tfoot>
																<tr>
																	<td colspan="3" style="text-align:right">Total</td>
																	<td><?=$telat;?> Menit</td>
																	<td><?=$cepul;?> Menit</td>
																</tr>
															</tfoot>