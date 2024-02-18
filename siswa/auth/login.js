$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {

        var username = $("#username").val(), password = $("#password").val();
		
        if ((username === "") || (password === "")) {
			notification('notification-error', 2000);
        } else {
            $.ajax({
                type: "POST",
                url: "checklogin.php",
                data: "username=" + username + "&password=" + password,
                dataType: 'JSON',
				beforeSend: function()
                {	
                    $("#loading").show();
                    $(".loader").show();
                },
				success: function (html) {
                  	$("#loading").hide();
					$(".loader").hide();
                    if (html.response === 'true') {
						notification('notification-welcome', 2000);
						
						setTimeout(function () {
							location.href="../";
						},2000);
						return html.username;
                    } else {
						$("#pesan").html(html.response);
						notification('notification-errors', 2000);
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