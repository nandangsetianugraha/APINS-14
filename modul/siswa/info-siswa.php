				<?php 
				include("../../config/config.php");
				include("../../config/db_connect.php");
				$tapel=$_POST['tapel'];
				$smt=$_POST['smt'];
				$idr=$_POST['rowid'];
				$infoptk = $connect->query("select * from siswa where peserta_didik_id='$idr'")->fetch_assoc();
				$kelas = $connect->query("select * from penempatan where peserta_didik_id='$idr' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
				?>
				<div class="modal-header">
					<h5 class="modal-title">Biodata <?=$infoptk['nama'];?></h5>
					<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<div class="modal-body">
					
						
							<!-- BEGIN Portlet -->
							<div class="portlet">
								<div class="portlet-header portlet-header-bordered">
									<div class="avatar avatar-circle avatar-lg">
										<div class="avatar-display">
											<img src="<?=base_url();?>images/siswa/<?=$infoptk['avatar'];?>" alt="AI">
										</div>
									</div>
									<div class="portlet-addon">
										<!-- BEGIN Nav -->
										<div class="nav nav-lines portlet-nav" id="portlet4-tab">
											<a class="nav-item nav-link active" id="portlet4-home-tab" data-bs-toggle="tab" href="#portlet4-home">Profil</a>
											<a class="nav-item nav-link" id="portlet4-profile-tab" data-bs-toggle="tab" href="#portlet4-profile">Data Rapor</a>
											<a class="nav-item nav-link" id="portlet4-contact-tab" data-bs-toggle="tab" href="#portlet4-contact">Rekam Didik</a>
											<a class="nav-item nav-link" id="portlet4-kes-tab" data-bs-toggle="tab" href="#portlet4-kes">Data Kesehatan</a>
											<a class="nav-item nav-link" id="portlet4-kemenkes-tab" data-bs-toggle="tab" href="#portlet4-kemenkes">Data Kemenkes</a>
										</div>
										<!-- END Nav -->
									</div>
								</div>
								<div class="portlet-body">
									<!-- BEGIN Tab -->
									<div class="tab-content">
										<div class="tab-pane fade show active" id="portlet4-home">
											<form class="row g-3">
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Nama Lengkap</label>
													<input type="text" class="form-control" name="nama" value="<?=$infoptk['nama'];?>" required>
													<input type="hidden" class="form-control" id="idptks" name="ptkid" value="<?=$infoptk['peserta_didik_id'];?>" required>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">NIK</label>
													<input type="text" class="form-control" name="nik" value="<?=$infoptk['nik'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">NIS</label>
													<input type="text" class="form-control" name="nis" value="<?=$infoptk['nis'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">NISN</label>
													<input type="text" class="form-control" name="nisn" value="<?=$infoptk['nisn'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Tempat</label>
													<input type="text" class="form-control" name="tempat" value="<?=$infoptk['tempat'];?>" required>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Tanggal</label>
													<input type="text" id="tanggal" name="tanggal" class="form-control" value="<?=$infoptk['tanggal'];?>" required>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Jenis Kelamin</label>
													<select name="jeniskelamin" class="form-select">
														<option value="L" <?php if($infoptk['jk']=='L') echo 'selected';?>>Laki-laki</option>
														<option value="P" <?php if($infoptk['jk']=='P') echo 'selected';?>>Perempuan</option>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Agama</label>
													<select class="form-select" name="agama" id="agama">
														<?php 
														$sql2 = "select * from agama";
														$query2 = $connect->query($sql2);
														while($nk=$query2->fetch_assoc()){
														?>
														<option value="<?=$nk['id_agama'];?>" <?php if($infoptk['agama']==$nk['id_agama']) echo 'selected';?>><?=$nk['nama_agama'];?></option>
														<?php };?>
													</select>
												</div>
												<div class="col-md-12">
													<label for="inputEmail4" class="form-label">Alamat</label>
													<input type="text" class="form-control" name="alamat" value="<?=$infoptk['alamat'];?>">
												</div>
												<div class="col-md-12">
													<label for="inputEmail4" class="form-label">Pendidikan Sebelumnya</label>
													<input type="text" class="form-control" name="pend_seb" value="<?=$infoptk['pend_sebelum'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Nama Ayah</label>
													<input type="text" class="form-control" name="ayah" value="<?=$infoptk['nama_ayah'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Nama Ibu</label>
													<input type="text" class="form-control" name="ibu" value="<?=$infoptk['nama_ibu'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Pekerjaan Ayah</label>
													<select class="form-select" name="pek_ayah">
														<?php 
														$sql21 = "select * from pekerjaan";
														$query21 = $connect->query($sql21);
														while($po1=$query21->fetch_assoc()){
														?>
														<option value="<?=$po1['id_pekerjaan'];?>" <?php if($infoptk['pek_ayah']==$po1['id_pekerjaan']) echo 'selected';?>><?=$po1['nama_pekerjaan'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Pekerjaan Ibu</label>
													<select class="form-select" name="pek_ibu">
														<?php 
														$sql21 = "select * from pekerjaan";
														$query21 = $connect->query($sql21);
														while($po1=$query21->fetch_assoc()){
														?>
														<option value="<?=$po1['id_pekerjaan'];?>" <?php if($infoptk['pek_ibu']==$po1['id_pekerjaan']) echo 'selected';?>><?=$po1['nama_pekerjaan'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-12">
													<label for="inputEmail4" class="form-label">Alamat Orang Tua</label>
													<input type="text" class="form-control" name="jalan" value="<?=$infoptk['jalan'];?>">
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Desa/Kelurahan</label>
													<select class="form-select" name="kelurahan" id="kelurahan">
														<option>Pilih Desa/kelurahan</option>
														<?php 
														$id_desa=$infoptk['kelurahan'];
														$id_kec=$infoptk['kecamatan'];
														$id_kab=$infoptk['kabupaten'];
														$id_prov=$infoptk['provinsi'];
														$sql21 = "select * from desa where id_kecamatan='$id_kec'";
														$query21 = $connect->query($sql21);
														while($nk=$query21->fetch_assoc()){
														?>
														<option value="<?=$nk['id'];?>" <?php if($id_desa==$nk['id']){echo "selected";}; ?>><?=$nk['nama'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Kecamatan</label>
													<select class="form-select" name="kecamatan" id="kecamatan">
														<option>Pilih Kecamatan</option>
														<?php 
														$sql21 = "select * from kecamatan where id_kabupaten='$id_kab'";
														$query21 = $connect->query($sql21);
														while($nk=$query21->fetch_assoc()){
														?>
														<option value="<?=$nk['id'];?>" <?php if($id_kec==$nk['id']){echo "selected";}; ?>><?=$nk['nama'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Kabupaten/Kota</label>
													<select class="form-select" name="kabupaten" id="kabupaten">
														<option>Pilih Kabupaten</option>
														<?php 
														$sql21 = "select * from kabupaten where id_provinsi='$id_prov'";
														$query21 = $connect->query($sql21);
														while($nk=$query21->fetch_assoc()){
														?>
														<option value="<?=$nk['id'];?>" <?php if($id_kab==$nk['id']){echo "selected";}; ?>><?=$nk['nama'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Provinsi</label>
													<select class="form-select" name="provinsi" id="provinsi">
														<option>Pilih Provinsi</option>
														<?php 
														$sql21 = "select * from provinsi";
														$query21 = $connect->query($sql21);
														while($nk=$query21->fetch_assoc()){
														?>
														<option value="<?=$nk['id_prov'];?>" <?php if($id_prov==$nk['id_prov']){echo "selected";}; ?>><?=$nk['nama'];?></option>
														<?php } ?>
													</select>
												</div>
												
												
											</form>
										</div>
										<div class="tab-pane fade" id="portlet4-profile">
											<form class="row g-3">
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Tahun Ajaran</label>
													<select class="form-select" id="tahunajaran" name="tahunajaran">
														<?php
														$sql21 = "select * from penempatan where peserta_didik_id='$idr' group by tapel";
														$query21 = $connect->query($sql21);
														while($nk=$query21->fetch_assoc()){
														?>
														<option value="<?=$nk['tapel'];?>" <?php if($tapel_aktif==$nk['tapel']) echo "selected"; ?>><?=$nk['tapel'];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-6">
													<label for="inputEmail4" class="form-label">Semester</label>
													<select class="form-select" id="semester" name="semester">
														<option value="1" <?php if($smt_aktif==1) echo "selected"; ?>>Semester 1</option>
														<option value="2" <?php if($smt_aktif==2) echo "selected"; ?>>Semester 2</option>
													</select>
												</div>
											</form>
											<hr>
											<div class="portlet">
												<div class="portlet-body data-rapor">
													
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="portlet4-contact">
											<div class="table-responsive">
												<table class="table table-striped table-hover mb-0">
													<thead>
														<tr>
															<th>Semester</th>
															<th>I</th>
															<th>II</th>
															<th>III</th>
															<th>IV</th>
															<th>V</th>
															<th>VI</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql212 = "select * from penempatan where peserta_didik_id='$idr' order by tapel desc";
														$query212 = $connect->query($sql212);
														while($nk1=$query212->fetch_assoc()){
															$abc=substr($nk1['rombel'],0,1);
														?>
														<tr>
															<td><?=$nk1['tapel'];?><br/><?php if($nk1['smt']=='1'){ echo "Ganjil"; }else{ echo "Genap"; }; ?></td>
															<td><?php if($abc=='1'){ echo "&#10004;"; };?></td>
															<td><?php if($abc=='2'){ echo "&#10004;"; };?></td>
															<td><?php if($abc=='3'){ echo "&#10004;"; };?></td>
															<td><?php if($abc=='4'){ echo "&#10004;"; };?></td>
															<td><?php if($abc=='5'){ echo "&#10004;"; };?></td>
															<td><?php if($abc=='6'){ echo "&#10004;"; };?></td>
															
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="portlet4-kes">
											<div class="table-responsive">
												<table class="table table-striped table-hover mb-0">
													<thead>
														<tr>
															<th>Semester</th>
															<th>Tinggi Badan (cm)</th>
															<th>Berat Badan (Kg)</th>
															<th>Pendengaran</th>
															<th>Penglihatan</th>
															<th>Gigi</th>
															<th>Lainnya</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql212 = "select * from penempatan where peserta_didik_id='$idr' order by tapel desc";
														$query212 = $connect->query($sql212);
														while($nk1=$query212->fetch_assoc()){
															$abc=substr($nk1['rombel'],0,1);
															$tpl=$nk1['tapel'];
															$smtl=$nk1['smt'];
															$dkes = $connect->query("select * from data_kesehatan where peserta_didik_id='$idr' and tapel='$tpl' and smt='$smtl'")->fetch_assoc();
														?>
														<tr>
															<td><?=$nk1['tapel'];?><br/><?php if($nk1['smt']=='1'){ echo "Ganjil"; }else{ echo "Genap"; }; ?></td>
															<td><?=$dkes['tinggi'];?></td>
															<td><?=$dkes['berat'];?></td>
															<td><?=$dkes['pendengaran'];?></td>
															<td><?=$dkes['penglihatan'];?></td>
															<td><?=$dkes['gigi'];?></td>
															<td><?=$dkes['lainnya'];?></td>
															
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="portlet4-kemenkes">
											<div class="table-responsive">
												<table class="table table-striped table-hover mb-0">
													<thead>
														<tr>
															<th>Jenis Layanan</th>
															<th>Tanggal Pelaksanaan</th>
															<th>Tempat Pelaksanaan</th>
															<th>Tipe Vaksinasi</th>
															<th>Dosis</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql2121 = "select * from data_kemenkes where peserta_didik_id='$idr'";
														$query2121 = $connect->query($sql2121);
														while($nk2=$query2121->fetch_assoc()){
														?>
														<tr>
															<td><?=$nk2['jenis'];?></td>															
															<td><?=$nk2['tanggal'];?></td>															
															<td><?=$nk2['tempat'];?></td>															
															<td><?=$nk2['tipe'];?></td>															
															<td><?=$nk2['dosis'];?></td>															
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- END Tab -->
								</div>
							</div>
							<!-- END Portlet -->
						
					
				</div>
				
				
				<script>
				var idptk = $('#idptks').val();
				var semester=$('#semester').val();
				var tapel = $('#tahunajaran').val();
				$.ajax({
					type : 'post',
					url : 'modul/siswa/data-rapor.php',
					data :  'rowid='+ idptk +'&semester='+semester+'&tapel='+tapel,
					beforeSend: function()
					{	
						$(".data-rapor").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
						$("#loading").show();
						$(".loader").show();
					},
					success : function(data){
						$("#loading").hide();
						$(".loader").hide();
						$('.data-rapor').html(data);//menampilkan data ke dalam modal
					}
				});
				$('#semester').change(function(){
					//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
					var idptk = $('#idptks').val();
					var semester=$('#semester').val();
					var tapel = $('#tahunajaran').val();
					$.ajax({
						type : 'post',
						url : 'modul/siswa/data-rapor.php',
						data :  'rowid='+ idptk +'&semester='+semester+'&tapel='+tapel,
						beforeSend: function()
						{	
							$(".data-rapor").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
							$("#loading").show();
							$(".loader").show();
						},
						success : function(data){
							$("#loading").hide();
							$(".loader").hide();
							$('.data-rapor').html(data);//menampilkan data ke dalam modal
						}
					});
				});
				$('#tahunajaran').change(function(){
					//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
					var idptk = $('#idptks').val();
					var semester=$('#semester').val();
					var tapel = $('#tahunajaran').val();
					$.ajax({
						type : 'post',
						url : 'modul/siswa/data-rapor.php',
						data :  'rowid='+ idptk +'&semester='+semester+'&tapel='+tapel,
						beforeSend: function()
						{	
							$(".data-rapor").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading ...');
							$("#loading").show();
							$(".loader").show();
						},
						success : function(data){
							$("#loading").hide();
							$(".loader").hide();
							$('.data-rapor').html(data);//menampilkan data ke dalam modal
						}
					});
				});
				$('#provinsi').change(function(){
						//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
						var prov = $('#provinsi').val();
						$.ajax({
							type : 'GET',
							url : 'config/kabupaten.php',
							data :  'prov_id=' + prov,
							success: function (data) {
								//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
								$("#kabupaten").html(data);
							}
						});
				});
				$('#kabupaten').change(function(){
						//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
						var kab = $('#kabupaten').val();
						$.ajax({
							type : 'GET',
							url : 'config/kecamatan.php',
							data :  'id_kabupaten=' + kab,
							success: function (data) {
								//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
								$("#kecamatan").html(data);
							}
						});
				});
				$('#kecamatan').change(function(){
						//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
						var desa = $('#kecamatan').val();
						$.ajax({
							type : 'GET',
							url : 'config/desa.php',
							data :  'id_kecamatan=' + desa,
							success: function (data) {
								//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
								$("#kelurahan").html(data);
								// alert($('#provinsi option:selected').text() + $('#kabupaten option:selected').text() + $('#kecamatan option:selected').text() + $('#desa option:selected').text());
							}
						});
				});
				</script>