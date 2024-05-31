<?php 
require_once '../../config/db_connect.php';
$jns=$_POST['jns'];
if($jns=='0'){
?>
<div class="alert alert-outline-secondary">
								<div class="alert-icon">
									<i class="fa fa-wrench"></i>
								</div>
								<div class="alert-content">Pilih Dulu Kurikulum nya</div>
							</div>
<?php 
}else{
?>
<div class="modal-header">
	<h5 class="modal-title">Tambah Mapel</h5>
	<button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
		<i class="fa fa-times"></i>
	</button>
</div>
<div class="modal-body">
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kode Mata Pelajaran</label>
			<input type="hidden" name="jns" autocomplete=off class="form-control" value="<?=$jns;?>">
			<input type="text" name="kd_mapel" autocomplete=off class="form-control" placeholder="Kode Mata Pelajaran">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Mata Pelajaran</label>
			<input type="text" name="mapel" autocomplete=off class="form-control" placeholder="Nama Mata Pelajaran">
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Kelompok Mata Pelajaran</label>
			<select id="kelompok" name="kelompok" class="form-select">
				<?php 
				$sql4 = "select * from kelompok_mapel where kurikulum='$jns' order by urut asc";
				$query4 = $connect->query($sql4);
				while($nk=$query4->fetch_assoc()){
					$idk = $nk['id_kelompok'];
					$nkur = $nk['kelompok'];
					echo '<option value="'.$idk.'">'.$nkur.'</option>';
				}	
				?>
			</select>
		</div>
		<div class="mb-4">
			<label class="form-label" for="example-text-input">Urutan Mata Pelajaran</label>
			<input type="text" name="urut" autocomplete=off class="form-control" placeholder="Urutan Mata Pelajaran">
		</div>
</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Simpan</button>
</div>
<?php } ?>