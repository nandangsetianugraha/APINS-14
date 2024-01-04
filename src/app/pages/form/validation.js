$(function() {
  // Custom method for validation
  $.validator.addMethod(
    "notEqual",
    (value, element, arg) => arg !== value,
    "Value must not equal arg."
  )

  // Initialize form validation
  $("#validate-1").validate({
    rules: {
      firstName: {
        required: true,
        minlength: 5
      },
      lastName: {
        required: true,
        minlength: 5
      },
      age: {
        required: true,
        number: true,
        min: 17
      },
      gender: {
        notEqual: "default"
      },
      email: {
        required: true,
        email: true
      },
      homepage: {
        required: true,
        url: true
      },
      password1: {
        required: true,
        minlength: 6
      },
      password2: {
        required: true,
        minlength: 6,
        equalTo: '[name="password1"]'
      },
      agreement: {
        required: true
      }
    },
    messages: {
      firstName: {
        required: "Please enter your lastname",
        minlength: $.validator.format("Please enter at least {0} characters") // Format validation message
      },
      lastName: {
        required: "Please enter your lastname",
        minlength: $.validator.format("Please enter at least {0} characters") // Format validation message
      },
      age: {
        required: "Please enter your age",
        number: "Please enter a valid number",
        min: $.validator.format("You must {0} years old") // Format validation message
      },
      gender: {
        notEqual: "Please enter your gender"
      },
      email: {
        required: "Please enter your email",
        email: "Please enter your valid email"
      },
      homepage: {
        required: "Please enter your homepage link",
        url: "Your link is not valid"
      },
      password1: {
        required: "Please provide your password",
        minlength: $.validator.format("Please enter at least {0} characters") // Format validation message
      },
      password2: {
        required: "Please repeat your password",
        minlength: $.validator.format("Please enter at least {0} characters"), // Format validation message
        equalTo: "Your password not match"
      },
      agreement: {
        required: "Check to accept the agreement"
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
