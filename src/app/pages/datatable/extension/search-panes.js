$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    dom: `
      <'row'<'col-12'P>>
      <'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'row'<'col-12'tr>>
      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>
    `,
    searchPanes: {
      cascadePanes: true,
      viewTotal: true
    },
    language: {
      searchPanes: {
        count: "{total} found",
        countFiltered: "{shown} / {total}"
      }
    }
  })
})
