$(function() {
  // Initialize draggable portlet
  $(".portlet-drag-container").each(function() {
    new Sortable(this, {
      group: "shared",
      handle: ".portlet-header-handle"
    })
  })
})
