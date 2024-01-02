<?php
include '../function/db_connect.php';
$tapel=$_GET['tapel'];
	$kelas=$_GET['kelas'];
	$smt=$_GET['smt'];
	$bulan=(int) $_GET['bulan'];
	$jenis=$_GET['jenis'];
	$thn=isset($_GET['thn']) ? $_GET['thn'] : date("Y");
?>
<table class="table table-bordered table-hover">
    <br>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
		<th>Kelas</th>
		<?php
		$jtung=$connect->query("select * from jenis_tunggakan order by id_tunggakan asc");	
		while($sis=$jtung->fetch_assoc()){
		?>
        <th><?=$sis['nama_tunggakan'];?></th>
		<?php } ?>
		<th>Jumlah Tunggakan</th>
		<th>Jumlah Tabungan</th>
    </tr>
    </thead>
   
        <tbody>
		<?php 
		$nom=1;
		$nsis=$connect->query("select * from penempatan where tapel='$tapel' and smt='$smt' order by rombel,nama asc");
		while($namasis=$nsis->fetch_assoc()){
			$ids=$namasis['peserta_didik_id'];
		?>
        <tr>
            <td><?=$nom;?></td>
			<td><?=$namasis['nama'];?></td>
			<td><?=$namasis['rombel'];?></td>
			<?php 
			$spp=$connect->query("select * from tarif_spp where peserta_didik_id='$ids'")->fetch_assoc();
			$jumlah=0;
			$sisa=0;
			for($j = 1; $j < $bulan+1; $j++){
				$sppbln=$connect->query("select * from pembayaran where peserta_didik_id='$ids' and tapel='$tapel' and jenis='1' and bulan='$j'")->num_rows;
				if($sppbln>0){
				}else{
					$blnspp=$connect->query("select * from bulan_spp where id_bulan='$j'")->fetch_assoc();
					$jumlah=$jumlah+$spp['tarif'];
					$sisa=$sisa+$spp['tarif'];
				};
			};
			?>
			<td><?=$jumlah;?></td>
			<?php 
			$stun=0;
			$jt=$connect->query("select * from jenis_tunggakan where id_tunggakan>1 order by id_tunggakan asc");	
			while($h=$jt->fetch_assoc()) {
				$idt=$h['id_tunggakan'];
				$cek=$connect->query("select * from pembayaran where peserta_didik_id='$ids' and tapel='$tapel' and jenis='$idt'")->num_rows;
				$tarifnya=$connect->query("select * from tunggakan_lain where peserta_didik_id='$ids' and tapel='$tapel' and jenis='$idt'")->fetch_assoc();
				if($tarifnya['tarif']==0){	
					$stun=0;
				}else{
					if($cek>0){
						$bayar=$connect->query("select sum(bayar) as sudahbayar from pembayaran where peserta_didik_id='$ids' and tapel='$tapel' and jenis='$idt'")->fetch_assoc();
						$sudah=$bayar['sudahbayar'];
						if($sudah==$tarifnya['tarif']){
							$stun=0;
						}else{
							$sisanya=$tarifnya['tarif']-$sudah;
							$stun=$sisanya;
						};
					}else{
						$stun=$tarifnya['tarif'];
					};
				};
			?>
			<td><?=$stun;?></td>
			<?php } ?>
			<td></td>
			<?php 
			$idnas=$connect->query("select * from nasabah where user_id='$ids'")->fetch_assoc();
			$idn=$idnas['nasabah_id'];
			$ssaldo=$connect->query("SELECT sum(IF(kode='1',masuk,0)) as setoran, sum(IF(kode='2',keluar,0)) as penarikan FROM tabungan WHERE nasabah_id = '$idn'")->fetch_assoc();
			$saldo=$ssaldo['setoran']-$ssaldo['penarikan'];
			?>
			<td><?=$saldo;?></td>
        </tr>
		<?php 
		$nom=$nom+1;
		} 
		?>
		<?php 
		$nnas=$connect->query("select * from nasabah where jenis>1 order by nama asc");
		while($nasabah=$nnas->fetch_assoc()){
			$idk=$nasabah['nasabah_id'];
		?>
		<tr>
            <td><?=$nom;?></td>
			<td><?=$nasabah['nama'];?></td>
			<td>Lainnya</td>
			<td></td>
			<?php 
			$jt=$connect->query("select * from jenis_tunggakan where id_tunggakan>1 order by id_tunggakan asc");	
			while($h=$jt->fetch_assoc()) {
			?>
			<td></td>
			<?php } ?>
			<td></td>
			<?php 
			$nsaldo=$connect->query("SELECT sum(IF(kode='1',masuk,0)) as setoran, sum(IF(kode='2',keluar,0)) as penarikan FROM tabungan WHERE nasabah_id = '$idk'")->fetch_assoc();
			$saldon=$nsaldo['setoran']-$nsaldo['penarikan'];
			?>
			<td><?=$saldon;?></td>
		</tr>
		<?php 
		$nom=$nom+1;
		} 
		?>
        </tbody>
        
</table>