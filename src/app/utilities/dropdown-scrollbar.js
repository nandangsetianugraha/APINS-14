$(function() {
  $(".dropdown").on("show.bs.dropdown", function() {
    $('[data-toggle="simplebar"]').each(function() {
      new SimpleBar(this)
    })
  })
})