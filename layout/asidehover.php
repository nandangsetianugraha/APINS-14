		<div class="aside aside-hover">
			<div class="aside-header">
				<h3 class="aside-title">
					<div class="avatar">
						<div class="avatar-display" id="uploaded_image2">
							<img src="<?=base_url();?>assets/<?=$cfgs['image_login'];?>" alt="Avatar image">
						</div>
					</div>
					APINS
				</h3>
				<div class="aside-addon">
					<button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
						<i class="fa fa-times aside-icon-minimize"></i>
						<i class="fa fa-thumbtack aside-icon-maximize"></i>
					</button>
				</div>
			</div>
			<div class="aside-body" data-simplebar data-simplebar-direction="ltr">
				<!-- BEGIN Menu -->
				<div class="menu">
					<div class="menu-item">
						<a href="<?=base_url();?>" data-menu-path="<?=base_url();?>" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-desktop"></i>
							</div>
							<span class="menu-item-text">Beranda</span>
							<div class="menu-item-addon">
								<span class="badge badge-success">New</span>
							</div>
						</a>
					</div>
                  	
                    <div class="menu-item">
                          <a href="<?=base_url();?>upload-dokumen" data-menu-path="<?=base_url();?>" class="menu-item-link">
                              <div class="menu-item-icon">
                                  <i class="fa-solid fa-folder-open"></i>
                              </div>
                              <span class="menu-item-text">Dokumen</span>
                          </a>
                    </div>
					<?php if($level==11) { ?>
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Administrator</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-palette"></i>
							</div>
							<span class="menu-item-text">Artikel</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>daftar-artikel" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Artikel</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>tambah-artikel" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Tambah Artikel</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
                      	
					</div>
                  	<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-calendar"></i>
							</div>
							<span class="menu-item-text">Setting</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>berita-acara" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Berita Acara</span>
								</a>
							</div>
                          	<div class="menu-item">
								<a href="<?=base_url();?>kalendar-pendidikan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kalendar Pendidikan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>tahun-ajaran" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Tahun Ajaran</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>setting-rombel" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Setting Rombel</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
                      	
					</div>
					<?php } ?>
					<?php if($level==11 or $level==98 or $level==97) { ?>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Data Sekolah</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-palette"></i>
							</div>
							<span class="menu-item-text">Daftar Siswa</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<?php if($level==11){ ?>
							<div class="menu-item">
								<a href="<?=base_url();?>tambah-siswa" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Tambah Siswa Baru</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>penempatan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Penempatan Siswa</span>
								</a>
							</div>
							<?php } ?>
							<div class="menu-item">
								<a href="<?=base_url();?>rombel" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Rombel</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>whatsapp" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Nomor Whatsapp</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>absensi" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Absensi</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-adjust"></i>
							</div>
							<span class="menu-item-text">Data Isian Semester</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>kesehatan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kesehatan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>prestasi" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Prestasi</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>ekstrakurikuler" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Ekstrakurikuler</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>saran-dan-pesan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Saran dan Pesan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>data-absensi" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Absensi</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php } ?>
					<?php if($kurikulum=="Kurikulum 2013"){ ?>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Kurikulum 2013</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-clone"></i>
							</div>
							<span class="menu-item-text">Administrasi Kurikulum</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
                          	<?php if($level==11 or $level==98 or $level==97) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>tema" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Tema</span>
								</a>
							</div>
                          	<?php } ?>
							<div class="menu-item">
								<a href="<?=base_url();?>kompetensi-dasar" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kompetensi Dasar</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>pemetaan-kd" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Pemetaan KD</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>kkm" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">KKM</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php if($level==11 or $level==98 or $level==97 or $level==96) { ?>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-address-card"></i>
							</div>
							<span class="menu-item-text">Penilaian Sikap</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<?php if($level==11 or $level==96) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>penilaian-spiritual" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Spiritual</span>
								</a>
							</div>
							<?php } ?>
							<?php if($level==11 or $level==98 or $level==97) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>penilaian-sosial" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Sosial</span>
								</a>
							</div>
							<?php } ?>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php } ?>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-newspaper"></i>
							</div>
							<span class="menu-item-text">Penilaian Harian</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>pengetahuan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Pengetahuan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>ketrampilan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Ketrampilan</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-sticky-note"></i>
							</div>
							<span class="menu-item-text">Penilaian Semester</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>penilaian-tengah-semester" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Penilaian Tengah Semester</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>penilaian-akhir-semester" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Penilaian Akhir Semester</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Rapor</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-unlock-alt"></i>
							</div>
							<span class="menu-item-text">Generate Rapor</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<?php if($level==11 or $level==96) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>rapor-spiritual" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Spiritual</span>
								</a>
							</div>
							<?php } ?>
							<?php if($level==11 or $level==98 or $level==97) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>rapor-sosial" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Sosial</span>
								</a>
							</div>
							<?php } ?>
							<div class="menu-item">
								<a href="<?=base_url();?>rapor-pengetahuan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Pengetahuan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>rapor-ketrampilan" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Ketrampilan</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php if($level==11 or $level==98 or $level==97) { ?>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-user-plus"></i>
							</div>
							<span class="menu-item-text">Cetak Rapor</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>cetak-rapor" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Cetak Rapor</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>rekap-rapor" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Rekap Rapor</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php } ?>
					<?php }elseif($kurikulum=="Kurikulum Merdeka"){ ?>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Kurikulum Merdeka</h2>
					</div>
					<!-- END Menu Section -->
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-sticky-note"></i>
							</div>
							<span class="menu-item-text">Administrasi Kurikulum</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>lingkup-materi" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Lingkup Materi</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>tujuan-pembelajaran" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Tujuan Pembelajaran</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-newspaper"></i>
							</div>
							<span class="menu-item-text">Penilaian Harian</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>formatif" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Formatif</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>sumatif" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Sumatif</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-list-alt"></i>
							</div>
							<span class="menu-item-text">Penilaian Semester</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>sumatif-tengah-semester" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Sumatif Tengah Semester</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>sumatif-akhir-semester" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Sumatif Akhir Semester</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Rapor</h2>
					</div>
					<!-- END Menu Section -->
					<?php if($level==11 or $level==98 or $level==97) { ?>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-unlock-alt"></i>
							</div>
							<span class="menu-item-text">Rapor P5</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>input-proyek" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Input Proyek</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>pemetaan-proyek" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Pemetaan Proyek</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>penilaian-proyek" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Penilaian Proyek</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>cetak-rapor-p5" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Cetak Rapor P5</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<?php } ?>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-user-plus"></i>
							</div>
							<span class="menu-item-text">Rapor Intrakurikuler</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?=base_url();?>generate-rapor" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Generate</span>
								</a>
							</div>
							<?php if($level==11 or $level==98 or $level==97) { ?>
							<div class="menu-item">
								<a href="<?=base_url();?>cetak-rapor-ikm" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Cetak Rapor</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?=base_url();?>rekap-rapor-ikm" data-menu-path="<?=base_url();?>" class="menu-item-link">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Rekap Rapor</span>
								</a>
							</div>
							<?php } ?>
						</div>
						<!-- END Menu Submenu -->
					</div>
					
					<?php }else{ ?>
					<?php } ?>
				</div>
				<!-- END Menu -->
			</div>
		</div>
		