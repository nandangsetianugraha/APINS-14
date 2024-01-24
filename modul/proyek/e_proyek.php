<?php 
require_once '../../config/db_connect.php';
$rowid=$_POST['rowid'];
$proy=$connect->query("select * from data_proyek where id_proyek='$rowid'")->fetch_assoc();
?>
				<div class="modal-header">
					<h5 class="modal-title">PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" id="idproyek" name="idproyek" value="<?=$rowid;?>">
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Tema</label>
					  
					  <select class="form-select" id="tema" name="tema">
							<option value="0">Pilih Tema</option>
							<?php 
							$sql4 = "select * from tema_proyek order by id_tema asc";
							$query4 = $connect->query($sql4);
							$ck=0;
							while($nk=$query4->fetch_assoc()){
							?>
							<option value="<?=$nk['id_tema'];?>" <?php if($proy['tema']==$nk['id_tema']){echo "selected";} ?>><?=$nk['nama_tema'];?></option>
							<?php
							};
							?>
					  </select>
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Fase</label>
                      <select class="form-select" id="fase" name="fase">
							<option value="0" <?php if($proy['fase']==' '){echo "selected";} ?>>Pilih Fase</option>
							<option value="A" <?php if($proy['fase']=='A'){echo "selected";} ?>>Fase A</option>
							<option value="B" <?php if($proy['fase']=='B'){echo "selected";} ?>>Fase B</option>
							<option value="C" <?php if($proy['fase']=='C'){echo "selected";} ?>>Fase C</option>
					  </select>
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Nama Proyek</label>
                      <input type="text" class="form-control" id="n_proyek" name="n_proyek" placeholder="Nama Proyek" value="<?=$proy['nama_proyek'];?>">
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Deskripsi Proyek</label>
					  <textarea class="form-control" id="d_proyek" name="d_proyek" rows="4" placeholder="Deskripsi Proyek.."><?=$proy['deskripsi_proyek'];?></textarea>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				