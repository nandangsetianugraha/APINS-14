	<div class="offcanvas offcanvas-end" id="offcanvas-todo">
		<div class="offcanvas-header">
			<h3 class="offcanvas-title"><?=TanggalIndo(date('Y-m-d'));?></h3>
			<button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
				<i class="fa fa-times"></i>
			</button>
		</div>
		<div class="offcanvas-body" data-simplebar data-simplebar-direction="ltr">
			<!-- BEGIN Portlet -->
			<div class="portlet">
				<?php if($level==96 or $level==95 or $level==94 or $level==11){ ?>
				<div class="portlet-body p-0">
					<!-- BEGIN Rich List -->
					<div class="rich-list rich-list-flush rich-list-action">
						<?php if($kurikulum=='Kurikulum 2013'){ ?>
						<a href="#" onclick="GantiKurikulum(2)" class="rich-list-item">
							<div class="rich-list-prepend">
								<!-- BEGIN Avatar -->
								<div class="avatar avatar-circle">
									<div class="avatar-addon avatar-addon-top">
										<div class="avatar-icon avatar-icon-info">
											<i class="fa fa-thumbtack"></i>
										</div>
									</div>
									<div class="avatar-display">
										<img src="assets/images/avatar/blank.webp" alt="Avatar image">
									</div>
									<div class="avatar-addon avatar-addon-bottom">
										<i class="marker marker-dot text-secondary"></i>
									</div>
								</div>
								<!-- END Avatar -->
							</div>
							<div class="rich-list-content">
								<h4 class="rich-list-title">Kurikulum Merdeka</h4>
								<span class="rich-list-subtitle">Kurikulum Baru</span>
							</div>
							<div class="rich-list-append flex-column align-items-end">
								<span class="text-muted text-nowrap">1 min</span>
								<span class="badge badge-success rounded-pill">1</span>
							</div>
						</a>
						<?php }else{ ?>
						<a href="#" onclick="GantiKurikulum(1)" class="rich-list-item">
							<div class="rich-list-prepend">
								<!-- BEGIN Avatar -->
								<div class="avatar avatar-circle">
									<div class="avatar-addon avatar-addon-top">
										<div class="avatar-icon avatar-icon-info">
											<i class="fa fa-thumbtack"></i>
										</div>
									</div>
									<div class="avatar-display">
										<img src="assets/images/avatar/blank.webp" alt="Avatar image">
									</div>
									<div class="avatar-addon avatar-addon-bottom">
										<i class="marker marker-dot text-secondary"></i>
									</div>
								</div>
								<!-- END Avatar -->
							</div>
							<div class="rich-list-content">
								<h4 class="rich-list-title">Kurikulum 2013</h4>
								<span class="rich-list-subtitle">Kurikulum Lama</span>
							</div>
							
						</a>
						<?php } ?>
					</div>
					<!-- END Rich List -->
				</div>
				<?php }else{ ?>
				<?php } ?>
			</div>
			<!-- END Portlet -->
		</div>
	</div>