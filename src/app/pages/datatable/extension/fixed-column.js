$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    scrollY: 300,
    scrollX: true,
    scrollCollapse: true, // Enable scrollable table
    fixedColumns: true // Enable autofill extension with default configuration
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    scrollY: 300,
    scrollX: true,
    scrollCollapse: true, // Enable scrollable table
    fixedColumns: {
      leftColumns: 2 // Float first two columns
    }
  })

  // Initialize datatable
  $("#datatable-3").DataTable({
    scrollY: 300,
    scrollX: true,
    scrollCollapse: true, // Enable scrollable table
    // Float first and last columns
    fixedColumns: {
      leftColumns: 1,
      rightColumns: 1
    }
  })
})
