$(document).ready(function () {
    "use strict";
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
    $("#submit").click(function () {

        var username = $("#username").val(), password = $("#password").val(), tapel = $("#tapel").val(), smt = $("#smt").val();
		
        if ((username === "") || (password === "")) {
			toastr["error"]("Username atau Password tidak boleh kosong!!")
        } else {
            $.ajax({
                type: "POST",
                url: "pages/checklogin.php",
                data: "username=" + username + "&password=" + password + "&tapel=" + tapel + "&smt=" + smt,
                dataType: 'JSON',
				beforeSend: function()
                {	
                    $('#log-in').block({ 
					message: '<div class="d-flex justify-content-center"><p class="mb-0">Please wait...</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
					css: {
					  backgroundColor: 'transparent',
					  color: '#fff',
					  border: '0'
					},
					overlayCSS: {
					  opacity: 0.5
					}
					});
					//$('#log-in').block();
                },
				success: function (html) {
                  	$("#loading").hide();
					$(".loader").hide();
                    if (html.success === true) {
						toastr["success"]("Login Sukses <br/> Tunggu sebentar.... Anda akan dialihkan ke Halaman Admin");
						$("#statusnya").html('<h4 class="mb-2">Login Sukses ✉️</h4><p class="text-start">Login berhasil... Anda akan dialihkan ke Halaman Utama.</p><a class="btn btn-primary w-100 my-3" href="./"> Beranda </a>');
						setTimeout(function () {
							location.reload();
						},1500);
						$('#log-in').unblock();
					} else {
						toastr["error"](html.messages);
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