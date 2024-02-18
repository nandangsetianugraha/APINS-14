	<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">

                    <!-- profile box -->
                    <div class="profileBox">
                        <div class="image-wrapper">
                            <img src="<?=base_url();?>images/siswa/<?=$avatar;?>" alt="image" class="imaged rounded">
                        </div>
                        <div class="in">
                            <strong><?=$bioku['nama'];?></strong>
                            <div class="text-muted">
                                <ion-icon name="location"></ion-icon>
                                <?=$bioku['nis'];?> / <?=$bioku['nisn'];?>
                            </div>
                        </div>
                        <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->

                    <ul class="listview flush transparent no-line image-listview mt-2">
                        <li>
                            <a href="<?=base_url();?>siswa/" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Beranda
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>siswa/nilai" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="cube-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Nilai
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>siswa/rapor" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="layers-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Rapor
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>siswa/tunggakan" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Tunggakan
                                </div>
                            </a>
                        </li>
						<li>
                            <a href="<?=base_url();?>siswa/tabungan" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="cash-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Tabungan
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="listview-title mt-2 mb-1">
                        <span>Setting</span>
                    </div>
					<ul class="listview flush transparent no-line image-listview mt-2">
						<li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="moon-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Mode Gelap</div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input dark-mode-switch"
                                            id="darkmodesidebar">
                                        <label class="custom-control-label" for="darkmodesidebar"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
					</ul>
                    

                </div>

                <!-- sidebar buttons -->
                <div class="sidebar-buttons">
                    <a href="javascript:;" class="button">
                        <ion-icon name="person-outline"></ion-icon>
                    </a>
                    <a href="javascript:;" class="button">
                        <ion-icon name="archive-outline"></ion-icon>
                    </a>
                    <a href="javascript:;" class="button">
                        <ion-icon name="settings-outline"></ion-icon>
                    </a>
                    <a href="javascript:;" data-toggle="modal" data-target="#DialogIconedButtonInline" class="button">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </a>
                </div>
                <!-- * sidebar buttons -->
            </div>
        </div>
    </div>
    