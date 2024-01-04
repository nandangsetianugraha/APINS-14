$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    autoFill: true // Enable autofill extension with default configuration
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    responsive: true, // Reponsive support
    autoFill: {
      focus: "click" // Reset autofill trigger
    }
  })

  // Initialize datatable
  $("#datatable-3").DataTable({
    responsive: true, // Reponsive support
    autoFill: {
      horizontal: false // Disable horizontal filling behavior
    }
  })
})
