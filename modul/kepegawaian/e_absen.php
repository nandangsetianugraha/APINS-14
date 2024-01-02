<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
$tanggal=$_POST['tanggal'];
$cek="SELECT * FROM id_pegawai WHERE pegawai_id='$idr'";
$hasil=$connect->query($cek);
$utt=$hasil->fetch_assoc();
$ptkid=$utt['ptk_id'];
$namapeg=$connect->query("select * from ptk where ptk_id='$ptkid'")->fetch_assoc();
?>
						<div class="modal-header">
							<h5 class="modal-title">Absen Manual <?=$namapeg['nama'];?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default">
								<label>Tanggal</label>
								<input type="hidden" id="id_peg" name="idpeg" class="form-control" value="<?php echo $idr;?>">
								<input type="text" class="form-control" value="<?=$tanggal;?>" id="hari" name="hari" readonly=true>
							</div>
							<div class="form-group form-group-default">
								<label>Jam</label>
								<div class="input-group">
									<span class="input-group-text">
										<i class="far fa-clock"></i>
									</span>
									<input type="text" class="form-control" name="jam" id="inputmask-3">
								</div>													
							</div>
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>
<script>
	$('#hari').datepicker({
		format: 'yyyy-mm-dd',
		autoclose:true
	});
	$("#inputmask-3").inputmask({ mask: "99:99", placeholder: "" });
</script>
