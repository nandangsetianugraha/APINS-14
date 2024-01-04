$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    rowReorder: true // Enable row reorder extension with default configuration
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    responsive: true, // Reponsive support
    rowReorder: true, // Enable row reorder extension with default configuration
    columnDefs: [
      {
        orderable: true,
        targets: 0
      },
      {
        orderable: false,
        targets: "_all"
      }
    ]
  })
})
