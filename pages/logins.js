$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {

        var username = $("#username").val(), password = $("#password").val(), tapel = $("#tapel").val(), smt = $("#smt").val();
		
        if ((username === "") || (password === "")) {
			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": false,
			  "positionClass": "toast-top-full-width",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": "4000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			toastr["error"]("Username atau Password tidak boleh kosong!!")
        } else {
            $.ajax({
                type: "POST",
                url: "pages/checklogin.php",
                data: "username=" + username + "&password=" + password + "&tapel=" + tapel + "&smt=" + smt,
                dataType: 'JSON',
				beforeSend: function()
                {	
                    $('#log-in').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
					//$('#log-in').block();
                },
				success: function (html) {
                  	$("#loading").hide();
					$(".loader").hide();
                    if (html.response === 'true') {
                        $('#ckc').html('<h2>Autentifikasi Berhasil</h2><p>Menunggu mengarahkan ke halaman utama</p>');
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
						$('#log-in').unblock();
						return html.username;
                    } else {
						toastr.options = {
						  "closeButton": true,
						  "debug": false,
						  "newestOnTop": false,
						  "progressBar": false,
						  "positionClass": "toast-top-full-width",
						  "preventDuplicates": false,
						  "onclick": null,
						  "showDuration": "300",
						  "hideDuration": "1000",
						  "timeOut": "4000",
						  "extendedTimeOut": "1000",
						  "showEasing": "swing",
						  "hideEasing": "linear",
						  "showMethod": "fadeIn",
						  "hideMethod": "fadeOut"
						}
						toastr["error"](html.response);
						$('#log-in').unblock();
						//$("#pesan").html(html.response);
						//liveToast1.show();
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
        return false;
    });
});