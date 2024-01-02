<?php
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idr=$_POST['rowid'];
$cek="SELECT * FROM pengguna WHERE id='$idr'";
$hasil=$connect->query($cek);
$utt=$hasil->fetch_assoc();
$ptkid=$utt['ptk_id'];
$namapeg=$connect->query("select * from ptk where ptk_id='$ptkid'")->fetch_assoc();
?>
						<div class="modal-header">
							<h5 class="modal-title">Pengguna <?=$namapeg['nama'];?></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<div class="form-group form-group-default">
								<label>Level</label>
								<input type="hidden" id="id_peg" name="idpeg" class="form-control" value="<?php echo $idr;?>">
								<select class="form-select" name="jenispegawai" <?php if($level==11){}else{ echo 'readonly';}?>>
									<?php 
									$sql2 = "select * from jenis_ptk";
									$query2 = $connect->query($sql2);
									while($po=$query2->fetch_assoc()){
									?>
									<option value="<?=$po['jenis_ptk_id'];?>" <?php if($po['jenis_ptk_id']===$utt['level']){ echo "selected";}?>><?=$po['jenis_ptk'];?></option>
									<?php } ?>
								</select>
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
