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
									<?php if($level==11) { ?>
									<div class="dropdown-menu dropdown-menu-start dropdown-menu-wide dropdown-menu-animated overflow-hidden">
										<div class="dropdown-row">
											<!-- BEGIN Dropdown Column -->
											<div class="dropdown-col">
												<h4 class="dropdown-header">Kepegawaian</h4>
												<!-- BEGIN Grid Nav -->
												<div class="grid-nav grid-nav-action">
													<div class="grid-nav-row">
														<a href="<?=base_url();?>absensi-pegawai" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-window-restore"></i>
															</div>
															<span class="grid-nav-content">Absensi Pegawai</span>
														</a>
														<a href="<?=base_url();?>hari-libur" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-clipboard"></i>
															</div>
															<span class="grid-nav-content">Hari Libur</span>
														</a>
														<a href="<?=base_url();?>sistem-gaji" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-question-circle"></i>
															</div>
															<span class="grid-nav-content">Sistem Gaji</span>
														</a>
														<a href="<?=base_url();?>shift-kerja" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-question-circle"></i>
															</div>
															<span class="grid-nav-content">Shift Kerja</span>
														</a>
													</div>
													<div class="grid-nav-row">
														<a href="<?=base_url();?>daftar-pengguna" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-images"></i>
															</div>
															<span class="grid-nav-content">Daftar Pengguna</span>
														</a>
														<a href="<?=base_url();?>pegawai-id" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-chart-bar"></i>
															</div>
															<span class="grid-nav-content">ID Pegawai</span>
														</a>
														<a href="<?=base_url();?>daftar-ptk" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-bookmark"></i>
															</div>
															<span class="grid-nav-content">Daftar PTK</span>
														</a>
														<a href="<?=base_url();?>gaji-bulanan" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-bookmark"></i>
															</div>
															<span class="grid-nav-content">Gaji Bulanan</span>
														</a>
													</div>
												</div>
												<!-- END Grid Nav -->
											</div>
											<!-- END Dropdown Column -->
										</div>
									</div>
									<?php } ?>
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
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-comments"></i>
															</div>
															<span class="grid-nav-content">Messages</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-clone"></i>
															</div>
															<span class="grid-nav-content">Activities</span>
														</a>
													</div>
													<div class="grid-nav-row">
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-calendar-check"></i>
															</div>
															<span class="grid-nav-content">Tasks</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-sticky-note"></i>
															</div>
															<span class="grid-nav-content">Notes</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-bell"></i>
															</div>
															<span class="grid-nav-content">Notification</span>
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
											<img src="<?=base_url();?>assets/images/aljannah.png" alt="Avatar image">
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
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-comments"></i>
															</div>
															<span class="grid-nav-content">Messages</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-clone"></i>
															</div>
															<span class="grid-nav-content">Activities</span>
														</a>
													</div>
													<div class="grid-nav-row">
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-calendar-check"></i>
															</div>
															<span class="grid-nav-content">Tasks</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-sticky-note"></i>
															</div>
															<span class="grid-nav-content">Notes</span>
														</a>
														<a href="#" class="grid-nav-item">
															<div class="grid-nav-icon">
																<i class="far fa-bell"></i>
															</div>
															<span class="grid-nav-content">Notification</span>
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
			