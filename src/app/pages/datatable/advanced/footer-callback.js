$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    // Footer callback method for rendering
    footerCallback: function(row, data, start, end, display) {
      const column = 7
      let api = this.api()

      const formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
        minimumFractionDigits: 0
      })

      function formatInt(num) {
        return typeof num === "string"
          ? num.replace(/[\$,]/g, "") * 1
          : typeof num === "number"
          ? num
          : 0
      }

      let total = api
        .column(column, {
          page: "current"
        })
        .data()
        .reduce(function(total, num) {
          return formatInt(total) + formatInt(num)
        }, 0)

      $(api.column(column).footer()).html(`Total: ${formatter.format(total)}`)
    }
  })
})
