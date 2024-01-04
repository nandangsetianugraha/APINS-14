$(function() {
  let i = -1
  let toastCount = 0
  let $toastlast

  // Array of dummy messages
  const msgs = [
    "My name is Inigo Montoya. You killed my father. Prepare to die!",
    `<div>
      <input class="form-control mb-2" placeholder="Input text" >
      <a href="//google.com" target="_blank">This is a hyperlink</a>
    </div>
    <div>
      <button type="button" class="btn btn-primary okBtn mr-1 mt-2">Close me</button>
      <button type="button" class="btn btn-text-light surpriseBtn mt-2">Surprise me</button>
    </div>`,
    "Are you the six fingered man?",
    "Inconceivable!",
    "I do not think that means what you think it means.",
    "Have fun storming the castle!"
  ]

  // Get string from message array by index
  function getMessage() {
    i++
    i = i === msgs.length ? 0 : i

    return msgs[i]
  }

  // Add clear button to message string
  function getMessageWithClearButton(msg) {
    msg = msg ? msg : "Clear it self?"
    msg += '<br><button type="button" class="btn btn-primary clear mt-2">Close</button>'

    return msg
  }

  // Show toastr handler
  $("#showtoast").click(function() {
    // Get all options
    let shortCutFunction = $("#toastTypeGroup input:radio:checked").val()
    let msg = $("#message").val() || getMessage()
    let title = $("#title").val() || ""
    let showDuration = $("#showDuration").val()
    let hideDuration = $("#hideDuration").val()
    let timeOut = $("#timeOut").val()
    let extendedTimeOut = $("#extendedTimeOut").val()
    let showEasing = $("#showEasing").val()
    let hideEasing = $("#hideEasing").val()
    let showMethod = $("#showMethod").val()
    let hideMethod = $("#hideMethod").val()
    let addBehaviorToastClick = $("#addBehaviorOnToastClick").prop("checked")
    let addClear = $("#addClear").prop("checked")

    // Increase index
    let toastIndex = toastCount++

    // Set toastr configuration
    toastr.options = {
      closeButton: $("#closeButton").prop("checked"),
      debug: $("#debugInfo").prop("checked"),
      newestOnTop: $("#newestOnTop").prop("checked"),
      progressBar: $("#progressBar").prop("checked"),
      positionClass: $("#positionGroup input:radio:checked").val() || "toast-top-right",
      preventDuplicates: $("#preventDuplicates").prop("checked"),
      onclick: null
    }

    // Add toastr click behavior if enabled
    if (addBehaviorToastClick) {
      toastr.options.onclick = function() {
        alert("You can perform some custom action after a toast goes away")
      }
    }

    // Set duration of showing if enabled
    if (showDuration.length) {
      toastr.options.showDuration = parseInt(showDuration)
    }

    // Set duration of hiding if enabled
    if (hideDuration.length) {
      toastr.options.hideDuration = parseInt(hideDuration)
    }

    // Set timeout duration for toastr if enabled
    if (timeOut.length) {
      toastr.options.timeOut = addClear ? 0 : parseInt(timeOut)
    }

    // Set extra timeout duration if enabled
    if (extendedTimeOut.length) {
      toastr.options.extendedTimeOut = addClear ? 0 : parseInt(extendedTimeOut)
    }

    // Set show easing if enabled
    if (showEasing.length) {
      toastr.options.showEasing = showEasing
    }

    // Set hide easing if enabled
    if (hideEasing.length) {
      toastr.options.hideEasing = hideEasing
    }

    // Set show method if enabled
    if (showMethod.length) {
      toastr.options.showMethod = showMethod
    }

    // Set hide method if enabled
    if (hideMethod.length) {
      toastr.options.hideMethod = hideMethod
    }

    // Add clear button to toastr message if enabled
    if (addClear) {
      msg = getMessageWithClearButton(msg)
      toastr.options.tapToDismiss = false
    }

    // Set toastr command and configuration code to variables
    let optionText = `toastr.options = ${JSON.stringify(toastr.options, null, 4)}`
    let commandText = `toastr.${shortCutFunction}(\`${msg}\`${title ? ', "' + title + '"' : ""})`

    // Show the code
    $("#toastrOptions").text(`${optionText}\n\n${commandText}`)

    // Execute toastr
    let $toast = toastr[shortCutFunction](msg, title)

    // Save the last toastr object
    $toastlast = $toast

    // Break if found error
    if (typeof $toast === "undefined") {
      return
    }

    // Add behavior to additional buttons
    if ($toast.find(".okBtn").length) {
      $toast.delegate(".okBtn", "click", function() {
        alert(`you clicked me. i was toast #${toastIndex}. goodbye!`)
        $toast.remove()
      })
    }

    if ($toast.find(".surpriseBtn").length) {
      $toast.delegate(".surpriseBtn", "click", function() {
        alert(
          `Surprise! you clicked me. i was toast #${toastIndex}. You could perform an action here.`
        )
      })
    }

    if ($toast.find(".clear").length) {
      $toast.delegate(".clear", "click", function() {
        toastr.clear($toast, { force: true })
      })
    }
  })

  // Clear last toastr element handler
  $("#clearlasttoast").click(function() {
    toastr.clear($toastlast)
  })

  // Clear all toastr elements handler
  $("#cleartoasts").click(function() {
    toastr.clear()
  })
})
