$(function() {
  // Initialize datatable
  $("#datatable-1").DataTable({
    responsive: true, // Reponsive support
    // Custom column rendering methods
    columnDefs: [
      {
        targets: -1,
        title: "Actions",
        searchable: false,
        orderable: false,
        render: (data, type, full, meta) => `
          <button class="btn btn-label-primary btn-icon mr-1">
            <i class="fa fa-edit"></i>
          </button>
          <div class="dropdown d-inline">
            <button class="btn btn-label-primary btn-icon" data-toggle="dropdown">
              <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <button class="dropdown-item">
                <div class="dropdown-icon">
                  <i class="fa fa-trash"></i>
                </div>
                <span class="dropdown-content">Delete</span>
              </button>
              <button class="dropdown-item">
                <div class="dropdown-icon">
                  <i class="fa fa-pen"></i>
                </div>
                <span class="dropdown-content">Update status</span>
              </button>
              <button class="dropdown-item">
                <div class="dropdown-icon">
                  <i class="fa fa-print"></i>
                </div>
                <span class="dropdown-content">Generate report</span>
              </button>
            </div>
          </div>
      `
      },
      {
        targets: -2,
        render: (data, type, full, meta) => {
          const status = [
            { title: "Success", state: "success" },
            { title: "Progress", state: "primary" },
            { title: "Suspended", state: "info" },
            { title: "Canceled", state: "danger" }
          ]
          return `<span class="badge badge-label-${status[data].state}">${status[data].title}</span>`
        }
      }
    ]
  })
})
