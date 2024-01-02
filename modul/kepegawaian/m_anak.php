<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idptk=$_POST['idptk'];
$cek="SELECT * FROM ptk WHERE ptk_id='$idptk'";
$hasil=$connect->query($cek);
$utt=$hasil->fetch_assoc();
?>

						<div class="modal-body">
							<div class="form-group form-group-default mb-2">
								<label>Nama Anak</label>
								<input type="hidden" id="idptk" name="idptk" class="form-control" value="<?php echo $idptk;?>">
								<input id="nama_anak" type="text" name="nama_anak" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Jenis Kelamin</label>
								<select id="jk" class="form-select" name="jk">
									<option value="0">Pilih Jenis Kelamin</option>
									<option value="L">Laki-laki</option>
									<option value="P">Perempuan</option>
								</select>															
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Jenjang</label>
								<select id="status" class="form-select" name="status">
									<option value="0">Pilih Status</option>
									<option value="ak">Anak Kandung</option>
									<option value="at">Anak Tiri</option>
									<option value="aa">Anak Angkat</option>
								</select>															
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Tempat Lahir</label>
								<input id="tempat" type="text" name="tempat" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Tanggal Lahir</label>
								<input id="tanggal_lahir" type="text" name="tanggal" autocomplete=off class="form-control" placeholder="yyyy-mm-dd">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Jenjang</label>
								<select id="jenjang" class="form-select" name="jenjang">
									<option value="0">Pilih Jenjang</option>
									<?php 
									$sql4 = "select * from jenjang_pendidikan order by id_jenjang asc";
									$query4 = $connect->query($sql4);
									while($nk=mysqli_fetch_array($query4)){
									?>
									<option value="<?php echo $nk['id_jenjang']; ?>"><?=$nk['nama_jenjang']; ?></option>
									<?php };?>
								</select>															
							</div>
							<div class="form-group form-group-default mb-2">
								<label>NISN</label>
								<input id="nisn" type="text" name="nisn" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>Tahun Masuk</label>
								<input id="masuk" type="text" name="masuk" autocomplete=off class="form-control">
							</div>
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>
<script>
$('#tanggal_lahir').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
</script>