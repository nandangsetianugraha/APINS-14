$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    // Custom row rendering methods
    createdRow: (row, data, index) => {
      const column = 5
      const cell = $(row).children("td").eq(column)
      const classes = data[column] < 40 ? "text-success font-weight-bold" : "text-danger font-weight-bold"

      cell.addClass(classes)
    }
  })
})
