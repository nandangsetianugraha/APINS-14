<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$idp=$_GET['ptk'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$ptk=$connect->query("select * from ptk where ptk_id='$idp'")->fetch_assoc();
//$rombel=$connect->query("SELECT * FROM penempatan where peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
//hahahaha
?>
<div class="modal-body">
	<div class="row">
		<div class="col-12">
			<div class="rich-list-item p-0">
				<div class="rich-list-prepend">
					<div class="avatar avatar-circle avatar-lg">
						<div class="avatar-display">
							<img src="<?=base_url();?>images/ptk/<?=$ptk['gambar'];?>" alt="AI">
						</div>
					</div>
				</div>
				<div class="rich-list-content">
					<h4 class="rich-list-title"><?=$ptk['nama'];?></h4>
					<span class="rich-list-subtitle"><?=$ptk['niy_nigk'];?></span>
				</div>
			</div>
		</div>
		<div class="col-12 mt-2">
			<input type="hidden" class="form-control" name="ptk" value="<?=$idp;?>"/>
			<input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>"/>
			<input type="hidden" class="form-control" name="smt" value="<?=$smt;?>"/>
			<?php 
			$sql = "select * from jns_mutasi";
			$query = $connect->query($sql);
			?>
			<select name="jenis" class="form-select">
			<?php while ($row = $query->fetch_assoc()) { ?>
				<option value="<?=$row['id_mutasi'];?>"><?=$row['nama_mutasi'];?></option>
			<?php } ?>
			</select>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan</button>
</div>