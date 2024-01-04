$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true,
    order: [[4, "desc"]],
    rowGroup: {
      dataSrc: 4 // Set the columns for row group
    }
  })

  // Initialize datatable
  $("#datatable-2").DataTable({
    responsive: true,
    order: [[4, "desc"]],
    rowGroup: {
      dataSrc: 4, // Set the columns for row group
      // Row group custom rendering method
      endRender: (rows, group) => {
        let avg =
          rows
            .data()
            .pluck(5)
            .reduce(function(a, b) {
              return a + b.replace(/[^\d]/g, "") * 1
            }, 0) / rows.count()

        return `Average salary in ${group} : ${$.fn.dataTable.render
          .number(",", ".", 0, "$")
          .display(avg)}`
      }
    }
  })

  // Initialize datatable
  $("#datatable-3").DataTable({
    responsive: true,
    order: [
      [4, "desc"],
      [3, "asc"]
    ],
    rowGroup: {
      dataSrc: [4, 3] // Set the columns for row group
    },
    columnDefs: [
      {
        targets: [3, 4],
        visible: false
      }
    ]
  })
})
