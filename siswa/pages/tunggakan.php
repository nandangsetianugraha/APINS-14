
	<!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Tunggakan</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
	
	<!-- App Capsule -->
    <div id="appCapsule">

        <!-- konten -->
		<div class="section mt-2">
			<?php 
			$spp = $connect->query("select * from tarif_spp where peserta_didik_id='$idku'")->fetch_assoc();
			$sppbln = $connect->query("select * from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='1' and bulan='$blnspp'")->num_rows;
			$rincian = $connect->query("select * from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='1' and bulan='$blnspp'")->fetch_assoc();
			$jlak=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='L' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jper=$connect->query("select * from penempatan JOIN siswa USING(peserta_didik_id) where siswa.jk='P' and penempatan.rombel='$kelas' and penempatan.tapel='$tapel_aktif' and penempatan.smt='$smt_aktif'")->num_rows;
			$jtot=$jlak+$jper;
			?>
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=home_url();?>images/siswa/<?=$avatar;?>" alt="avatar" class="imaged w64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?=$bioku['nama'];?></h3>
                    <h5 class="subtext">Kelas <?=$kelas;?></h5>
                </div>
            </div>
        </div>

        

        <div class="section mt-1 mb-2">
            <div class="profile-info">
                <div class=" bio">
                    <?php if($sppbln>0){ ?>
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
						<h4>Terima Kasih</h4>
						Anda sudah melakukan pembayaran Infaq Bulanan Bulan <?=$blns[$bln-1];?><br/>
						No. Invoice : <?=$rincian['id_invoice'];?> Tanggal : <?=TanggalIndo($rincian['tanggal']);?>
					</div>
					<?php }else{ ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<h4>Perhatian!</h4>
						<strong>Infaq Bulanan</strong> Bulan <?=$blns[$bln-1];?> Belum dibayar.
					</div>
					<?php } ?>
                </div>
            </div>
        </div>

        <div class="section full">
            <div class="wide-block transparent p-0">
                <ul class="nav nav-tabs lined iconed" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#feed" role="tab">
                            <ion-icon name="newspaper-outline"></ion-icon> SPP
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#friends" role="tab">
                            <ion-icon name="receipt-outline"></ion-icon> Lainnya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#riwayat" role="tab">
                            <ion-icon name="card-outline"></ion-icon> Transaksi
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- tab content -->
        <div class="section full mb-2">
            <div class="tab-content">

                <!-- feed -->
                <div class="tab-pane fade show active" id="feed" role="tabpanel">
                        <ul class="listview image-listview flush transparent pt-1">
						<?php 
						$query = $connect->query("select * from bulan_spp order by id_bulan asc");
						$lunas=0;
						$tahun1=substr($tapel_aktif,0,4);
						$tahun2=substr($tapel_aktif,5,4);
						while($s=$query->fetch_assoc()) {
							$ids=$s['id_bulan'];
							$namabulan=$connect->query("select * from bulan_spp where id_bulan='$ids'")->fetch_assoc();
							$cekspp=$connect->query("select * from tarif_spp where peserta_didik_id='$idku'")->num_rows;
							$tarifspp=$connect->query("select * from tarif_spp where peserta_didik_id='$idku'")->fetch_assoc();
							$tarifnya=$tarifspp['tarif'];
							$spp=$connect->query("select * from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='1' and bulan='$ids'")->num_rows;
							if($spp>0){
								$logo='<ion-icon name="checkmark-outline"></ion-icon>';
								$latar='bg-primary';
								$status='Lunas';
							}else{
								$logo='<ion-icon name="close-outline"></ion-icon>';
								$latar='bg-danger';
								$status='Belum dibayarkan';
							};
						?>
                        <li>
							<div class="item">
                                <div class="icon-box <?=$latar;?>">
									<?=$logo;?>
								</div>
                                <div class="in">
                                    <div>
                                        <?=$namabulan['bulan'];?> <?php if($ids<7){ echo $tahun1;}else{ echo $tahun2;} ?>
                                        <div class="text-muted"><?=$status;?></div>
                                    </div>
                                </div>
                            </div>
                        </li>
						<?php } ?>
                    </ul>
                </div>
                <!-- * feed -->

                <!-- * friends -->
                <div class="tab-pane fade" id="friends" role="tabpanel">
                    <?php 
														$sql = "select * from tunggakan_lain where peserta_didik_id='$idku' and tapel='$tapel_aktif' order by jenis asc";
														$query = $connect->query($sql);
														$cek = $query->num_rows;
														if($cek>0){
														?>
													<div class="table-responsive">
														<table class="table">
															<thead>
																<tr>
																	<th scope="col">Tunggakan</th>
																	<th scope="col">Dibayar</th>
																	<th scope="col">Sisa</th>
																</tr>
															</thead>
															<tbody>
																<?php
																while($s=$query->fetch_assoc()) {
																	$ids=$s['jenis'];
																	$idt=$s['id'];
																	$namajenis=$connect->query("select * from jenis_tunggakan where id_tunggakan='$ids'")->fetch_assoc();
																	$ceklunas=$connect->query("select sum(bayar) as sudah_bayar from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='$ids'")->fetch_assoc();								
																?>
																<tr>
																	<th scope="row"><?=$namajenis['nama_tunggakan'];?></th>
																	<?php if($ceklunas['sudah_bayar']==$s['tarif']){ ?>
																	<td>Lunas</td>
																	<?php }else{ ?>
																	<td><?=rupiah($ceklunas['sudah_bayar']);?></td>
																	<?php } ?>
																	<td><?=rupiah($s['tarif']-$ceklunas['sudah_bayar']);?></td>
																</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
													<?php 
														}else{ 
														?>
														<div class="alert alert-primary" role="alert">
															Belum ada Tunggakan Lain
														</div>
														<?php } ?>
                </div>
                <!-- * riwayat -->
				<div class="tab-pane fade" id="riwayat" role="tabpanel">
											
													<div class="table-responsive">
														<?php 
														$sql = "select * from invoice where peserta_didik_id='$idku' order by nomor desc";
														$query = $connect->query($sql);
														$cek = $query->num_rows;
														if($cek>0){
														?>
														<table class="table">
															<thead>
																<tr>
																	<th scope="col">Nomor</th>
																	<th scope="col">Tanggal</th>
																	<th scope="col">Besarnya</th>
																</tr>
															</thead>
															<tbody>
																<?php
																while($s=$query->fetch_assoc()) {
																	$ids=$s['jenis'];
																	$idt=$s['id'];
																	$namajenis=$connect->query("select * from jenis_tunggakan where id_tunggakan='$ids'")->fetch_assoc();
																	$ceklunas=$connect->query("select sum(bayar) as sudah_bayar from pembayaran where peserta_didik_id='$idku' and tapel='$tapel_aktif' and jenis='$ids'")->fetch_assoc();								
																?>
																<tr>
																	<td><a href="javascript;;" data-tema="<?=$s['nomor'];?>" data-toggle="modal" data-target="#deskk"><?=$s['nomor'];?></a></td>
																	<td><?=$s['tanggal'];?></td>
																	<td><?=rupiah($s['jumlah']);?></td>
																</tr>
																<?php } ?>
															</tbody>
														</table>
														<?php }else{ ?>
														<div class="alert alert-danger alert-dismissible fade show" role="alert">
															<h4>Perhatian!</h4>
															Belum ada riwayat transaksi
														</div>
														<?php } ?>
													</div>
				</div>
                
            </div>
        </div>
        <!-- * tab content -->
		<!-- konten -->
		
		


        <!-- app footer -->
        
        <!-- * app footer -->

    </div>
		<div class="modal fade dialogbox" id="deskk" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content tema-datas">
                    
                </div>
            </div>
        </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <?php include "layout/app-bottom.php";?>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <?php include "layout/app-sidebar.php";?>
	<!-- * App Sidebar -->

    

    <!-- ///////////// Js Files ////////////////////  -->
    <?php include "layout/javascript.php";?>
	<script>
			$('#deskk').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('tema');
				//var jns = $(e.relatedTarget).data('jns');
				//menggunakan fungsi ajax untuk pengambilan data
				$.ajax({
					type : 'post',
					url : 'modul/invoice.php',
					data :  'rowid='+ rowid,
					beforeSend: function()
							{	
								$(".tema-datas").html('<p class="text-center"><img src="loader.gif"></p>');
							},
					success : function(data){
					$('.tema-datas').html(data);//menampilkan data ke dalam modal
					}
				});
			});
	</script>


    