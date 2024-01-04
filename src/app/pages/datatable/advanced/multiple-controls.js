$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    // Custom DOM layout
    dom: `
      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>
      <'row'<'col-sm-12'tr>>
      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>
    `
  })
})
