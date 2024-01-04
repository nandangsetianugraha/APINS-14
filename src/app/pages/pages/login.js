$(function() {
  // Initialize form validation
  $("#login-form").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      }
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Your email is not valid"
      },
      password: {
        required: "Please provide your password",
        minlength: $.validator.format("Please enter at least {0} characters") // Format validation message
      }
    },
    highlight: (element, errorClass, validClass) => {
			$(element).addClass('is-invalid')
      $(element).removeClass('is-valid')
		},
		unhighlight: (element, errorClass, validClass) => {
			$(element).removeClass('is-invalid')
      $(element).addClass('is-valid')
		},
		errorPlacement: (error, element) => {
      error.addClass('invalid-feedback')
      element.closest('.validation-container').append(error)
    },
    submitHandler: form => {
      form.submit() // Submit form
    }
  })
})
