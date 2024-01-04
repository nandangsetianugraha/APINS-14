$(function() {
  const isRtl = $("html").attr("dir") === "rtl"
  const direction = isRtl ? "right" : "left"

  $("#datepicker-1").datepicker({
    orientation: direction, // Set dropdown direction
    autoclose: true
  })

  $("#datepicker-2").datepicker({
    orientation: direction, // Set dropdown direction
    todayHighlight: true
  })

  $("#datepicker-3").datepicker({
    orientation: direction, // Set dropdown direction
    todayBtn: "linked",
    clearBtn: true,
    todayHighlight: true
  })

  $("#datepicker-4").datepicker({
    orientation: direction, // Set dropdown direction
    multidate: true,
    multidateSeparator: ", ",
    todayHighlight: true
  })

  $("#datepicker-5").datepicker({
    orientation: direction, // Set dropdown direction
    daysOfWeekDisabled: "0",
    daysOfWeekHighlighted: "3,4",
    todayHighlight: true
  })

  $("#datepicker-6").datepicker({
    orientation: direction, // Set dropdown direction
    calendarWeeks: true
  })

  $(".input-daterange").datepicker({
    orientation: direction, // Set dropdown direction
    todayHighlight: true
  })

  $("#datepicker-7").datepicker({
    orientation: direction, // Set dropdown direction
    language: "ru"
  })

  $("#datepicker-8").datepicker({
    orientation: direction, // Set dropdown direction
    todayHighlight: true
  })
})
