<?php $data="Nilai Ujian Sekolah";?>
<?php include "layout/head.php"; ?>

</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<?php include "layout/aside.php";?>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Header -->
			<?php include "layout/header.php";?>
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row">
						<div class="col-12">
							<!-- BEGIN Portlet -->
							
							<div class="portlet" id="status">
								<div class="portlet-header portlet-header-bordered">
									<?php if($level==11){ ?>
									<form class="row g-3" action="<?=base_url();?>pages/impor.php" method="post"
											name="frmExcelImport" id="frmExcelImport"
											enctype="multipart/form-data" onsubmit="return validateFile()">
										<div class="col-md-6">
											<input type="file" name="file" id="file" class="file"
														accept=".xls,.xlsx">
										</div>
										<div class="col-md-3">
											<select id="tapel" name="tapel" class="form-select">
												<option value="0">Pilih Tapel</option>
                                                <?php 
													$sql4 = "select * from tapel order by nama_tapel asc";
													$query4 = $connect->query($sql4);
													$ak=0;
													while($nk=$query4->fetch_assoc()){
														if($tapel==$nk['nama_tapel']){
															$stt="selected";
														}else{
															$stt='';
														};
														echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
													}	
												?>												
											</select>
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary" type="submit" id="submit" name="import">Impor Data</button>
										</div>
										
									</form>
									
                                    <?php }else{ ?>
									<form class="row g-3">
									<div class="col-lg-12">
									<select id="tapel" name="tapel" class="form-select">
												<option value="0">Pilih Tapel</option>
                                                <?php 
													$sql4 = "select * from tapel order by nama_tapel asc";
													$query4 = $connect->query($sql4);
													$ak=0;
													while($nk=$query4->fetch_assoc()){
														if($tapel==$nk['nama_tapel']){
															$stt="selected";
														}else{
															$stt='';
														};
														echo '<option value="'.$nk['nama_tapel'].'" '.$stt.'>'.$nk['nama_tapel'].'</option>';
													}	
												?>												
											</select>
											</div>
											</form>
									<?php } ?>
									<div class="portlet-addon">
                                        
                                    </div>
									<input type="hidden" name="smt" id="smt" class="form-control" value="<?=$smt;?>" placeholder="Username">
								</div>
								<div class="portlet-body">
                                    
									<!-- BEGIN Datatable -->
									<table id="datatable-1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>Nama</th>
												<?php 
												$ckkur=$connect->query("select * from rombel where nama_rombel like '%6%' and tapel='$tapel' and smt='$smt'")->fetch_assoc();
												if($ckkur['kurikulum']=='Kurikulum 2013' or $ckkur['kurikulum']=='KTSP'){
													$sql4 = "select * from mapel order by id_mapel asc";
												}else{
													$sql4 = "select * from mata_pelajaran order by id_mapel asc";
												};
												$query4 = $connect->query($sql4);
												while($nk=$query4->fetch_assoc()){
												?>
												<th><?=$nk['kd_mapel'];?></th>
												<?php } ?>
											</tr>
										</thead>
									</table>
									<!-- END Datatable -->
								</div>
							</div>
							
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<?php include "layout/footer.php";?>
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Modal -->
	<div class="modal fade" id="info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/ujian/tambah-us.php" autocomplete="off" method="POST" id="simpanUS">
				<div class="fetched-data"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" action="modul/administrasi/update-tujuan.php" autocomplete="off" method="POST" id="ubahproyek">
				<div class="fetched-data1"></div>
				</form>
			</div>
		</div>
	</div>
	<!-- END Modal -->
	<?php include "layout/offcanvas-todo.php"; ?>
	<?php include "layout/script.php"; ?>
	<script>
	var TabelRombel;
	$(document).ready(function(){
		var smt=$('#smt').val();
		var tapel=$('#tapel').val();
		TabelRombel = $("#datatable-1").DataTable({ 
			"destroy":true,
			"searching": true,
			"paging":true,
			"responsive":true,
			"ajax": "modul/ujian/nilai-us.php?tapel="+tapel+"&smt="+smt
		});
		$('#caridata').on( 'keyup', function () {
			TabelRombel.search( this.value ).draw();
		} );
		$('#info').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('pdid');
			var rowsmt = $(e.relatedTarget).data('smt');
			var rowtapel = $(e.relatedTarget).data('tapel');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'modul/ujian/m_us.php',
				data :  'rowid='+ rowid +'&smt='+rowsmt+'&tapel='+rowtapel,
				beforeSend: function()
						{	
							$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
						},
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
				$('#status').unblock();
                }
            });
         });
        $('#tapel').change(function(){
				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
			var smt=$('#smt').val();
		    var tapel=$('#tapel').val();
			TabelRombel = $("#datatable-1").DataTable({ 
                "destroy":true,
                "searching": true,
                "paging":true,
                "responsive":true,
                "ajax": "modul/ujian/nilai-us.php?tapel="+tapel+"&smt="+smt
            });
		});
		$("#simpanUS").unbind('submit').bind('submit', function() {
			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				beforeSend: function()
				{	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						TabelRombel.ajax.reload(null, false);
						$("#info").modal('hide');
					} else {
						toastr.error(response.messages);
					}
				} // /success
			}); // /ajax
			return false;
		});
		
	});	
		
	
	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function saveUS(editableObj,column,tapel,id,kurikulum,mpid) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "modul/ujian/saveUS.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&tapel='+tapel+'&mp='+mpid+'&kur='+kurikulum,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FFF url(checkup.png) no-repeat right");
				
			}          
	   });
	}
		
	</script>
</body>
</html>
