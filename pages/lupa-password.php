<?php $data="Lupa Password";?>
<?php include "layout/head.php"; ?>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <style>
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.container {
  background: #fff;
  padding: 30px 65px;
  border-radius: 12px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.container header {
  height: 65px;
  width: 65px;
  background: #4070f4;
  color: #fff;
  font-size: 2.5rem;
  border-radius: 50%;
}
.container h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
  pointer-events: none;
  background: #6e93f7;
  transition: all 0.2s ease;
}
form button.active {
  background: #4070f4;
  pointer-events: auto;
}
form button:hover {
  background: #0e4bf1;
}

   </style>
</head>
<body class="preload-active">
	<!-- BEGIN Preload -->
	<?php include "layout/loader.php"; ?>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper ">
			<!-- BEGIN Page Content -->
			<div class="content">
				<div class="container-fluid g-5">
					<div class="row g-0 align-items-center justify-content-center h-100">
						<div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
							<!-- BEGIN Portlet -->
							
									
									<!-- BEGIN Form -->
										<!-- BEGIN Validation Container -->
										
										<!-- END Validation Container -->
										<!-- BEGIN Validation Container -->
										<div class="container" id="status">
										  <header>
											<i class="bx bxs-check-shield"></i>
										  </header>
										  <div id="hp_section">
											<h4>Enter Handphone</h4>
											<form action="<?=base_url();?>modul/kepegawaian/login_ajax.php" autocomplete="off" method="POST" id="sendotp">
											<div class="input-group mb-2">
												<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone-flip"></i></span>
												<input class="form-control form-control-lg" type="text" autocomplete="off" name="phone" id="phone" placeholder="No Handphone" required>
												<input type="hidden" name="type" id="type" class="form-control" value="2">
											</div>
                                            <button type="submit" name="btn-save" id="continue" class="btn btn-primary active"><i data-feather="eye" class="me-2"></i> Kirim OTP</button>
                                            
                                            
											
											</form>
										  </div>
										  <div id="otp_section" style="display:none">
										  <h4>Enter OTP Code</h4>
										  
										  <form action="<?=base_url();?>modul/kepegawaian/login_ajax.php" autocomplete="off" method="POST" id="verifyotp">
										  <input type="hidden" name="type" id="type" class="form-control" value="3">
										  <input type="hidden" name="phone" id="phone" class="form-control" value="<?=$_SESSION['handphone'];?>">
											<div class="input-field">
											  <input name="otp1" type="number" />
											  <input name="otp2" type="number" disabled />
											  <input name="otp3" type="number" disabled />
											  <input name="otp4" type="number" disabled />
											  <input name="otp5" type="number" disabled />
											  <input name="otp6" type="number" disabled />
											</div>
											<button class="active" type="submit" id="login">Verify OTP</button>
										  </form>
										  </div>
										  <div class="d-flex align-items-center justify-content-between">
											<span>Login? <a href="<?=base_url();?>">Kembali</a></span>
											
										</div>

										 
										  
										</div>
										
										<!-- END Validation Container -->
										<!-- BEGIN Flex -->
										<!-- END Flex -->
										<!-- BEGIN Flex -->
										
										<!-- END Flex -->
									<!-- END Form -->
							
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<?php include "layout/script.php"; ?>
	<script type="text/javascript" src="<?=base_url();?>assets/app/pages/pages/login.js"></script>
<script>
toastr.options = {
			"closeButton": false,
			"debug": true,
			"newestOnTop": true,
			"progressBar": false,
			"positionClass": "toast-top-full-width",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": 300,
			"hideDuration": 1000,
			"timeOut": 2000,
			"extendedTimeOut": 500,
			"showEasing": "swing",
			"hideEasing": "swing",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
//const button = document.querySelector("button");
//button.classList.add("active");
		$("#verifyotp").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						location.href="./";
						//setTimeout(function () {window.open("./","_self");},1000)
						//setTimeout(function () {window.open("./","_self");},1000)
						// reset the form
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member
		$("#sendotp").unbind('submit').bind('submit', function() {
			var form = $(this);
			//submi the form to server
			$.ajax({
				url : form.attr('action'),
				type : form.attr('method'),
				data : form.serialize(),
				dataType : 'json',
				beforeSend: function(){	
					$('#status').block({ message: '\n<div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Tunggu sebentar...</h1>\n'});
				},
				success:function(response) {
					$('#status').unblock();
					if(response.success == true) {
						toastr.success(response.messages);
						$("#hp_section").hide(); 
						$("#otp_section").show();
						const inputs = document.querySelectorAll("input"),
						button = document.querySelector("button");

						// iterate over all inputs
						inputs.forEach((input, index1) => {
						  input.addEventListener("keyup", (e) => {
							// This code gets the current input element and stores it in the currentInput variable
							// This code gets the next sibling element of the current input element and stores it in the nextInput variable
							// This code gets the previous sibling element of the current input element and stores it in the prevInput variable
							const currentInput = input,
							  nextInput = input.nextElementSibling,
							  prevInput = input.previousElementSibling;

							// if the value has more than one character then clear it
							if (currentInput.value.length > 1) {
							  currentInput.value = "";
							  return;
							}
							// if the next input is disabled and the current value is not empty
							//  enable the next input and focus on it
							if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
							  nextInput.removeAttribute("disabled");
							  nextInput.focus();
							}

							// if the backspace key is pressed
							if (e.key === "Backspace") {
							  // iterate over all inputs again
							  inputs.forEach((input, index2) => {
								// if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
								// and the previous element exists, set the disabled attribute on the input and focus on the previous element
								if (index1 <= index2 && prevInput) {
								  input.setAttribute("disabled", true);
								  input.value = "";
								  prevInput.focus();
								}
							  });
							}
							//if the fourth input( which index number is 3) is not empty and has not disable attribute then
							//add active class if not then remove the active class.
							//if (!inputs[5].disabled && inputs[5].value !== "") {
							  //button.classList.add("active");
							  //return;
							//}
							//button.classList.remove("active");
						  });
						});

						//focus the first input which index is 0 on window load
						window.addEventListener("load", () => inputs[0].focus());
					} else {
						toastr.error(response.messages);
					}  // /else
				} // success  
			}); // ajax subit 				
			return false;
		}); // /submit form for create member

</script>

</body>

</html>
