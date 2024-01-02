<?php
require_once '../../config/db_connect.php';function rupiah($angka){		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');	return $hasil_rupiah; }
$idinv=$_POST['idinv'];$sql = "select * from pengumuman where id='$idinv'";$query = $connect->query($sql);$s=$query->fetch_assoc();
?>				<div class="modal-header">					<h5 class="modal-title"><?=$s['judul'];?></h5>					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>				</div>				<div class="modal-body">					<?=$s['berita'];?>														</div>				<div class="modal-footer">					<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>				</div>
												