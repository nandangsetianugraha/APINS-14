<?php 
require_once '../../config/db_connect.php';
$rowid=$_POST['rowid'];
$tujuan=$connect->query("select * from raport_ikm where id_raport='$rowid'")->fetch_assoc();
$kelas=$tujuan['kelas'];
$smt=$tujuan['smt'];
$mp=$tujuan['mapel'];
$tapel=$tujuan['tapel'];
$idp=$tujuan['id_pd'];
$nilai=number_format($tujuan['nilai'],0);
$data = explode("|" , $tujuan['deskripsi']);
$kelebihan=$data[0];
$kelemahan=$data[1];
$nama=$connect->query("select * from siswa where peserta_didik_id='$idp'")->fetch_assoc();
?>
				<div class="modal-header">
					<h5 class="modal-title">Rapor <?=$nama['nama'];?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" id="kelas" name="kelas" value="<?=$tujuan['kelas'];?>">
					<input type="hidden" class="form-control" id="smt" name="smt" value="<?=$tujuan['smt'];?>">
					<input type="hidden" class="form-control" id="mp" name="mp" value="<?=$tujuan['mapel'];?>">
					<input type="hidden" class="form-control" id="idr" name="idr" value="<?=$rowid;?>">
					<input type="hidden" class="form-control" id="idpd" name="idpd" value="<?=$tujuan['id_pd'];?>">
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Nilai</label>
                      <input type="text" class="form-control" value="<?=$nilai;?>" name="nilai">
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Kelebihan</label>
                      <textarea class="form-control" id="kelebihan" name="kelebihan" rows="4"><?=$kelebihan;?></textarea>
                    </div>
					<div class="mb-4">
                      <label class="form-label" for="example-text-input">Kelemahan</label>
					  <textarea class="form-control" id="kelemahan" name="kelemahan" rows="4"><?=$kelemahan;?></textarea>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
				</div>
				