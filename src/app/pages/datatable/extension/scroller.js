$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    ajax: "https://blueupcode.com/datatable/api.json", // Get data from API
    deferRender: true,
    scrollCollapse: true, // Enable scrollable table
    scrollY: 300,
    scroller: true // Enable scroller extension with default configuration
  })
})
