	<script type="text/javascript" src="<?=base_url();?>assets/build/scripts/mandatory.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/build/scripts/core.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/build/scripts/vendor.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/sticky-header.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/copyright-year.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/theme-switcher.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/tooltip-popover.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/dropdown-scrollbar.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/app/utilities/fullscreen-trigger.js"></script>
	<script>
    
      function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
      function getActualFullDate() {
    var d = new Date();
    var day = addZero(d.getDate());
    var month = addZero(d.getMonth()+1);
    var year = addZero(d.getFullYear());
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    var s = addZero(d.getSeconds());
    return day + ". " + month + ". " + year + " (" + h + ":" + m + ":"+s+")";
}
      
		function keluar(id = null) {
			if(id) {
				// click on remove button
				
				Swal.fire({
				  title: 'Yakin Keluar Sistem?',
				  text: "Apakah Anda yakin untuk Keluar Sistem?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, keluar!'
				}).then((result) => {
				  if (result.isConfirmed) {
					setTimeout(function () {
						location.href="<?=base_url();?>pages/logout.php";
					},500);
				  }
				})
				
			} else {
				Swal.fire("Kesalahan","Error Sistem","error");
			}
		}
		function GantiKurikulum(id = null) {
			if(id) {
				// click on remove button
				
				Swal.fire({
				  title: 'Ganti Kurikulum?',
				  text: "Apakah Anda yakin untuk Mengganti Kurikulum?",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Ya, ganti!'
				}).then((result) => {
				  if (result.isConfirmed) {
					setTimeout(function () {
						location.href="<?=base_url();?>layout/change.php?kur="+id;
					},500);
				  }
				})
				
			} else {
				Swal.fire("Kesalahan","Error Sistem","error");
			}
		}
	</script>