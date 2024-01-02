<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$smt=$_POST['smt'];
$tapel=$_POST['tapel'];
$proyek=$_POST['proyek'];
?>
				<div class="modal-header">
					<h5 class="modal-title">Pemetaan Proyek</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-4">
                      <input type="hidden" class="form-control" name="kelas" value="<?=$kelas;?>">
					  <input type="hidden" class="form-control" name="smt" value="<?=$smt;?>">
					  <input type="hidden" class="form-control" name="tapel" value="<?=$tapel;?>">
					  <input type="hidden" class="form-control" name="proyek" value="<?=$proyek;?>">
					  
					  <select class="form-select" id="dimensi" name="dimensi">
							<option value="0">Pilih Dimensi</option>
							<?php 
							$sql4 = "select * from dimensi_proyek order by id_dimensi asc";
							$query4 = $connect->query($sql4);
							$ck=0;
							while($nk=$query4->fetch_assoc()){
							?>
							<option value="<?=$nk['id_dimensi'];?>"><?=$nk['nama_dimensi'];?></option>
							<?php
							};
							?>
					  </select>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				
				