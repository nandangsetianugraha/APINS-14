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
								<label>JENIS LAYANAN</label>
								<input type="hidden" id="idptk" name="idptk" class="form-control" value="<?php echo $idptk;?>">
								<input id="jenis" type="text" name="jenis" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>TANGGAL PELAKSANAAN</label>
								<input id="tanggal" type="text" name="tanggal" autocomplete=off class="form-control" placeholder="yyyy-mm-dd">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>TEMPAT PELAKSANAAN</label>
								<input id="tempat" type="text" name="tempat" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>TIPE VAKSINASI</label>
								<input id="tipe" type="text" name="tipe" autocomplete=off class="form-control">
							</div>
							<div class="form-group form-group-default mb-2">
								<label>DOSIS</label>
								<input id="dosis" type="text" name="dosis" autocomplete=off class="form-control">
							</div>
						</div>
						<div class="modal-footer">
																<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan
																</button>
															</div>
<script>
$('#tanggal').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true
		});
</script>