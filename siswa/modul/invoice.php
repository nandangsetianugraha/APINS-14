<?php 
include "../config/config.php";
include "../config/db_connect.php";
$idr=$_POST['rowid'];
$sql = "select * from pembayaran where id_invoice='$idr'";
$query = $connect->query($sql);
?>
					<div class="modal-header">
                        <h5 class="modal-title">Invoice</h5>
                    </div>
                    <div class="modal-body" style="text-align:left">
						<div class="timeline timed">
						<?php
						while($s=$query->fetch_assoc()) {								
						?>
						<div class="item">
							<span class="time"><?=$s['tanggal'];?></span>
							<div class="dot bg-info"></div>
							<div class="content">
								<h4 class="title"><?=$s['deskripsi'];?></h4>
								<div class="text"><?=rupiah($s['bayar']);?></div>
							</div>
						</div>
						
						<?php } ?>
						</div>
                        
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-info" data-dismiss="modal">
                                <ion-icon name="print-outline"></ion-icon>
                                Cetak
                            </a>
                            <a href="#" class="btn btn-text-primary" data-dismiss="modal">
                                <ion-icon name="share-outline"></ion-icon>
                                Tutup
                            </a>
                        </div>
                    </div>