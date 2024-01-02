<?php 
require_once '../../config/db_connect.php';
$smt=$_POST['smt'];
$tapel=$_POST['tapel'];
?>
				<div class="modal-header">
					<h5 class="modal-title">Tambah Rombel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" id="smt" name="smt" value="<?=$smt;?>">
					<div class="row mb-2">
						<div class="col-6">
							<div class="mb-2">
							  <label class="form-label" for="example-text-input">Tahun Ajaran</label>
							  <select class="form-select" id="ptapel" name="ptapel">
								<?php 
								$sql4 = "select * from tapel order by nama_tapel asc";
								$query4 = $connect->query($sql4);
								while($nk=$query4->fetch_assoc()){
									if($tapel==$nk['nama_tapel']){
										$stt="selected";
									}else{
										$stt='';
									};
									echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
								}	
								?>
							  </select>
							</div>
						</div>
						<div class="col-6">
							<div class="mb-2">
							  <label class="form-label" for="example-text-input">Semester</label>
							  <select class="form-select" id="psmt" name="psmt">
								<option value="1" <?php if($smt=='1') echo "selected"; ?>>Semester 1</option>
								<option value="2" <?php if($smt=='2') echo "selected"; ?>>Semester 2</option>
							  </select>
							</div>
						</div>
						<div class="col-6">
							<div class="mb-2">
							  <label class="form-label" for="example-text-input">Nama Rombel</label>
							  <input type="text" name="rombel" autocomplete=off class="form-control" placeholder="Nama Rombel">
							</div>
						</div>
						<div class="col-6">
							<div class="mb-2">
							  <label class="form-label" for="example-text-input">Kurikulum</label>
							  <select class="form-select" name="kurikulum">
								<?php 
								$sql_tapel=$connect->query("select * from kurikulum");
								while($tma=$sql_tapel->fetch_assoc()){
								?>
								<option value="<?=$tma['nama_kurikulum'];?>"><?=$tma['nama_kurikulum'];?></option>
								<?php } ?>
							  </select>
							</div>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-12">
							<div class="mb-2">
							  <label class="form-label" for="example-text-input">Wali Kelas</label>
							  <select class="form-select" name="walikelas">
									<option value="">Pilih Wali Kelas</option>
									<?php 
									$sql_wk=$connect->query("select * from ptk where status_keaktifan_id=1");
									while($twk=$sql_wk->fetch_assoc()){
									?>
									<option value="<?=$twk['ptk_id'];?>"><?=$twk['nama'];?></option>
									<?php } ?>
							  </select>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-2">
								<label class="form-label" for="example-text-input">Guru Pendamping</label>
								<select class="form-select" name="gurup">
									<option value="">Pilih Guru Pendamping</option>
									<?php 
									$sql_gp=$connect->query("select * from ptk where status_keaktifan_id=1");
									while($tgp=$sql_gp->fetch_assoc()){
									?>
									<option value="<?=$tgp['ptk_id'];?>"><?=$tgp['nama'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-12">
							<div class="mb-2">
								<label>Guru PAI</label>
								<select class="form-select" name="pai">
									<option value="">Pilih Guru PAI</option>
									<?php 
									$sql_gp=$connect->query("select * from ptk where status_keaktifan_id=1");
									while($tgp=$sql_gp->fetch_assoc()){
									?>
									<option value="<?=$tgp['ptk_id'];?>"><?=$tgp['nama'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-2">
								<label>Guru PJOK</label>
								<select class="form-select" name="pjok">
									<option value="">Pilih Guru PJOK</option>
									<?php 
									$sql_gp=$connect->query("select * from ptk where status_keaktifan_id=1");
									while($tgp=$sql_gp->fetch_assoc()){
									?>
									<option value="<?=$tgp['ptk_id'];?>"><?=$tgp['nama'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-2">
								<label>Guru Bahasa Inggris</label>
								<select class="form-select" name="inggris">
									<option value="">Pilih Guru Bahasa Inggris</option>
									<?php 
									$sql_gp=$connect->query("select * from ptk where status_keaktifan_id=1");
									while($tgp=$sql_gp->fetch_assoc()){
									?>
									<option value="<?=$tgp['ptk_id'];?>"><?=$tgp['nama'];?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--
					<div class="row mb-2">
						<div class="col-6">
							<div class="mb-2">
							</div>
						</div>
						<div class="col-6">
							<div class="mb-2">
							</div>
						</div>
					</div>
					-->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				