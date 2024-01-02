var temaTable;
$(document).ready(function(){
	var jns = $('#jns').val();
	var kelas=$('#kelas').val();
	var tapel=$('#tapel').val();
	var smt=$('#smt').val();
	temaTable = $('#kt_table_users').DataTable( {
			"destroy":true,
			"dom": '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			"searching": true,
			"paging":true,
			"ajax": "modul/rapor/rekapnilai.php?tapel="+tapel+"&smt="+smt+"&kelas="+kelas+"&jns="+jns,
		} );
	
	
	$('#kelas').change(function(){
		//Mengambil value dari option select kd kemudian parameternya dikirim menggunakan ajax
		var kelas=$('#kelas').val();
		
		$.ajax({
			type : 'GET',
			url : 'modul/rapor/jnsraport.php',
			data :  'kelas=' +kelas,
			success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select mp
				$("#jns").html(data);
			}
		});
	});
	$('#jns').change(function(){
		//Mengambil value dari option select mp kemudian parameternya dikirim menggunakan ajax
		var jns = $('#jns').val();
		var kelas=$('#kelas').val();
		var tapel=$('#tapel').val();
		var smt=$('#smt').val();
			
		temaTable = $('#kt_table_users').DataTable( {
			"destroy":true,
			"dom": '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			"searching": true,
			"paging":true,
			"ajax": "modul/rapor/rekapnilai.php?tapel="+tapel+"&smt="+smt+"&kelas="+kelas+"&jns="+jns,
		} );
	});
	
	$('#caridata').on( 'keyup', function () {
		temaTable.search( this.value ).draw();
	} );
	
		$( "#cetakT" ).click(function() {
			var jns = $('#jns').val();
			var kelas=$('#kelas').val();
			var tapel=$('#tapel').val();
			var smt=$('#smt').val();
			if(kelas==0 || jns==0){
				Swal.fire("Kesalahan",'Pilih Kelas Dahulu',"error");
			}else if(jns=='k3'){
				window.open('cetak/rekapnilai.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt+'&jns='+jns,' _blank');
			}else{
				window.open('cetak/rekapnilaik.php?kelas='+kelas+'&tapel='+tapel+'&smt='+smt+'&jns='+jns,' _blank');
			};
		});
	
})

function PopupCenter(pageURL, title,w,h) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
};

	function highlightEdit(editableObj) {
		$(editableObj).css("background","#FFF0000");
	} 
	function simpankes(editableObj,column,id,bln,thn) {
		// no change change made then return false
		if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
		return false;
		// send ajax to update value
		$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
		$.ajax({
			url: "modul/kepegawaian/saveBul.php",
			cache: false,
			data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id+'&bln='+bln+'&thn='+thn,
			success: function(response)  {
				console.log(response);
				// set updated value as old value
				$(editableObj).attr('data-old_value',editableObj.innerHTML);
				$(editableObj).css("background","#FFF url(checkup.png) no-repeat right");				
			}          
	   });
	}

	
