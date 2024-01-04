$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    select: true // Enable select extension with default configuration
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    responsive: true, // Reponsive support
    select: {
      style: "multi" // Enable multiple selection
    }
  })

  // Initialize datatable
  $("#datatable-3").DataTable({
    responsive: true, // Reponsive support
    select: {
      style: "os",
      items: "cell" // Enable cell selection
    }
  })
})
