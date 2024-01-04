$(function() {
  const isRtl = $("html").attr("dir") === "rtl"

  $("#widget-carousel").slick({
    rtl: isRtl, // Carousel direction
    asNavFor: "#widget-carousel-nav", // Make this carousel as navigation for #widget-carousel-nav carousel
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false
  })

  $("#widget-carousel-nav").slick({
    rtl: isRtl, // Carousel direction
    asNavFor: "#widget-carousel", // Make this carousel as navigation for #widget-carousel carousel
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    centerMode: true
  })
})