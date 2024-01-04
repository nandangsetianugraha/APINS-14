$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    order: [[1, "asc"]],
    columnDefs: [
      {
        targets: [0, 5],
        visible: false // Hide selected columns
      }
    ]
  })
})
