$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    // Set length menu select element
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "All"]
    ]
  })
})
