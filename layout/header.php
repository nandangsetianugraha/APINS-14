			<?php if ($smt==1){ $semes='Ganjil';}else{$semes='Genap';}; ?>
			<div class="header">
				<!-- BEGIN Desktop Sticky Header -->
				<div class="sticky-header" id="sticky-header-desktop">
					<!-- BEGIN Header Holder -->
					<div class="header-holder header-holder-desktop">
						<div class="header-container container-fluid g-5">
							<div class="header-wrap header-wrap-block justify-content-start">
								<!-- BEGIN Dropdown -->
								
								<div class="dropdown d-inline">
									<button class="btn btn-flat-primary btn-wider ms-2" data-bs-toggle="dropdown"><?=$tapel;?> | <?=$semes;?></button>
									
								</div>
								<!-- END Dropdown -->
							</div>
							<div class="header-wrap hstack gap-2">
								<button class="btn btn-flat-primary" <?php if($level==96 or $level==95 or $level==94 or $level==11){ if($kurikulum=='Kurikulum 2013'){?>onclick="GantiKurikulum(2)"<?php }else{ ?>onclick="GantiKurikulum(1)"<?php }} ?> >
									<?=$kurikulum;?>
								</button>
								<!-- BEGIN Dropdown -->
								<div class="dropdown">
									<?php 
									$pisah = explode(' ',$bioku['nama']);
									?>
									<button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
										<div class="widget13-text"> Hi <strong><?=$pisah[0];?></strong>
										</div>
										<!-- BEGIN Avatar -->
										<div class="avatar avatar-info widget13-avatar">
											<div class="avatar-display">
												<div id="uploaded_image3"><img src="<?=base_url();?>images/ptk/<?=$avatar;?>" alt="AI"></div>
											</div>
										</div>
										<!-- END Avatar -->
									</button>
									<div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
										<!-- BEGIN Portlet -->
										<div class="portlet border-0">
											<div class="portlet-header bg-primary rounded-0">
												<!-- BEGIN Rich List Item -->
												<div class="rich-list-item w-100 p-0">
													<div class="rich-list-prepend">
														<!-- BEGIN Avatar -->
														<div class="avatar avatar-label-light avatar-circle">
															<div class="avatar-display">
																<div id="uploaded_image4">
																<img src="<?=base_url();?>images/ptk/<?=$avatar;?>" alt="AI"></div>
															</div>
														</div>
														<!-- END Avatar -->
													</div>
													<div class="rich-list-content">
														<h3 class="rich-list-title text-white"><?=$bioku['nama'];?></h3>
														<span class="rich-list-subtitle text-white"><?=$bioku['email'];?></span>
													</div>
													<div class="rich-list-append">
														<span class="badge badge-label-light fs-6">9+</span>
													</div>
												</div>
												<!-- END Rich List Item -->
											</div>
											<div class="portlet-body p-0">
												<!-- BEGIN Grid Nav -->
												<div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
													<div class="grid-nav-row">
														<a href="<?=base_url();?>profil" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-address-card"></i>
															</div>
															<span class="grid-nav-content">Profile</span>
														</a>
													</div>
												</div>
												<!-- END Grid Nav -->
											</div>
											<div class="portlet-footer portlet-footer-bordered rounded-0">
												<button class="btn btn-label-danger" onclick="keluar(1)">Keluar</button>
											</div>
										</div>
										<!-- END Portlet -->
									</div>
								</div>
								<!-- END Dropdown -->
							</div>
						</div>
					</div>
					<!-- END Header Holder -->
				</div>
				<!-- END Desktop Sticky Header -->
				<!-- BEGIN Header Holder -->
				<div class="header-holder header-holder-desktop">
					<div class="header-container container-fluid g-5">
						<h4 class="header-title"><?=$data;?></h4>
						<i class="header-divider"></i>
						<div class="header-wrap header-wrap-block justify-content-start">
							<!-- BEGIN Breadcrumb -->
							<div class="breadcrumb breadcrumb-transparent mb-0">
								<a href="./" class="breadcrumb-item">
									<div class="breadcrumb-icon">
										<i data-feather="home"></i>
									</div>
									<span class="breadcrumb-text"><?=$data;?></span>
								</a>
							</div>
							<!-- END Breadcrumb -->
						</div>
						<div class="header-wrap">
							<!-- BEGIN Button Group -->
                          	<span id="waktu"></span>
							<!-- END Button Group -->
							<button class="btn btn-label-info btn-icon" id="fullscreen-trigger" data-bs-toggle="tooltip" title="Toggle fullscreen" data-bs-placement="left">
								<i class="fa fa-expand fullscreen-icon-expand"></i>
								<i class="fa fa-compress fullscreen-icon-compress"></i>
							</button>
						</div>
					</div>
				</div>
				<!-- END Header Holder -->
				<!-- BEGIN Mobile Sticky Header -->
				<div class="sticky-header" id="sticky-header-mobile">
					<!-- BEGIN Header Holder -->
					<div class="header-holder header-holder-mobile">
						<div class="header-container container-fluid g-5">
							<div class="header-wrap">
								<button class="btn btn-flat-primary btn-icon" data-toggle="aside">
									<i class="fa fa-bars"></i>
								</button>
							</div>
							<div class="header-wrap header-wrap-block justify-content-start px-3">
								<h4 class="header-brand">
									<div class="avatar">
										<div class="avatar-display" id="uploaded_image2">
											<img src="<?=base_url();?>assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
										</div>
									</div>
									APINS
								</h4>
							</div>
							<div class="header-wrap hstack gap-2">
								<button class="btn btn-flat-primary" <?php if($level==96 or $level==95 or $level==94 or $level==11){ if($kurikulum=='Kurikulum 2013'){?>onclick="GantiKurikulum(2)"<?php }else{ ?>onclick="GantiKurikulum(1)"<?php }} ?>>
									<?=$kurikulum;?>
								</button>
								<!-- BEGIN Dropdown -->
								<div class="dropdown">
									<button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
										<!-- BEGIN Avatar -->
										<div class="avatar avatar-info widget13-avatar">
											<div class="avatar-display">
												<div id="uploaded_image5"><img src="<?=base_url();?>images/ptk/<?=$avatar;?>" alt="AI"></div>
											</div>
										</div>
										<!-- END Avatar -->
									</button>
									<div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
										<!-- BEGIN Portlet -->
										<div class="portlet border-0">
											<div class="portlet-header bg-primary rounded-0">
												<!-- BEGIN Rich List Item -->
												<div class="rich-list-item w-100 p-0">
													<div class="rich-list-prepend">
														<!-- BEGIN Avatar -->
														<div class="avatar avatar-label-light avatar-circle">
															<div class="avatar-display">
																<div id="uploaded_image6"><img src="<?=base_url();?>images/ptk/<?=$avatar;?>" alt="AI"></div>
															</div>
														</div>
														<!-- END Avatar -->
													</div>
													<div class="rich-list-content">
														<h3 class="rich-list-title text-white"><?=$bioku['nama'];?></h3>
														<span class="rich-list-subtitle text-white"><?=$bioku['email'];?></span>
													</div>
													<div class="rich-list-append">
														<span class="badge badge-label-light fs-6">9+</span>
													</div>
												</div>
												<!-- END Rich List Item -->
											</div>
											<div class="portlet-body p-0">
												<!-- BEGIN Grid Nav -->
												<div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
													<div class="grid-nav-row">
														<a href="<?=base_url();?>profil" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-address-card"></i>
															</div>
															<span class="grid-nav-content">Profile</span>
														</a>
														
													</div>
													
												</div>
												<!-- END Grid Nav -->
											</div>
											<div class="portlet-footer portlet-footer-bordered rounded-0">
												<button class="btn btn-label-danger" onclick="keluar(1)">Keluar</button>
											</div>
										</div>
										<!-- END Portlet -->
									</div>
								</div>
								<!-- END Dropdown -->
							</div>
						</div>
					</div>
					<!-- END Header Holder -->
				</div>
				<!-- END Mobile Sticky Header -->
				<!-- BEGIN Header Holder -->
				<div class="header-holder header-holder-mobile">
					<div class="header-container container-fluid g-5">
						<div class="header-wrap header-wrap-block justify-content-start w-100">
							<!-- BEGIN Breadcrumb -->
							<div class="breadcrumb breadcrumb-transparent mb-0">
								<a href="" class="breadcrumb-item">
									<div class="breadcrumb-icon">
										<i data-feather="home"></i>
									</div>
									<span class="breadcrumb-text"><?=$data;?></span>
								</a>
							</div>
							<!-- END Breadcrumb -->
						</div>
					</div>
				</div>
				<!-- END Header Holder -->
			</div>
			