$(function() {
  // Collapse the portlets that has .portlet-collapsed class
  $(".portlet.portlet-collapsed").portlet("collapse")

  // Set event listener
  $('[data-toggle="portlet"]').on("click", function() {
    let target = $(this).data("target")
    const behavior = $(this).data("behavior")

    target = target === "parent" ? $(this).closest(".portlet") : $(target)
    target.portlet(behavior)
  })
})