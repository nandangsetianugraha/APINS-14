<?php 
include "../config/config.php";
include "../config/db_connect.php";
$idr=$_POST['rowid'];
$s=$connect->query("SELECT * FROM raport_ikm WHERE id_raport='$idr'")->fetch_assoc();
$data = explode("|" , $s['deskripsi']);
$kelebihan=$data[0];
$kelemahan=$data[1];
?>
					<div class="modal-header">
                        <h5 class="modal-title">Deskripsi</h5>
                    </div>
                    <div class="modal-body" style="text-align:left">
                        <h4>Kelebihan</h4>
						<p><?=$kelebihan;?></p>
						<h4>Kelemahan</h4>
						<p><?=$kelemahan;?></p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>