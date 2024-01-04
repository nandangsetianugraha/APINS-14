$(function() {
  let offset =
    $(window).width() >= 1025
      ? $("#sticky-header-desktop").height()
      : $("#sticky-header-mobile").height()

  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true,
    fixedHeader: {
      header: true, // Float table header
      headerOffset: offset // Fit table header with page header
    }
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    responsive: true,
    fixedHeader: {
      header: true,
      footer: true,
      headerOffset: offset // Fit table header with page header
    }
  })
})
