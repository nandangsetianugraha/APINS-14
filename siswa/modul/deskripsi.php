<?php 
include "../config/config.php";
include "../config/db_connect.php";
$idr=$_POST['rowid'];
$jns=$_POST['jns'];
if($jns=='k3'){
	$jenis="Pengetahuan";
}else{
	$jenis="Ketrampilan";
};
$s=$connect->query("SELECT * FROM raport_k13 WHERE id_raport='$idr'")->fetch_assoc();
?>
					<div class="modal-icon text-success">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>					
					<div class="modal-header">
                        <h5 class="modal-title"><?=$jenis;?></h5>
                    </div>
                    <div class="modal-body" style="text-align:left">
                        <?=$s['deskripsi'];?>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>