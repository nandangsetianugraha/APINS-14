<?php 
require_once '../../config/db_connect.php';
$kelas=$_POST['kelas'];
$ab=substr($kelas,0,1);
$smt=$_POST['smt'];
$tapel=$_POST['tapel'];
?>
				<div class="modal-header">
					<h5 class="modal-title">PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" id="kelas" name="kelas" value="<?=$kelas;?>">
					<input type="hidden" class="form-control" id="smt" name="smt" value="<?=$smt;?>">
					<input type="hidden" class="form-control" id="tapel" name="tapel" value="<?=$tapel;?>">
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
							<option value="<?=$nk['id_tema'];?>"><?=$nk['nama_tema'];?></option>
							<?php
							};
							?>
					  </select>
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Fase</label>
                      <select class="form-select" id="fase" name="fase">
							<option value="0">Pilih Fase</option>
							<option value="A" <?php if($ab==1 or $ab==2){ echo "selected"; } ?>>Fase A</option>
							<option value="B" <?php if($ab==3 or $ab==4){ echo "selected"; } ?>>Fase B</option>
							<option value="C" <?php if($ab==5 or $ab==6){ echo "selected"; } ?>>Fase C</option>
					  </select>
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Nama Proyek</label>
                      <input type="text" class="form-control" id="n_proyek" name="n_proyek" placeholder="Nama Proyek">
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Deskripsi Proyek</label>
					  <textarea class="form-control" id="d_proyek" name="d_proyek" rows="4" placeholder="Deskripsi Proyek.."></textarea>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				