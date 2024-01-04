$(function() {
  const isRtl = $("html").attr("dir") === "rtl"
  const direction = isRtl ? "left" : "right"

  $("#datetimepicker-1").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true
  })

  $("#datetimepicker-2").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    todayBtn: "linked"
  })

  $("#datetimepicker-3").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    showMeridian: true
  })

  $("#datetimepicker-4").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    daysOfWeekDisabled: "0,6"
  })

  $("#datetimepicker-5").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    minView: 2,
    format: "mm/dd/yyyy"
  })

  $("#datetimepicker-6").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    minView: 0,
    startView: 1,
    maxView: 1,
    showMeridian: true,
    format: "hh:ii P"
  })

  $("#datetimepicker-7").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    language: "ru"
  })

  $("#datetimepicker-8").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    inline: true
  })

  $("#datetimepicker-9").datetimepicker({
    pickerPosition: direction, // Set dropdown direction
    todayHighlight: true,
    minView: 0,
    startView: 1,
    maxView: 1,
    format: "hh:ii P",
    inline: true
  })
})
