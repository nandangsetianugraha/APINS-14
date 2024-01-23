<?php 
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
$ids=$_GET['idsw'];
$idp=$_GET['siswa'];
$smt=$_GET['smt'];
$tapel=$_GET['tapel'];
$siswa=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
$rombel=$connect->query("SELECT * FROM penempatan where peserta_didik_id='$idp' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
//hahahaha
?>
<div class="modal-body">
	<div class="row">
		<div class="col-12">
			<div class="rich-list-item p-0">
				<div class="rich-list-prepend">
					<div class="avatar avatar-circle avatar-lg">
						<div class="avatar-display">
							<img src="<?=base_url();?>images/siswa/<?=$siswa['avatar'];?>" alt="AI">
						</div>
					</div>
				</div>
				<div class="rich-list-content">
					<h4 class="rich-list-title"><?=$siswa['nama'];?></h4>
					<span class="rich-list-subtitle"><?=$siswa['nisn'];?></span>
				</div>
			</div>
		</div>
		<div class="col-12 mt-2">
			<input type="hidden" class="form-control" name="siswa" value="<?=$idp;?>"/>
			<input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>"/>
			<input type="hidden" class="form-control" name="smt" value="<?=$smt;?>"/>
			<input type="hidden" class="form-control" name="idsw" value="<?=$ids;?>"/>
			<input type="hidden" class="form-control" name="nisn" value="<?=$siswa['nisn'];?>" readonly>
			<?php 
			$sql = "select * from rombel where tapel='$tapel' and tapel='$smt'";
			$query = $connect->query($sql);
			?>
			<select name="kelas" class="form-select">
			<?php while ($row = $query->fetch_assoc()) { ?>
				<option value="<?=$row['nama_rombel'];?>" <?php if($row['nama_rombel']===$rombel['rombel']) echo "selected"; ?>>Kelas <?=$row['nama_rombel'];?></option>
			<?php } ?>
			</select>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">Simpan</button>
</div>