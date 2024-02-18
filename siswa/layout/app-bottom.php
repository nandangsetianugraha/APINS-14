
	
	<div class="appBottomMenu">
                <a href="<?=base_url();?>nilai" class="item">
                    <div class="col">
                        <ion-icon name="reader-outline"></ion-icon>
                        <strong>Nilai</strong>
                    </div>
                </a>
                <a href="<?=base_url();?>rapor" class="item">
                    <div class="col">
                        <ion-icon name="calendar-outline"></ion-icon>
                        <strong>Rapor</strong>
                    </div>
                </a>
                <a href="<?=base_url();?>" class="item">
                    <div class="col">
                        <div class="action-button large">
                            <ion-icon name="home-outline"></ion-icon>
                        </div>
                    </div>
                </a>
                <a href="<?=base_url();?>tunggakan" class="item">
                    <div class="col">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <strong>Tunggakan</strong>
                    </div>
                </a>
				<a href="<?=base_url();?>profile" class="item">
                    <div class="col">
                        <ion-icon name="people-outline"></ion-icon>
                        <strong>Profile</strong>
                    </div>
                </a>
				<!--
                <a href="javascript:;" class="item" data-toggle="modal" data-target="#sidebarPanel">
					<div class="col">
						<ion-icon name="menu-outline"></ion-icon>
					</div>
				</a>
				-->
            </div>
		<div class="modal fade dialogbox" id="DialogIconedButtonInline" data-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keluar</h5>
                    </div>
                    <div class="modal-body">
                        Yakin Anda Keluar dari Aplikasi?
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="<?=base_url();?>logout.php" class="btn btn-text-danger">
                                <ion-icon name="trash-outline"></ion-icon>
                                Keluar
                            </a>
                            <a href="#" class="btn btn-text-primary" data-dismiss="modal">
                                <ion-icon name="share-outline"></ion-icon>
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>